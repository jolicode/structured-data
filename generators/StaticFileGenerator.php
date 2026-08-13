<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generators;

use JoliCode\StructuredData\Vocabularies\Generators\Google\Generator as GoogleGenerator;
use JoliCode\StructuredData\Vocabularies\Generators\Google\PrettyPrinter;
use JoliCode\StructuredData\Vocabularies\Generators\SchemaOrg\Filesystem;
use JoliCode\StructuredData\Vocabularies\Generators\SchemaOrg\Generator as SchemaOrgGenerator;
use PhpParser\BuilderFactory;
use PhpParser\BuilderHelpers;
use PhpParser\Modifiers;
use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Stmt;

/**
 * A class used to build static files for performance purposes.
 */
class StaticFileGenerator
{
    public const FILE_HEADER = <<<'PHP'
        /*
         * This file is part of JoliCode's json-ld project.
         *
         * (c) jolicode.com <coucou@jolicode.com>
         *
         * For the full copyright and license information, please view the LICENSE
         * file that was distributed with this source code.
         */
        PHP;

    private const REGISTRY_FILE = __DIR__ . '/../src/Vocabularies/Generated/GeneratedClassesRegistry.php';

    private const MAPS = [
        'SCHEMA_ORG_TYPES' => [
            'dir' => __DIR__ . '/../src/Vocabularies/Generated/SchemaOrg/Type',
            'namespace' => SchemaOrgGenerator::NAMESPACE_TYPE,
        ],
        'SCHEMA_ORG_PROPERTIES' => [
            'dir' => __DIR__ . '/../src/Vocabularies/Generated/SchemaOrg/Property',
            'namespace' => SchemaOrgGenerator::NAMESPACE_PROPERTY,
        ],
        'SCHEMA_ORG_ENUMERATION_MEMBERS' => [
            'dir' => __DIR__ . '/../src/Vocabularies/Generated/SchemaOrg/EnumerationMember',
            'namespace' => SchemaOrgGenerator::NAMESPACE_ENUMERATION_MEMBER,
        ],
        'GOOGLE' => [
            'dir' => __DIR__ . '/../src/Vocabularies/Generated/Google',
            'namespace' => GoogleGenerator::NAMESPACE_BASE,
        ],
    ];

    public function __construct(
        private readonly BuilderFactory $factory = new BuilderFactory(),
        private readonly PrettyPrinter $printer = new PrettyPrinter(),
        private readonly Filesystem $filesystem = new Filesystem(),
        private readonly StaticSchemaOrgContextGenerator $staticSchemaOrgContextGenerator = new StaticSchemaOrgContextGenerator(),
    ) {
    }

    public function generate(): void
    {
        $this->generateClassesRegistry();
        $this->staticSchemaOrgContextGenerator->generate();
    }

    /**
     * Builds a registry holding all the generated classes.
     * This way, we avoid autoloader resolution everytime we want to check a class or a property exists.
     */
    private function generateClassesRegistry(): void
    {
        $maps = [];

        foreach (self::MAPS as $constName => $config) {
            $maps[$constName] = $this->buildMap($config['dir'], $config['namespace']);
        }

        $this->filesystem->dumpFile(self::REGISTRY_FILE, $this->render($maps));
    }

    /** @return array<string, string> */
    private function buildMap(string $dir, string $namespace): array
    {
        $map = [];

        foreach (glob($dir . '/*.php') ?: [] as $file) {
            $shortName = basename($file, '.php');
            $map[$namespace . '\\' . $shortName] = $shortName;
        }

        ksort($map);

        return $map;
    }

    /** @param array<string, array<string, string>> $maps */
    private function render(array $maps): string
    {
        $namespace = $this->factory->namespace('JoliCode\\StructuredData\\Vocabularies\\Generated')
            ->addStmt($this->buildRegistryClassNode($maps));

        return "<?php\n\n" . self::FILE_HEADER . "\n\n// THIS FILE IS AUTO-GENERATED. DO NOT EDIT MANUALLY.\n// Run `castor schema-org:generate` or `castor google:generate` to regenerate this file.\n\n" . $this->printer->prettyPrint([$namespace->getNode()]) . "\n";
    }

    /** @param array<string, array<string, string>> $maps */
    private function buildRegistryClassNode(array $maps): Stmt\Class_
    {
        $class = $this->factory->class('GeneratedClassesRegistry')
            ->makeFinal();

        foreach ($maps as $constName => $map) {
            $value = BuilderHelpers::normalizeValue($map);
            $this->markArraysAsMultiline($value);

            $class->addStmt($this->factory->classConst($constName, $value)->makePrivate());
        }

        $class->addStmt($this->buildHasMethodNode());
        $class->addStmt($this->buildGetShortNamesByPrefixMethodNode());
        $class->addStmt($this->buildGetMapByPrefixMethodNode());

        return $class->getNode();
    }

    private function buildHasMethodNode(): Stmt\ClassMethod
    {
        return new Stmt\ClassMethod(
            'has',
            [
                'flags' => Modifiers::PUBLIC | Modifiers::STATIC,
                'params' => [
                    new Node\Param(
                        var: new Expr\Variable('fqcn'),
                        type: new Node\Identifier('string'),
                    ),
                ],
                'returnType' => new Node\Identifier('bool'),
                'stmts' => [
                    new Stmt\Return_(
                        new Expr\Isset_([
                            new Expr\ArrayDimFetch(
                                new Expr\StaticCall(
                                    new Node\Name('self'),
                                    'getMapByPrefix',
                                    [new Node\Arg(new Expr\Variable('fqcn'))],
                                ),
                                new Expr\Variable('fqcn'),
                            ),
                        ]),
                    ),
                ],
            ],
        );
    }

    private function buildGetShortNamesByPrefixMethodNode(): Stmt\ClassMethod
    {
        return new Stmt\ClassMethod(
            'getShortNamesByPrefix',
            [
                'flags' => Modifiers::PUBLIC | Modifiers::STATIC,
                'params' => [
                    new Node\Param(
                        var: new Expr\Variable('namespacePrefix'),
                        type: new Node\Identifier('string'),
                    ),
                ],
                'returnType' => new Node\Identifier('array'),
                'stmts' => [
                    new Stmt\Return_(
                        new Expr\FuncCall(
                            new Node\Name('array_values'),
                            [
                                new Node\Arg(
                                    new Expr\StaticCall(
                                        new Node\Name('self'),
                                        'getMapByPrefix',
                                        [new Node\Arg(new Expr\Variable('namespacePrefix'))],
                                    ),
                                ),
                            ],
                        ),
                    ),
                ],
            ],
        );
    }

    private function buildGetMapByPrefixMethodNode(): Stmt\ClassMethod
    {
        return new Stmt\ClassMethod(
            'getMapByPrefix',
            [
                'flags' => Modifiers::PUBLIC | Modifiers::STATIC,
                'params' => [
                    new Node\Param(
                        var: new Expr\Variable('prefix'),
                        type: new Node\Identifier('string'),
                    ),
                ],
                'returnType' => new Node\Identifier('array'),
                'stmts' => [
                    new Stmt\Return_(
                        new Expr\Match_(
                            new Expr\ConstFetch(new Node\Name('true')),
                            $this->buildPrefixMatchArms(),
                        ),
                    ),
                ],
            ],
        );
    }

    /** @return list<Node\MatchArm> */
    private function buildPrefixMatchArms(): array
    {
        return [
            $this->buildPrefixMatchArm(SchemaOrgGenerator::class, 'NAMESPACE_TYPE', 'SCHEMA_ORG_TYPES'),
            $this->buildPrefixMatchArm(SchemaOrgGenerator::class, 'NAMESPACE_PROPERTY', 'SCHEMA_ORG_PROPERTIES'),
            $this->buildPrefixMatchArm(SchemaOrgGenerator::class, 'NAMESPACE_ENUMERATION_MEMBER', 'SCHEMA_ORG_ENUMERATION_MEMBERS'),
            $this->buildPrefixMatchArm(GoogleGenerator::class, 'NAMESPACE_BASE', 'GOOGLE'),
            new Node\MatchArm(null, new Array_()),
        ];
    }

    private function buildPrefixMatchArm(string $generatorClass, string $namespaceConst, string $mapConst): Node\MatchArm
    {
        // The namespace is emitted as a literal: the generated code must not
        // depend on the generator classes, which are not part of the library
        // runtime.
        $namespace = \constant($generatorClass . '::' . $namespaceConst);

        return new Node\MatchArm(
            [
                new Expr\FuncCall(
                    new Node\Name('str_starts_with'),
                    [
                        new Node\Arg(new Expr\Variable('prefix')),
                        new Node\Arg(new Node\Scalar\String_($namespace)),
                    ],
                ),
            ],
            new Expr\ClassConstFetch(new Node\Name('self'), $mapConst),
        );
    }

    private function markArraysAsMultiline(Expr $value): void
    {
        if (!$value instanceof Array_) {
            return;
        }

        $value->setAttribute('force_multiline', true);

        foreach ($value->items as $item) {
            if ($item->key instanceof Expr) {
                $this->markArraysAsMultiline($item->key);
            }

            $this->markArraysAsMultiline($item->value);
        }
    }
}

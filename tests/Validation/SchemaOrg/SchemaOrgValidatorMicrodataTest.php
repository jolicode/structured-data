<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Tests\Validation;

use Jolicode\Vocabularies\Mapper\MappedType;
use Jolicode\Vocabularies\Validator;
use Jolicode\Vocabularies\Validators\SchemaOrg\SchemaOrgValidator;
use PHPUnit\Framework\TestCase;

/**
 * @group validation
 * @group schemaorg
 */
class SchemaOrgValidatorMicrodataTest extends TestCase
{
    public function testValidatorParsesMicrodataDocument(): void
    {
        $validator = new Validator();
        $validator->setValidator(SchemaOrgValidator::class);

        $microdata = <<<'HTML'
<!doctype html>
<html>
  <body>
    <article itemscope itemtype="https://schema.org/Person">
      <h1 itemprop="name">Jane Doe</h1>
      <a itemprop="url" href="https://example.com/jane-doe">Profile</a>
    </article>
  </body>
</html>
HTML;

        $types = $validator->getTypes($microdata);

        $this->assertNotSame([], $types);
        $this->assertSame([], $this->collectErrorMessages($types));

        $firstType = $types[0];
        $this->assertSame('Person', \is_array($firstType->type) ? $firstType->type[0] : $firstType->type);
    }

    public function testValidatorReturnsErrorForInvalidMicrodataDocument(): void
    {
        $validator = new Validator();
        $validator->setValidator(SchemaOrgValidator::class);

        $invalidMicrodata = <<<'HTML'
<!doctype html>
<html>
  <body>
    <div itemscope>
      <span itemprop="name">Jane Doe</span>
    </div>
  </body>
</html>
HTML;

        $types = $validator->getTypes($invalidMicrodata);

        $this->assertCount(1, $types);
        $this->assertNotSame([], $types[0]->errors);

        $messages = $types[0]->getErrorMessages();
        $this->assertStringContainsString('Invalid microdata document', $messages[0]);
    }

    public function testValidatorPrioritizesJsonLdWhenJsonLdAndMicrodataAreBothPresent(): void
    {
        $validator = new Validator();
        $validator->setValidator(SchemaOrgValidator::class);

        $document = <<<'HTML'
<!doctype html>
<html>
  <body>
    <script type="application/ld+json">
      {"@context":"https://schema.org","@type":"Person","name":"JsonLd Person"}
    </script>
    <div itemscope>
      <span itemprop="name">Invalid Microdata</span>
    </div>
  </body>
</html>
HTML;

        $types = $validator->getTypes($document);

        $this->assertNotSame([], $types);
        $this->assertSame([], $this->collectErrorMessages($types));
    }

    /**
     * @param array<MappedType> $types
     *
     * @return array<string>
     */
    private function collectErrorMessages(array $types): array
    {
        $messages = [];

        foreach ($types as $type) {
            if ([] === $type->errors) {
                continue;
            }

            $messages = [...$messages, ...$type->getErrorMessages(true)];
        }

        return $messages;
    }
}

<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Command\Validation;

use Jolicode\JsonLd\Algorithms\Http\IriResolver;
use Jolicode\JsonLd\Validation\Error\ValidationError;
use Jolicode\JsonLd\Validation\Extraction\JsonLdNodeExtractor;
use Jolicode\JsonLd\Validation\JsonLdValidator;
use Jolicode\JsonLd\Validation\Mapper\MappedError;
use Jolicode\JsonLd\Validation\Mapper\ValidationMap;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

#[AsCommand(
    name: 'validate',
    description: 'Validate that a JSON-LD file or URL is valid',
)]
class ValidateJsonLdCommand extends Command
{
    public function __construct(
        private readonly JsonLdNodeExtractor $extractor = new JsonLdNodeExtractor(),
        private readonly JsonLdValidator $validator = new JsonLdValidator(),
    ) {
        parent::__construct();
    }

    public function configure(): void
    {
        $this->addArgument('document', InputArgument::REQUIRED, 'The JSON-LD document to validate. It may be a file or an absolute URL.');
        $this->addOption(
            'validator',
            null,
            InputOption::VALUE_REQUIRED,
            sprintf(
                'The validator to use. Currently supported validators are : %s (default: all)',
                implode(', ', $this->validator->getSupportedValidatorsSimpleNames()),
            ),
        );
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $errors = [];

        $specificValidator = $input->getOption('validator');

        if ($specificValidator) {
            $specificValidator = $this->validator->getValidatorClassName($specificValidator);

            if (!$specificValidator) {
                $io->error(sprintf(
                    'The required validator "%s" does not exist. Supported validators are : %s',
                    $specificValidator,
                    implode(', ', $this->validator->getSupportedValidatorsSimpleNames()),
                ));

                return Command::FAILURE;
            }
        }

        if (IriResolver::isAbsoluteIri($document = $input->getArgument('document'))) {
            $jsonLd = $this->extractor->extractJsonLd($document);

            foreach ($jsonLd as $jsonLdItem) {
                $errors = array_merge($errors, $this->validateJsonLdItem($jsonLdItem, $specificValidator));
            }
        } else {
            $jsonLd = file_get_contents($document);

            if (!$jsonLd) {
                throw new FileNotFoundException(sprintf('The file "%s" does not exist.', $document));
            }

            $errors = $this->validateJsonLdItem($jsonLd, $specificValidator);
        }

        if ($errors) {
            foreach ($errors as $error) {
                if (ValidationError::SEVERITY_ERROR === $error->severity) {
                    $io->error($error->message);
                    $hasErrors = true;
                } else {
                    $io->warning($error->message);
                }

                $this->writeInfoMessage($io, $error);
            }

            if (isset($hasErrors)) {
                $io->error('The provided JSON-LD document contains validation errors.');
            } else {
                $io->warning('The provided JSON-LD document contains validation warnings.');
            }

            return Command::SUCCESS;
        }

        $io->success('The provided JSON-LD is valid.');

        return Command::SUCCESS;
    }

    /**
     * @return MappedError[]
     */
    private function validateJsonLdItem(string $jsonLd, ?string $validator): array
    {
        $maps = $this->validator->validate($jsonLd, $validator);

        $errors = array_filter(
            $maps,
            fn (ValidationMap $map) => !$map->isValid(),
        );

        $errors = array_reduce(
            $errors,
            fn (array $carry, ValidationMap $map) => array_merge($carry, $map->getErrors()),
            [],
        );

        return $errors;
    }

    private function writeInfoMessage(SymfonyStyle $io, MappedError $error): void
    {
        $type = match (true) {
            \is_string($error->type) => $error->type,
            \is_array($error->type) => sprintf('[%s]', implode(', ', $error->type)),
            default => null,
        };

        if (!$type) {
            $typeText = 'an unknown type (with no @type property)';
        } else {
            $typeText = sprintf('the type "%s"', $type);
        }

        $io->info(sprintf(
            'Raised by the %s validator for %s on property "%s", located at line %d, column %d',
            $error->validatorName,
            $typeText,
            $error->key,
            $error->range->start->line,
            $error->range->start->column,
        ));
    }
}

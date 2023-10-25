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
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'validate',
    description: 'Validate that a JSON-LD file is valid',
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
        $this->addArgument('file', null, 'The JSON-LD file to validate');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $errors = [];

        if (IriResolver::isIri($jsonLd = $input->getArgument('file'))) {
            $jsonLd = $this->extractor->extractJsonLd($jsonLd);

            foreach ($jsonLd as $jsonLdItem) {
                $errors = array_merge($errors, $this->validateJsonLdItem($jsonLdItem));
            }
        } else {
            $errors = $this->validateJsonLdItem($jsonLd);
        }

        if ($errors) {
            foreach ($errors as $error) {
                $io->section(sprintf('Validation %s', $error->severity));

                if (ValidationError::SEVERITY_ERROR === $error->severity) {
                    $io->error($error->message);
                } else {
                    $io->warning($error->message);
                }

                $io->note(sprintf(
                    'Raised on property "%s", located at line %d, column %d',
                    $error->key,
                    $error->range->start->line,
                    $error->range->start->column)
                );
            }

            return Command::FAILURE;
        }

        $io->success('The provided JSON-LD is valid.');

        return Command::SUCCESS;
    }

    private function validateJsonLdItem(string $jsonLd): array
    {
        return $this->validator->validate($jsonLd)->getErrors();
    }
}

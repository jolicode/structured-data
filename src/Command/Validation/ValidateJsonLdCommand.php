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

use Jolicode\JsonLd\Validation\JsonLdValidator;
use Jolicode\JsonLd\Validation\Mapper\MappedError;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'validate',
    description: 'Validate that a JSON-LD file or URL is valid',
)]
class ValidateJsonLdCommand extends Command
{
    public function __construct(
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

        $maps = $this->validator->validate($input->getArgument('document'), $specificValidator);

        if (\count($maps)) {
            $io->success(sprintf('%d types were found in the provided document.', \count($maps)));
        }

        $hasErrors = false;

        foreach ($maps as $map) {
            if (!$map->isValid()) {
                $hasErrors = true;

                foreach ($map->getErrors() as $error) {
                    if (MappedError::SEVERITY_ERROR === $error->severity) {
                        $io->error($error->message);
                    } else {
                        $io->warning($error->message);
                    }

                    $this->writeInfoMessage($io, $error);
                }
            }
        }

        if (!$hasErrors) {
            $io->success('Every structured data found in the provided document is valid.');
        }

        return Command::SUCCESS;
    }

    private function writeInfoMessage(SymfonyStyle $io, MappedError $error): void
    {
        if (!$error->type) {
            $typeText = 'an unknown type (with no @type property)';
        } else {
            $typeText = sprintf('the type "%s"', $error->type);
        }

        $io->info(sprintf(
            'Raised by the %s validator for %s on property "%s". Found on the following lines: %s',
            $error->validatorName,
            $typeText,
            $error->key,
            \PHP_EOL . $error->ranges,
        ));
    }
}

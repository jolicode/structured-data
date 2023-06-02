<?php

namespace Jolicode\JsonLd\Command\Validation;

use Jolicode\JsonLd\Parser\SourceMapper;
use Symfony\Component\Console\Command\Command;
use Jolicode\JsonLd\Algorithms\Expand\Expander;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Jolicode\JsonLd\FormatGuesser\JsonLdFormatGuesser;
use Jolicode\JsonLd\Algorithms\JsonLd\ProcessorOptions;
use Jolicode\JsonLd\Validation\SchemaOrg\SchemaOrgValidator;

#[AsCommand(
    name: 'validate',
    description: 'Validate a JSON-LD file or string',
)]
class ValidateSchemaOrgCommand extends Command
{
    public function configure(): void
    {
        $this->addArgument('document', null, 'The JSON-LD document to validate');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $json = \json_decode(file_get_contents($input->getArgument('document')));

        $formatGuesser = new JsonLdFormatGuesser($json);
        $sourceMapper = $formatGuesser->get

        $expander = new Expander();
        $expanded = $expander->parseJson($json, $options, encodeResult: false);

        $validator = new SchemaOrgValidator();
        $validator->validate($expanded);

        return Command::SUCCESS;
    }
}

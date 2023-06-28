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

use Jolicode\JsonLd\Validation\SchemaOrg\SchemaOrgValidator;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'validate',
    description: 'Validate that a JSON-LD file or string complies to Schema.org',
)]
class ValidateSchemaOrgCommand extends Command
{
    public function configure(): void
    {
        $this->addArgument('document', null, 'The JSON-LD document to validate');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $validator = new SchemaOrgValidator();
        $validator->validate($input->getArgument('document'));

        return Command::SUCCESS;
    }
}

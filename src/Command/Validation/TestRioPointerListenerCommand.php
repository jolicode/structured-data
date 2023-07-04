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

use Jolicode\JsonLd\Parser\UserEntryParser;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

// TODO: remove this command when we don't need it anymore.
#[AsCommand(
    name: 'rio-pointer',
    description: '**TEMPORARY COMMAND** Test the RIO pointer listener'
)]
class TestRioPointerListenerCommand extends Command
{
    public function configure(): void
    {
        $this->addArgument('document', null, 'The JSON-LD document to parse');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $document = $input->getArgument('document');
        $json = file_get_contents($document);

        $parser = new UserEntryParser();
        dump($parser->parse($json));

        return Command::SUCCESS;
    }
}

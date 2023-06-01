<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Command\Algorithms;

use Jolicode\JsonLd\Algorithms\Expand\Expander;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'expand',
    description: 'Take a raw JSON-LD input and expand it'
)]
class ExpandCommand extends Command
{
    public function configure()
    {
        $this
            ->addArgument('file', InputArgument::REQUIRED, 'File to expand');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $file = $input->getArgument('file');

        $expander = new Expander();
        $result = $expander->parseJson(file_get_contents($file));

        $output->writeln($result);

        return Command::SUCCESS;
    }
}

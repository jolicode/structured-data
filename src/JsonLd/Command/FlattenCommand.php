<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Command;

use Jolicode\JsonLd\Algorithms\Flatten\Flattener;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'json-ld:flatten',
    description: 'Applies the flatenization algorithm to an expanded JSON-LD input',
)]
class FlattenCommand extends Command
{
    public function configure()
    {
        $this
            ->addArgument('file', InputArgument::REQUIRED, 'File to flatten');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $file = $input->getArgument('file');

        $flattener = new Flattener();
        $result = $flattener->parseJson(file_get_contents($file));

        $output->writeln($result);

        return Command::SUCCESS;
    }
}

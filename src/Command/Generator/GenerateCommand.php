<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Command\Generator;

use Jolicode\JsonLd\Generator\RegisteredSourcesEnum;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'generate',
    description: 'Extract types from the given sources and generate the PHP classes'
)]
class GenerateCommand extends Command
{
    public function configure()
    {
        $this->addOption('refresh', 'r', InputOption::VALUE_NONE, 'Download and overwrite the source files');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        foreach (RegisteredSourcesEnum::cases() as $generator) {
            $generator = new $generator->value();
            $generator->generate($input->getOption('refresh'));
        }

        return Command::SUCCESS;
    }
}

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

use Jolicode\JsonLd\Algorithms\Fixtures\FixturesInstaller;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'remove-fixtures',
    description: 'Remove all existing tests fixtures',
)]
class ResetFixturesCommand extends Command
{
    public function configure()
    {
        $this
            ->addOption('reset', mode: InputOption::VALUE_NONE, description: 'Reinstall the test suite after having removed it');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        FixturesInstaller::resetFixtures($input->getOption('reset'));

        return Command::SUCCESS;
    }
}

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

use Jolicode\JsonLd\Generator\RegisteredGeneratorsContainer;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'generate',
    description: 'Extract types from the given sources and generate the PHP classes',
)]
class GenerateCommand extends Command
{
    public function __construct(
        private readonly RegisteredGeneratorsContainer $container = new RegisteredGeneratorsContainer(),
    ) {
        parent::__construct();
    }

    public function configure()
    {
        $this->addOption('refresh', 'r', InputOption::VALUE_NONE, 'Download and overwrite the source files');
        $this->addOption('source', 's', InputOption::VALUE_REQUIRED, 'Only download from a specific source. Accepted values are "schemaorg" and "google"');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        if ($source = $input->getOption('source')) {
            if (!\in_array($source, ['schemaorg', 'google'], true)) {
                throw new \InvalidArgumentException(sprintf('Invalid source "%s". Accepted values are "schemaorg" and "google"', $source));
            }

            $this->container->getGenerator($source)->generate($input->getOption('refresh'));

            return Command::SUCCESS;
        }

        foreach ($this->container->getGenerators() as $generator) {
            $generator->generate($input->getOption('refresh'));
        }

        return Command::SUCCESS;
    }
}

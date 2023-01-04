<?php

namespace Jolicode\JsonLd\Command;

use Jolicode\JsonLd\Expand\Expander;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Attribute\AsCommand;
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
        $result = $expander->expand(json_decode(file_get_contents($file)));

        $output->writeln($result);

        return Command::SUCCESS;
    }
}

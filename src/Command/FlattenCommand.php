<?php

namespace Jolicode\JsonLd\Command;

use Jolicode\JsonLd\Flatten\Flattener;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'flatten',
    description: 'Takes an expanded JSON-LD input and flattens it'
)]
class FlattenCommand extends Command
{
    public function configure()
    {
        $this
            ->addArgument('file', InputArgument::REQUIRED, 'File to validate');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $file = $input->getArgument('file');

        $flattener = new Flattener();
        $result = $flattener->flatten(json_decode(file_get_contents($file)));

        $output->writeln($result);

        return Command::SUCCESS;
    }
}

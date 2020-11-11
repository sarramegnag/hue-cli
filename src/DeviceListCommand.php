<?php

namespace Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class DeviceListCommand extends Command
{
    protected static $defaultName = 'device:list';

    protected function configure()
    {
        $this
            ->setDescription('Lists the available lights with their status.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Your lights :');
        $io->table(
            ['Name', 'Status'],
            [
                ['Bedroom', 'On'],
                ['Living room', 'Off'],
            ]
        );

        return Command::SUCCESS;
    }
}

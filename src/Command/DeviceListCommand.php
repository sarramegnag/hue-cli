<?php

namespace App\Command;

use App\HttpClient\HueClient;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class DeviceListCommand extends Command
{
    protected static string $defaultName = 'device:list';

    private HueClient $client;

    public function __construct(HueClient $client)
    {
        $this->client = $client;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Lists the available lights with their status.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $devices = $this->client->getDeviceList();

        $io = new SymfonyStyle($input, $output);
        $io->title('Your lights :');

        $lines = [];

        foreach ($devices as $id => $device) {
            $lines[] = [
                $id,
                $device->getName(),
                $device->getState()->isOn() ? 'on' : 'off',
            ];
        }

        $io->table(
            ['Id', 'Name', 'Status'],
            $lines
        );

        return Command::SUCCESS;
    }
}

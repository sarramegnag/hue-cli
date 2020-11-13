<?php

namespace App\Command;

use App\HttpClient\HueClient;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class DeviceSwitchCommand extends Command
{
    protected static string $defaultName = 'device:switch';

    private HueClient $client;

    public function __construct(HueClient $client)
    {
        $this->client = $client;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Turns the given device on or off.')
            ->addArgument('deviceId', InputArgument::REQUIRED, 'The id of the device.')
            ->addOption('on', null, InputOption::VALUE_NONE,'If the device should be on.')
            ->addOption('off', null, InputOption::VALUE_NONE,'If the device should be off.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $deviceId = (int) $input->getArgument('deviceId');

        if ($input->getOption('on')) {
            $this->client->turnLightOn($deviceId);
        } elseif ($input->getOption('off')) {
            $this->client->turnLightOff($deviceId);
        } else {
            throw new \Exception('Not enough options (missing: "--on" or "--off")');
        }

        $io = new SymfonyStyle($input, $output);
        $io->success(sprintf(
            'Device #%d has been turned %s',
            $deviceId,
            $input->getOption('on') ? 'on' : 'off'
        ));

        return Command::SUCCESS;
    }
}

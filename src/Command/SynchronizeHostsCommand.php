<?php

namespace DockerHostManager\Command;

use DockerHostManager\Docker\Docker;
use DockerHostManager\Synchronizer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SynchronizeHostsCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('synchronize-hosts')
            ->setDescription('Run the application')
            ->addOption(
                'hosts_file',
                'f',
                InputOption::VALUE_REQUIRED,
                'The host file to update',
                getenv('HOSTS_FILE') ?: '/etc/hosts'
            )
            ->addOption(
                'tld',
                't',
                InputOption::VALUE_REQUIRED,
                'The TLD to use',
                getenv('TLD') ?: '.docker'
            )
            ->addOption(
                'windows',
                'w',
                InputOption::VALUE_REQUIRED,
                'Enable Windows support',
                boolval(getenv('WINDOWS')) || false
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $app = new Synchronizer(
            new Docker(),
            $input->getOption('hosts_file'),
            $input->getOption('tld'),
            $input->getOption('windows')
        );

        $app->run();
    }
}

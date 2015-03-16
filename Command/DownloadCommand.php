<?php

namespace Seven\Bundle\OneskyBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DownloadCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('onesky:dump')
            ->setDescription('Dump translations')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getContainer()
            ->get('seven_onesky_downloader')
                ->download();

        $output->writeln("<info>Translations successfully updated from OneSky</info>");

        $this->clearCache($output);
    }

    protected function clearCache(OutputInterface $output)
    {
        $command = $this->getApplication()->find('cache:clear');
        $command->run(new ArrayInput(array('command' => 'cache:clear')), $output);
    }
}

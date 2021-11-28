<?php

namespace App\Command;

use App\Services\ConverterFactory;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConvertCommand extends Command
{
    protected static $defaultName = 'app:convert';

    public function __construct()
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('path', InputArgument::REQUIRED, 'path of xml');
        $this->addArgument('type', InputArgument::REQUIRED, 'type of output');
    }

    /**
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $converter = ConverterFactory::getConverter($input->getArgument('type'));
        $converter->execute($input->getArgument('path'));
        $output->write('done');
        return Command::SUCCESS;
    }

}
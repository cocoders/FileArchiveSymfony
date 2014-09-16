<?php

namespace Cocoders\Bundle\ConsoleCommandBundle\Command;

use Cocoders\UseCase\CreateArchive\CreateArchiveRequest;
use Cocoders\UseCase\CreateArchive\CreateArchiveResponder;
use Cocoders\UseCase\CreateArchive\CreateArchiveUseCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateArchive extends Command implements CreateArchiveResponder
{
    private $useCase;
    /**
     * @var OutputInterface
     */
    private $output;

    public function __construct(CreateArchiveUseCase $useCase)
    {
        $this->useCase = $useCase;
        $this->useCase->addResponder($this);

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('filearchive:archive:create')
            ->setDescription('Create archive')
            ->addArgument('path', InputArgument::REQUIRED, 'Path')
            ->addOption('name', '-nn', InputOption::VALUE_REQUIRED, 'Name of archive')
            ->addOption('file-source-name', '-f', InputOption::VALUE_REQUIRED, 'File source name')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;
        $request = new CreateArchiveRequest($input->getOption('file-source-name'), $input->getOption('name'), $input->getArgument('path'));
        $this->useCase->execute($request);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function archiveCreated($name)
    {
        $this->output->writeln('Finished creation of '.$name. ' archive');
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function archiveAlreadyExists($name)
    {
        $this->output->writeln(sprintf('<error>Archive: %s already exists </error>', $name));
    }
}

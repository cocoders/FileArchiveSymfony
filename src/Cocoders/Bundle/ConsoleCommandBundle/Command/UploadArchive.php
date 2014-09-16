<?php

namespace Cocoders\Bundle\ConsoleCommandBundle\Command;

use Cocoders\UseCase\UploadArchive\UploadArchiveRequest;
use Cocoders\UseCase\UploadArchive\UploadArchiveResponder;
use Cocoders\UseCase\UploadArchive\UploadArchiveUseCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UploadArchive extends Command implements UploadArchiveResponder
{
    private $useCase;
    /**
     * @var OutputInterface
     */
    private $output;

    public function __construct(UploadArchiveUseCase $useCase)
    {
        $this->useCase = $useCase;
        $this->useCase->addResponder($this);

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('filearchive:archive:upload')
            ->setDescription('Upload archive')
            ->addOption('name', '-na', InputOption::VALUE_REQUIRED, 'Name of archive')
            ->addOption('providers', '-p', InputOption::VALUE_REQUIRED, 'Providers names')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;
        $request = new UploadArchiveRequest($input->getOption('name'), explode (',', $input->getOption('providers')));
        $this->useCase->execute($request);
    }

    public function archiveUploaded($name)
    {
        $this->output->writeln('Archive '. $name. ' uploaded');
    }

    public function archiveNotFound($name)
    {
        $this->output->writeln('Archive '. $name. ' not found');
    }
}

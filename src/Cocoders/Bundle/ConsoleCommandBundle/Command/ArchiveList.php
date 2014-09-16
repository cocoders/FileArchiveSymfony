<?php

namespace Cocoders\Bundle\ConsoleCommandBundle\Command;

use Cocoders\UseCase\ArchiveList\ArchiveListResponse;
use Cocoders\UseCase\ArchiveList\ArchiveListResponder;
use Cocoders\UseCase\ArchiveList\ArchiveListUseCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class ArchiveList extends Command implements ArchiveListResponder
{
    private $useCase;
    /**
     * @var OutputInterface
     */
    private $output;

    public function __construct(ArchiveListUseCase $useCase)
    {
        $this->useCase = $useCase;
        $this->useCase->addResponder($this);

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('filearchive:archive:list')
            ->setDescription('List available archives and their upload status')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;
        $this->useCase->execute();
    }

    /**
     * @param ArchiveListResponse $archiveListResponse
     */
    public function archiveListFechted(ArchiveListResponse $archiveListResponse)
    {
        $tableHelper = $this->getHelper('table');
        $tableHelper->setHeaders(["Archive name","Is uploaded?"]);
        $dataRows = [];

        foreach($archiveListResponse->items as $item){
            $dataRows[] = [
                    $item->archiveName,
                    $item->uploaded ? "true" : "false"
            ];
        }
        $tableHelper->setRows($dataRows);
        $tableHelper->render($this->output);
    }
}
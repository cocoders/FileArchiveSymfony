<?php

namespace Cocoders\Bundle\WebBundle\Controller;

use Cocoders\UseCase\ArchiveList\ArchiveListResponder;
use Cocoders\UseCase\ArchiveList\ArchiveListResponse;
use Cocoders\UseCase\ArchiveList\ArchiveListUseCase;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class ListController implements ArchiveListResponder
{
    /**
     * @var \Cocoders\UseCase\ArchiveList\ArchiveListUseCase
     */
    private $archiveListUseCase;
    /**
     * @var \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface
     */
    private $templating;

    private $response;

    public function __construct(ArchiveListUseCase $archiveListUseCase,  EngineInterface $templating)
    {
        $this->archiveListUseCase = $archiveListUseCase;
        $this->archiveListUseCase->addResponder($this);
        $this->templating = $templating;
    }

    public function listAction()
    {
        $this->archiveListUseCase->execute();

        return $this->response;
    }

    public function archiveListFechted(ArchiveListResponse $archiveListResponse)
    {
        $this->response = $this->templating->renderResponse(
            'CocodersWebBundle:List:fetched.html.twig',
            ['items' => $archiveListResponse->items]
        );
    }
}

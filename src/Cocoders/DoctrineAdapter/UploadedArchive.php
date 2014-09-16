<?php

namespace Cocoders\DoctrineAdapter;

use Cocoders\Archive\ArchiveFile;
use Cocoders\Archive\Archive as BaseArchive;
use Cocoders\Upload\UploadedArchive\UploadedArchive as BaseUploadedArchive;
use Cocoders\Upload\UploadProvider\UploadProvider;

class UploadedArchive implements BaseUploadedArchive
{
    private $id;
    private $archive;
    private $providers;

    public function __construct(BaseArchive $archive, array $providers)
    {
        $this->archive = $archive;
        $this->providers = $providers;
    }

    /**
     * @return UploadProvider[]
     */
    public function getProviders()
    {
        return $this->providers;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->archive->getName();
    }

    /**
     * @return ArchiveFile[]
     */
    public function getFiles()
    {
        return $this->archive->getFiles();
    }
}

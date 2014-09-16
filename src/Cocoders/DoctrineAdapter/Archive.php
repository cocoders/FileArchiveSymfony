<?php

namespace Cocoders\DoctrineAdapter;

use Cocoders\Archive\Archive as BaseArchive;
use Cocoders\Archive\ArchiveFile;

class Archive implements BaseArchive
{
    private $id;
    private $name;
    private $files;
    private $uploaded;

    public function __construct($name, array $files)
    {
        $this->name = $name;
        $this->files = $files;
        $this->uploaded = false;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return ArchiveFile[]
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @return boolean
     */
    public function isUploaded()
    {
        return $this->uploaded;
    }

    /**
     * @return void
     */
    public function upload()
    {
        $this->uploaded = true;
    }
}

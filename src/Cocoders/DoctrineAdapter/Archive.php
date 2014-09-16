<?php

namespace Cocoders\DoctrineAdapter;

use Cocoders\Archive\Archive as BaseArchive;
use Cocoders\Archive\ArchiveFile;

class Archive implements BaseArchive
{
    private $id;
    private $name;
    private $files;

    public function __construct($name, array $files)
    {
        $this->name = $name;
        $this->files = $files;
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
}

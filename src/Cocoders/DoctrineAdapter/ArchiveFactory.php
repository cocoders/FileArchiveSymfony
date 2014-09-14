<?php

namespace Cocoders\DoctrineAdapter;

use Cocoders\Archive\ArchiveFactory as BaseArchiveFactory;
use Cocoders\Archive\ArchiveFile;

class ArchiveFactory implements BaseArchiveFactory
{

    /**
     * @param String $name
     * @param ArchiveFile[] $archiveFiles
     * @return Archive
     */
    public function create($name, $archiveFiles)
    {
        return new Archive($name, $archiveFiles);
    }
}

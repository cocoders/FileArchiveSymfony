<?php

namespace Cocoders\DoctrineAdapter;

use Cocoders\Archive\Archive as BaseArchive;
use Cocoders\Upload\UploadedArchive\UploadedArchiveFactory as BaseArchiveFactory;

class UploadedArchiveFactory implements BaseArchiveFactory
{
    public function create(BaseArchive $archive, array $providers)
    {
        return new UploadedArchive($archive, $providers);
    }
}

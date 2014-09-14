<?php

namespace Cocoders\DoctrineAdapter;

use Cocoders\Archive\Archive as BaseArchive;
use Cocoders\Archive\ArchiveRepository as BaseArchiveRepository;
use Doctrine\ORM\EntityRepository;

class ArchiveRepository extends EntityRepository implements BaseArchiveRepository
{
    public function add(BaseArchive $archive)
    {
        $this->_em->persist($archive);
        $this->_em->flush($archive);
    }

    public function findByName($name)
    {
        return $this->findOneBy(['name' => $name]);
    }
}

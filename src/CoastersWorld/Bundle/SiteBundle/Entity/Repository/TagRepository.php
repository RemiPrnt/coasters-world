<?php

namespace CoastersWorld\Bundle\SiteBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class TagRepository extends EntityRepository
{
    public function findAllArray()
    {
        $result = $this
            ->createQueryBuilder('t')
            ->select('t.name')
            ->getQuery()
            ->getArrayResult();
        ;

        return array_map('current', $result);
    }
}

<?php

namespace CoastersWorld\Bundle\SiteBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class ImageRepository extends EntityRepository
{
    public function findFiveLatestOrderedByDateDesc()
    {
        return $this
            ->createQueryBuilder('i')
            ->addOrderBy('i.updatedAt', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
        ;
    }
}

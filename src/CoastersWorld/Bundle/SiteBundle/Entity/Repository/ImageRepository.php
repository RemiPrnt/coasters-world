<?php

namespace CoastersWorld\Bundle\SiteBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class ImageRepository extends EntityRepository
{
    public function findLatestOrderedByDateDesc($number = 5)
    {
        return $this
            ->createQueryBuilder('i')
            ->addOrderBy('i.updatedAt', 'DESC')
            ->setMaxResults($number)
            ->getQuery()
            ->getResult()
        ;
    }
}

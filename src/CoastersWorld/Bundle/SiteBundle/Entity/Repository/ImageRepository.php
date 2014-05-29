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

    public function searchByCoaster($term)
    {
        $qb = $this->createQueryBuilder('i');

        return $qb
            ->select('i.path')
            ->addSelect('c.name')
            ->addSelect('i.id')
            ->join('i.coaster', 'c')
            ->where($qb->expr()->like('c.name', ':identifier'))
            ->setParameter('identifier', $term)
        ;
    }
}

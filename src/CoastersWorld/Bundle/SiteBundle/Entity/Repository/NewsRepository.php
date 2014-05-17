<?php

namespace CoastersWorld\Bundle\SiteBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class NewsRepository extends EntityRepository
{
    public function findAllOrderedByDateDesc()
    {
        return $this
            ->createQueryBuilder('n')
            ->addOrderBy('n.publishedAt', 'DESC')
            ->getQuery()
        ;
    }

    public function findLatest($number = 5)
    {
        return $this
            ->createQueryBuilder('n')
            ->addOrderBy('n.publishedAt', 'DESC')
            ->setMaxResults($number)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findMostPopular($number = 5)
    {
        return $this
            ->createQueryBuilder('n')
            ->select('n.title')
            ->addSelect('n.slug')
            ->addSelect('n.publishedAt')
            ->addSelect('image.path')
            ->addSelect('COUNT(commentaires) as nComments')
            ->leftJoin('n.thumbnail', 'image')
            ->innerJoin('n.comments', 'commentaires')
            ->addGroupBy('n.id')
            ->addOrderBy('nComments', 'DESC')
            ->addOrderBy('n.publishedAt', 'DESC')
            ->setMaxResults($number)
            ->getQuery()
            ->getResult()
        ;
    }
}

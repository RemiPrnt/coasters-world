<?php

namespace CoastersWorld\Bundle\SiteBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository
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
            ->leftJoin('n.image', 'image')
            ->innerJoin('n.comments', 'commentaires')
            ->addGroupBy('n.id')
            ->addOrderBy('nComments', 'DESC')
            ->addOrderBy('n.publishedAt', 'DESC')
            ->setMaxResults($number)
            ->getQuery()
            ->getResult()
        ;
    }

    public function searchByTitle($term)
    {
        $qb = $this->createQueryBuilder('a');

        return $qb
            ->select('a.title')
            ->addSelect('a.id')
            ->addSelect('a.slug')
            ->innerJoin('a.tags', 't')
            ->where($qb->expr()->like('a.title', ':identifier'))
            ->orWhere($qb->expr()->like('a.body', ':identifier'))
            ->orWhere($qb->expr()->like('t.name', ':identifier'))
            ->addOrderBy('a.publishedAt', 'DESC')
            ->setParameter('identifier', $term)
        ;
    }

    public function findByTagId($id)
    {
        $qb = $this->createQueryBuilder('a');

        return $qb
            ->select('a')
            ->innerJoin('a.tags', 't')
            ->where($qb->expr()->like('t.id', ':identifier'))
            ->setParameter('identifier', $id)
        ;
    }
}

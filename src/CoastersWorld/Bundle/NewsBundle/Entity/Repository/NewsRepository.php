<?php

namespace CoastersWorld\Bundle\NewsBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class NewsRepository extends EntityRepository
{
    public function findAllOrderedByDateDesc()
    {
        return $this
            ->createQueryBuilder('n')
            ->addOrderBy('n.publishedAt', 'DESC')
            ->getQuery()
            //->getResult()
        ;
    }
}

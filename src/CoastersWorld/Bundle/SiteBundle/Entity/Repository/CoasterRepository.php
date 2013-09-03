<?php

namespace CoastersWorld\Bundle\SiteBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class CoasterRepository extends EntityRepository
{
    public function searchByNameOrPark($term)
    {
        $qb = $this->createQueryBuilder('c');

        return $qb
            ->select(array('c','p'))
            ->join('c.park', 'p')
            ->where($qb->expr()->like('c.name', ':identifier'))
            ->orWhere($qb->expr()->like('p.name', ':identifier'))
            ->setParameter('identifier', $term)
        ;
    }
}

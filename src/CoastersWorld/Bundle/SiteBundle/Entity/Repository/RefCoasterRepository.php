<?php

namespace CoastersWorld\Bundle\SiteBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class RefCoasterRepository extends EntityRepository
{
    public function findAllRiddenByUser($idUser)
    {
        return $this
            ->createQueryBuilder('c')
            //->andWhere($qb->expr()->eq('c.users', ':user'))
            ->innerJoin('c.users', 'u')
            ->innerJoin('c.manufacturer', 'm')
            ->innerJoin('c.coasters', 'cc')
            ->andWhere('u.id = :idUser')
            ->setParameter('idUser', $idUser)
            //->getQuery()
        ;
    }
}

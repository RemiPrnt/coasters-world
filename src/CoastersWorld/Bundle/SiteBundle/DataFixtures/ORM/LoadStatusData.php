<?php

namespace CoastersWorld\Bundle\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoastersWorld\Bundle\SiteBundle\Entity\Status;

class LoadStatusData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $status = new Status();
        $status
            ->setName('En fonctionnement')
            ->setIdTechnical(1)
        ;
        $manager->persist($status);

        $status2 = new Status();
        $status2
            ->setName('Fermé')
            ->setIdTechnical(2)
        ;
        $manager->persist($status2);

        $status3 = new Status();
        $status3
            ->setName('En chantier')
            ->setIdTechnical(3)
        ;
        $manager->persist($status3);

        $status4 = new Status();
        $status4
            ->setName('Délocalisé')
            ->setIdTechnical(4)
        ;
        $manager->persist($status4);

        $status5 = new Status();
        $status5
            ->setName('Démonté')
            ->setIdTechnical(5)
        ;
        $manager->persist($status5);

        $status6 = new Status();
        $status6
            ->setName('Annoncé')
            ->setIdTechnical(6)
        ;
        $manager->persist($status6);

        $status7 = new Status();
        $status7
            ->setName('Inconnu')
            ->setIdTechnical(7)
        ;
        $manager->persist($status7);

        $manager->flush();

        $this->addReference('status-open', $status);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
}

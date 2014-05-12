<?php

namespace CoastersWorld\Bundle\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoastersWorld\Bundle\SiteBundle\Entity\Restraint;

class LoadRestraintData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        // $restraint = new Restraint();
        // $restraint->setName('Lap Bar');

        // $restraint2 = new Restraint();
        // $restraint2->setName('Horse Collar');

        // $manager->persist($restraint);
        // $manager->persist($restraint2);
        // $manager->flush();

        // $this->addReference('restraint-lapbar', $restraint);
        // $this->addReference('restraint-horsecollar', $restraint2);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
}

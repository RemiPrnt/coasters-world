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
        $restraint = new Restraint();
        $restraint->setName('Lap Bar');

        $manager->persist($restraint);
        $manager->flush();

        $this->addReference('restraint-lapbar', $restraint);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
}

<?php

namespace CoastersWorld\Bundle\DatabaseBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoastersWorld\Bundle\DatabaseBundle\Entity\RefCoaster;

class LoadRefCoasterData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $refCoaster = new RefCoaster();
        $refCoaster
            ->setSpeed(80)
            ->setHeight(30)
            ->setLength(1200)
            ->setInversionNumber(0)
            ->setGForce(3)
            ->setDuration(new \DateTime('00:03:35'))
            ->addType($this->getReference('type-wooden'))
            ->addType($this->getReference('type-kiddie'))
            ->setManufacturer($this->getReference('manufacturer-cci'))
            ->setRestraint($this->getReference('restraint-lapbar'))
        ;

        $manager->persist($refCoaster);
        $manager->flush();

        $this->addReference('refCoaster-tdz', $refCoaster);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 10;
    }
}

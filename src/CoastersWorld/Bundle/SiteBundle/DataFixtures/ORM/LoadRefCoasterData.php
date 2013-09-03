<?php

namespace CoastersWorld\Bundle\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoastersWorld\Bundle\SiteBundle\Entity\RefCoaster;

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
            ->addUser($this->getReference('user-florian'))
        ;

        $refCoaster2 = new RefCoaster();
        $refCoaster2
            ->setSpeed(120)
            ->setHeight(45)
            ->setLength(900)
            ->setInversionNumber(7)
            ->setGForce(8)
            ->setDuration(new \DateTime('00:01:05'))
            ->addType($this->getReference('type-steel'))
            ->setManufacturer($this->getReference('manufacturer-vekoma'))
            ->setRestraint($this->getReference('restraint-horsecollar'))
            ->addUser($this->getReference('user-florian'))
        ;

        $refCoaster3 = new RefCoaster();
        $refCoaster3
            ->setSpeed(25)
            ->setHeight(9)
            ->setLength(300)
            ->setInversionNumber(0)
            ->setGForce(1)
            ->setDuration(new \DateTime('00:00:45'))
            ->addType($this->getReference('type-steel'))
            ->setManufacturer($this->getReference('manufacturer-reverchon'))
            ->setRestraint($this->getReference('restraint-lapbar'))
            ->addUser($this->getReference('user-florian'))
        ;

        $manager->persist($refCoaster);
        $manager->persist($refCoaster2);
        $manager->persist($refCoaster3);
        $manager->flush();

        $this->addReference('refCoaster-tdz', $refCoaster);
        $this->addReference('refCoaster-goudurix', $refCoaster2);
        $this->addReference('refCoaster-wildmouse', $refCoaster3);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 10;
    }
}

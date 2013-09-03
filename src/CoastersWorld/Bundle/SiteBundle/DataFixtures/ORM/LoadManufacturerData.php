<?php

namespace CoastersWorld\Bundle\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoastersWorld\Bundle\SiteBundle\Entity\Manufacturer;

class LoadManufacturerData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $manufacturer = new Manufacturer();
        $manufacturer->setName('CCI');

        $manufacturer2 = new Manufacturer();
        $manufacturer2->setName('Vekoma');

        $manufacturer3 = new Manufacturer();
        $manufacturer3->setName('Reverchon');

        $manager->persist($manufacturer);
        $manager->persist($manufacturer2);
        $manager->persist($manufacturer3);
        $manager->flush();

        $this->addReference('manufacturer-cci', $manufacturer);
        $this->addReference('manufacturer-vekoma', $manufacturer2);
        $this->addReference('manufacturer-reverchon', $manufacturer3);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
}

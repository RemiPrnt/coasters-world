<?php

namespace CoastersWorld\Bundle\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoastersWorld\Bundle\SiteBundle\Entity\Country;

class LoadCountryData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $country = new Country();
        $country->setName('France');

        $manager->persist($country);
        $manager->flush();

        $this->addReference('country-france', $country);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
}

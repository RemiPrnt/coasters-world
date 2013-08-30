<?php

namespace CoastersWorld\Bundle\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoastersWorld\Bundle\SiteBundle\Entity\Park;

class LoadParkData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $park = new Park();
        $park
            ->setName('Parc Astérix')
            ->setCountry($this->getReference('country-france'))
        ;

        $manager->persist($park);
        $manager->flush();

        $this->addReference('park-asterix', $park);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 10;
    }
}

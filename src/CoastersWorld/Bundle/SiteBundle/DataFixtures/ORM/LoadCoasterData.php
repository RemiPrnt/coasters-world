<?php

namespace CoastersWorld\Bundle\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoastersWorld\Bundle\SiteBundle\Entity\Coaster;

class LoadCoasterData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        // $coaster = new Coaster();
        // $coaster
        //     ->setName('Tonnerre de Zeus')
        //     ->setRefCoaster($this->getReference('refCoaster-tdz'))
        //     ->setPark($this->getReference('park-asterix'))
        //     ->setStatus($this->getReference('status-open'))
        // ;

        // $coaster2 = new Coaster();
        // $coaster2
        //     ->setName('Goudurix')
        //     ->setRefCoaster($this->getReference('refCoaster-goudurix'))
        //     ->setPark($this->getReference('park-asterix'))
        //     ->setStatus($this->getReference('status-open'))
        // ;

        // $coaster3 = new Coaster();
        // $coaster3
        //     ->setName('Wild Mouse')
        //     ->setRefCoaster($this->getReference('refCoaster-wildmouse'))
        //     ->setPark($this->getReference('park-asterix'))
        //     ->setStatus($this->getReference('status-open'))
        // ;

        // $manager->persist($coaster);
        // $manager->persist($coaster2);
        // $manager->persist($coaster3);
        // $manager->flush();

        // $this->addReference('coaster-tdz', $coaster);
        // $this->addReference('coaster-goudurix', $coaster2);
        // $this->addReference('coaster-wildmouse', $coaster3);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 20;
    }
}

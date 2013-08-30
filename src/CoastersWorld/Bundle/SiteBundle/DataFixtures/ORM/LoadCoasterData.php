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
        $coaster = new Coaster();
        $coaster
            ->setName('Tonnerre de Zeus')
            ->setRefCoaster($this->getReference('refCoaster-tdz'))
            ->setPark($this->getReference('park-asterix'))
            ->setStatus($this->getReference('status-open'))
        ;

        $manager->persist($coaster);
        $manager->flush();

        $this->addReference('coaster-tdz', $coaster);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 20;
    }
}

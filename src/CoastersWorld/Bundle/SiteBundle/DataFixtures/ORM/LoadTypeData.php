<?php

namespace CoastersWorld\Bundle\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoastersWorld\Bundle\SiteBundle\Entity\Type;

class LoadTypeData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $type = new Type();
        $type->setName('Wooden');
        $this->addReference('type-wooden', $type);

        $manager->persist($type);

        $type2 = new Type();
        $type2->setName('Steel');
        $this->addReference('type-steel', $type2);

        $manager->persist($type2);

        $type3 = new Type();
        $type3->setName('Kiddie Coaster');
        $this->addReference('type-kiddie', $type3);

        $manager->persist($type3);

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
}

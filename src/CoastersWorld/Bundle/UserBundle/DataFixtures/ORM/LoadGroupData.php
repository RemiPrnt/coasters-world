<?php

namespace CoastersWorld\Bundle\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoastersWorld\Bundle\UserBundle\Entity\Group;

class LoadGroupData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $groupSuperAdmin = new Group();
        $groupSuperAdmin->setName('Super Admin');
        $groupSuperAdmin->setRole('ROLE_SUPER_ADMIN');
        $groupSuperAdmin->addUser($this->getReference('user-florian'));

        $manager->persist($groupSuperAdmin);

        $groupAdmin = new Group();
        $groupAdmin->setName('Admin');
        $groupAdmin->setRole('ROLE_ADMIN');
        $groupAdmin->addUser($this->getReference('user-admin'));

        $manager->persist($groupAdmin);

        $groupUser = new Group();
        $groupUser->setName('User');
        $groupUser->setRole('ROLE_USER');
        $groupUser->addUser($this->getReference('user-benj'));

        $manager->persist($groupUser);

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 10;
    }
}

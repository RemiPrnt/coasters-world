<?php

namespace CoastersWorld\Bundle\UserBundle\DataFixtures\ORM;

use CoastersWorld\Bundle\UserBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $userFlorian = new User();
        $userFlorian->setUsername('florian');
        $userFlorian->setSalt(md5(uniqid()));

        $encoder = $this->container
            ->get('security.encoder_factory')
            ->getEncoder($userFlorian)
        ;
        $userFlorian->setPassword($encoder->encodePassword('florian', $userFlorian->getSalt()));

        $userFlorian->setEmail('florian@coastersworld.fr');
        $userFlorian->setCreatedAt(new \DateTime());
        $userFlorian->setIsActive(1);

        $manager->persist($userFlorian);
        $this->addReference('user-florian', $userFlorian);

        $userBenj = new User();
        $userBenj->setUsername('BenJ');
        $userBenj->setSalt(md5(uniqid()));

        $encoder = $this->container
            ->get('security.encoder_factory')
            ->getEncoder($userBenj)
        ;
        $userBenj->setPassword($encoder->encodePassword('BenJ', $userBenj->getSalt()));

        $userBenj->setEmail('benj@gmail.com');
        $userBenj->setCreatedAt(new \DateTime());
        $userBenj->setIsActive(1);

        $manager->persist($userBenj);
        $this->addReference('user-benj', $userBenj);

        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setSalt(md5(uniqid()));

        $encoder = $this->container
            ->get('security.encoder_factory')
            ->getEncoder($userAdmin)
        ;
        $userAdmin->setPassword($encoder->encodePassword('admin', $userAdmin->getSalt()));

        $userAdmin->setEmail('test@coastersworld.fr');
        $userAdmin->setCreatedAt(new \DateTime());
        $userAdmin->setIsActive(1);

        $manager->persist($userAdmin);
        $this->addReference('user-admin', $userAdmin);

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

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
        $userAdmin = new User();
        $userAdmin->setUsername('admin');
        $userAdmin->setSalt(md5(uniqid()));

        $encoder = $this->container
            ->get('security.encoder_factory')
            ->getEncoder($userAdmin)
        ;
        $userAdmin->setPassword($encoder->encodePassword('adminpass', $userAdmin->getSalt()));

        $userAdmin->setEmail('test@coastersworld.fr');
        $userAdmin->setCreatedAt(new \DateTime());
        $userAdmin->setIsActive(1);

        $manager->persist($userAdmin);
        $manager->flush();

        $this->addReference('admin-user', $userAdmin);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
}
<?php

namespace CoastersWorld\Bundle\NewsBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoastersWorld\Bundle\NewsBundle\Entity\Comment;

class LoadCommentData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $comment = new Comment();
        $comment->setBody('Test commentaire.')
            ->setUser($this->getReference('admin-user'))
            ->setNews($this->getReference('news'))
            ->setPublishedAt(new \DateTime());

        $manager->persist($comment);
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 4;
    }
}

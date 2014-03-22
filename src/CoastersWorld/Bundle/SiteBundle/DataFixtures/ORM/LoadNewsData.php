<?php

namespace CoastersWorld\Bundle\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoastersWorld\Bundle\SiteBundle\Entity\News;

class LoadNewsData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $news = new News();
        $news->setTitle('Titre test !')
            ->setBody('Body test !')
            ->setHtml("")
            ->setAuthor($this->getReference('user-florian'))
            ->setCoaster($this->getReference('coaster-tdz'))
            ->setPublishedAt(new \DateTime());

        $manager->persist($news);
        $manager->flush();

        $this->addReference('news1', $news);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 40;
    }
}

<?php

namespace CoastersWorld\Bundle\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CoastersWorld\Bundle\SiteBundle\Entity\Article;

class LoadArticleData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $article = new Article();
        $article->setTitle('Titre test !')
            ->setBody('Body test !')
            ->setHtml("")
            ->setAuthor($this->getReference('user-florian'))
            //->setCoaster($this->getReference('coaster-tdz'))
            ->setPublishedAt(new \DateTime());

        $manager->persist($article);
        $manager->flush();

        $this->addReference('article1', $article);
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 40;
    }
}

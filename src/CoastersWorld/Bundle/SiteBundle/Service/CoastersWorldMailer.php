<?php

namespace CoastersWorld\Bundle\SiteBundle\Service;

use Symfony\Component\Templating\EngineInterface;

class CoastersWorldMailer
{
	protected $mailer;

	public function __construct($mailer, $templating)
	{
		$this->mailer = $mailer;
		$this->templating = $templating;
	}

	public function sendActivationEmail($user)
	{
		$this->mailer->send(\Swift_Message::newInstance()
            ->setSubject('Activation de votre compte CoastersWorld.fr')
            ->setFrom(array('admin@coastersworld.fr' => "CoastersWorld.fr"))
            ->setTo($user->getEmail())
            ->setBody($this->templating->render('CoastersWorldSiteBundle:Security:activationemail.txt.twig', array(
                'user' => $user
        ))));
	}
}
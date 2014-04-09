<?php

namespace CoastersWorld\Bundle\SiteBundle\Service;

use Symfony\Component\Templating\EngineInterface;

class CoastersWorldMailer
{
	protected $mailer;
	protected $templating;
	protected $admin_email_address;
	protected $admin_email_name;

	public function __construct($mailer, $templating, $admin_email_address, $admin_email_name)
	{
		$this->mailer = $mailer;
		$this->templating = $templating;
		$this->admin_email_address = $admin_email_address;
		$this->admin_email_name = $admin_email_name;
	}

	public function sendActivationEmail($user, $subject)
	{
		$this->mailer
			 ->send(\Swift_Message::newInstance()->setSubject($subject)
			             						 ->setFrom(array($this->admin_email_address => $this->admin_email_name))
			             						 ->setTo($user->getEmail())
			             						 ->setBody($this->templating
			             									    ->render('CoastersWorldSiteBundle:Security:activationemail.txt.twig', 
			             									    	array('user' => $user)))
        	 );
	}
}
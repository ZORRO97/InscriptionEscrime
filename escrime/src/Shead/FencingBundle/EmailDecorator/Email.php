<?php

namespace Shead\FencingBundle\EmailDecorator;

class Email {
 private $templating;
 private $mailer;

 public function __construct($templating,$mailer)
 {
 	$this->templating=$templating;
 	$this->mailer=$mailer;

 }

 public function send($template,$to,$data=array(),$sujet="aucun")
 {
	$message = \Swift_Message::newInstance()
            ->setSubject($sujet)
            ->setFrom('francois.lavazec@gmail.com')
            ->setTo($to)
            ->setBody($this->templating->render($template,array('data'=>$data)),'text/html'
               );
        $this->mailer->send($message);
 }

 }

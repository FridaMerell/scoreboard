<?php

namespace App\Service;

use App\Entity\Score;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class Emails {
	function __construct(private MailerInterface $mailer){
	}

	function notifyLoser(Score $score){
		$email = new Email();
		$email->text('Du har förlorat poäng!');
		$email->to($score->getEmail());
		$this->mailer->send($email);
	}
}
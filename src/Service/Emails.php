<?php

namespace App\Service;

use App\Entity\Score;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class Emails {
	function __construct(private MailerInterface $mailer){
	}

	/**
	 * @throws TransportExceptionInterface
	 */
	function notifyLoser(Score $score): void{
		$email = new TemplatedEmail();
		$email->subject('Du har förlorat poäng!');
		$email->htmlTemplate('emails/congrats.html.twig')
			->context([
						  'score' => $score
					  ]);

		$email->to($score->getEmail());
		$email->from('dumhuvud@xn--fvitsko-exa.se');
		$this->mailer->send($email);
	}
}
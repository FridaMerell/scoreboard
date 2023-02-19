<?php

namespace App\Controller;

use App\Entity\Score;
use App\Repository\ScoreRepository;
use App\Service\Emails;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {
	#[Route('/', name: 'app_home')]
	public function index(): Response{
		return $this->render('home/index.html.twig', [
			'controller_name' => 'Scoreboard',
		]);
	}

	#[Route('/submit', name: 'app_submit', methods: ['POST'])]
	function submit(Request $request, ScoreRepository $repository, Emails $emails){
		$content = json_decode($request->getContent());
		$score = new Score();
		$score->setEmail($content->email);
		$score->setComment($content->comment);
		$score->setPoints($content->points);

		$repository->save($score, true);

		$emails->notifyLoser($score);

		return $this->json([]);
	}
}

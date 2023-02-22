<?php

namespace App\Controller;

use App\Entity\Score;
use App\Repository\ScoreRepository;
use App\Service\Emails;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Sodium\add;

class HomeController extends AbstractController {
	#[Route('/', name: 'app_home')]
	public function index(ScoreRepository $repository): Response{
		$topList = $repository->createQueryBuilder('qb')
			->addSelect('COALESCE(qb.alias, qb.email) AS name, SUM(qb.points) AS points')
			->groupBy('name')
			->orderBy('points', 'ASC')
			->getQuery()
			->setMaxResults(5)
			->getResult();

		$latest = $repository->createQueryBuilder('l')
			->orderBy('l.id', 'DESC')
			->setMaxResults(5)
			->getQuery()
			->getResult();

		return $this->render('home/index.html.twig', [
			'controller_name' => 'Scoreboard',
			'toplist' => $topList,
			'latest' => $latest
		]);
	}

	#[Route('/submit', name: 'app_submit', methods: ['POST'])]
	function submit(Request $request, ScoreRepository $repository, Emails $emails){
		$content = json_decode($request->getContent());
		$score = new Score();
		$score->setEmail($content->email);
		$score->setComment($content->comment);
		$score->setPoints($content->points);
		$score->setAlias($content->name);
		$repository->save($score, true);

		$emails->notifyLoser($score);

		return $this->json([]);
	}
}

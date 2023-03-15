<?php

namespace App\Controller;

use App\Repository\ScoreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Scores extends AbstractController {
	#[Route(path: '/scores/{p}', name: 'app_scores')]
	function index(ScoreRepository $repository, int $p = 0): Response{
		$scores = $repository->createQueryBuilder('qb')
			->orderBy('qb.id', 'DESC')
			->setMaxResults(50);
		return $this->render('list/scores.html.twig', [
			'scores' => $scores->getQuery()->getResult()
		]);
	}
}
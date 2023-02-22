<?php

namespace App\Controller;

use App\Entity\Score;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DetailController extends AbstractController {
	#[Route('/detail/{score}', name: 'app_detail')]
	public function index(Score $score): Response{
		return $this->render('detail/index.html.twig', [
			'controller_name' => 'DetailController',
			'score' => $score
		]);
	}
}

<?php

namespace App\Entity;

use App\Repository\ScoreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ScoreRepository::class)]
class Score {
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column]
	private ?int $id = null;
	#[ORM\Column]
	private ?int $points = null;
	#[ORM\Column(length: 255)]
	private ?string $email = null;
	#[ORM\Column(length: 255, nullable: true)]
	private ?string $alias = null;
	#[ORM\Column(length: 255, nullable: true)]
	private ?string $comment = null;

	public function getId(): ?int{
		return $this->id;
	}

	public function getPoints(): ?int{
		return $this->points;
	}

	public function setPoints(int $points): self{
		$this->points = $points;

		return $this;
	}

	public function getEmail(): ?string{
		return $this->email;
	}

	public function setEmail(string $email): self{
		$this->email = $email;

		return $this;
	}

	public function getAlias(): ?string{
		return $this->alias ?? $this->email;
	}

	public function setAlias(string $alias): self{
		$this->alias = $alias;

		return $this;
	}

	public function getComment(): ?string{
		return $this->comment;
	}

	public function setComment(?string $comment): self{
		$this->comment = $comment;

		return $this;
	}
}

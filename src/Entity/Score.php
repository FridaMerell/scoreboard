<?php

namespace App\Entity;

use App\Repository\ScoreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
	#[ORM\OneToMany(mappedBy: 'score', targetEntity: Opinion::class, orphanRemoval: true)]
	private Collection $opinions;

	public function __construct(){
		$this->opinions = new ArrayCollection();
	}

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

	/**
	 * @return Collection<int, Opinion>
	 */
	public function getOpinions(): Collection{
		return $this->opinions;
	}

	public function addOpinion(Opinion $opinion): self{
		if (!$this->opinions->contains($opinion)) {
			$this->opinions->add($opinion);
			$opinion->setScore($this);
		}

		return $this;
	}

	public function removeOpinion(Opinion $opinion): self{
		if ($this->opinions->removeElement($opinion)) {
			// set the owning side to null (unless already changed)
			if ($opinion->getScore() === $this) {
				$opinion->setScore(null);
			}
		}

		return $this;
	}
}

<?php

namespace App\Entity;

use App\Repository\OpinionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OpinionRepository::class)]
class Opinion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'opinions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Score $score = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScore(): ?Score
    {
        return $this->score;
    }

    public function setScore(?Score $Score): self
    {
        $this->score = $Score;

        return $this;
    }
}

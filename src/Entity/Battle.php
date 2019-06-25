<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BattleRepository")
 */
class Battle
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $QuestionE;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $QuestionM;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $QuestionH;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Health;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestionE(): ?int
    {
        return $this->QuestionE;
    }

    public function setQuestionE(?int $QuestionE): self
    {
        $this->QuestionE = $QuestionE;

        return $this;
    }

    public function getQuestionM(): ?int
    {
        return $this->QuestionM;
    }

    public function setQuestionM(?int $QuestionM): self
    {
        $this->QuestionM = $QuestionM;

        return $this;
    }

    public function getQuestionH(): ?int
    {
        return $this->QuestionH;
    }

    public function setQuestionH(?int $QuestionH): self
    {
        $this->QuestionH = $QuestionH;

        return $this;
    }

    public function getHealth(): ?int
    {
        return $this->Health;
    }

    public function setHealth(?int $Health): self
    {
        $this->Health = $Health;

        return $this;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 27/11/2018
 * Time: 13:18
 */

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class QCM
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\QCMRepository")
 *
 */

class QCM
{

    use IdTrait;
    /**
     * @var string
     *
     * La Text d'une question de QCM
     *
     * @ORM\Column()
     * @Assert\NotNull()
     * @Assert\Type("string")
     * @Assert\Length(max=255)
     *
     */
    private $question;


    /**
     * @var string
     *
     * La Text d'une question de QCM
     *
     * @ORM\Column()
     * @Assert\NotNull()
     * @Assert\Type("string")
     * @Assert\Length(max=255)
     *
     */
    private $explication;

    /**
     * @var QCMChoice
     *
     *Le reponses a la question (avec les faux reponses)
     *
     * @ORM\OneToMany(targetEntity="App\Entity\QCMChoice", mappedBy="qcm",cascade={"persist"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     *
     *
     *
     */
    private $choices;

    /**
     * @var integer
     *
     *Le niveau de difficulté des questions
     *
     * @ORM\Column()
     * @Assert\NotNull()
     * @Assert\Type("integer")
     *
     *
     */

    private $difficulty;

    /**
     * @var string
     *
     * Le theme de la question
     *
     * @ORM\Column()
     * @Assert\NotNull()
     * @Assert\Type("string")
     * @Assert\Length(max=255)
     *
     *
     */
    private $theme;

    /**
     * @ORM\ManyToMany(targetEntity="Battle", inversedBy="qcms")
     */

    private $battles;

    public function __construct()
    {
        $this->choices =  new ArrayCollection();
        $this->battles =  new ArrayCollection();
    }


    /**
     * @return string
     */
    public function getQuestion(): string
    {
        return $this->question;
    }

    /**
     * @param string $question
     */
    public function setQuestion(string $question): void
    {
        $this->question = $question;
    }

    /**
     * @return string
     */
    public function getExplication(): string
    {
        return $this->explication;
    }

    /**
     * @param string $explication
     */
    public function setExplication(string $explication): void
    {
        $this->explication = $explication;
    }

    /**
     * @return float
     */
    public function getChoices()
    {
        return $this->choices;
    }

    /**
     * @param float $choices
     */
    public function addChoices(QCMChoice $choices): void
    {
        if (!$this->choices->contains($choices)) {
            $this->choices->add($choices);
            $choices->getQcm($this);
        }
    }

    public  function  removeChoices(QCMChoice $choice)
    {
        $this->choices->removeElement($choice);
    }


    /**
     * @return int
     */
    public function getDifficulty(): ?int
    {
        return $this->difficulty;
    }

    /**
     * @param int $difficulty
     */
    public function setDifficulty(int $difficulty): void
    {
        $this->difficulty = $difficulty;
    }

    /**
     * @return string
     */
    public function getTheme(): ?string
    {
        return $this->theme;
    }

    /**
     * @param string $theme
     */
    public function setTheme(string $theme): void
    {
        $this->theme = $theme;
    }

    public function setHealth(?int $Health): self
    {
        $this->Health = $Health;

        return $this;
    }

    public function addBattle(Battle $battle) : QCM
    {
        if ($this->battles->contains($battle))
        {
            return $this;
        }
        $this->battles->add($battle);
        $battle->addQCM($this);
        return $this;
    }

    public function removeBattle(Battle $battle) : QCM
    {
        if (! $this->battles->contains($battle))
        {
            return $this;
        }
        $this->battles->removeElement($battle);
        $battle->removeQCM($this);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBattles()
    {
        return $this->battles;
    }




}
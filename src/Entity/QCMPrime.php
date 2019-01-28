<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 27/11/2018
 * Time: 13:47
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class QCMPrime
 * @package App\Entity
 * @ORM\Entity()
 *
 */
class QCMPrime
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

    //rating  = (rating * ratingN + rate)/(ratingN+1)

    /**
     * @var integer
     *
     * Le nombre de gens qui ont note la question
     * Ont l'initialiser a 0 lors de creation
     *
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     *
     *
     */
    private $ratingN;

    /**
     * @var float
     *
     * La note moyenne de la question donner par des gens
     * Ont l'initialiser a 0 lors de creation
     *
     * @ORM\Column(type="float")
     * @Assert\Type("float")
     *
     *
     */
    private $rating;

    /**
     * @var QCMChoice
     *
     *Le reponses a la question (avec les faux reponses)
     *
     * @ORM\OneToMany(targetEntity="App\Entity\QCMChoice", mappedBy="qcmPrime",cascade={"persist"})
     *
     *
     *
     *
     */
    private $choices;

    /**
     * @var Vote
     *
     * @ORM\OneToMany(targetEntity="Vote", mappedBy="QCMPrime")
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     *
     */

    private $vote;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="qcmprimes")
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     */

    private $user;

    public function __construct()
    {
        $this->choices =  new ArrayCollection();
        $this->vote = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getExplication(): ?string
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
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param mixed $question
     */
    public function setQuestion($question): void
    {
        $this->question = $question;
    }

    /**
     * @return mixed
     */
    public function getRatingN()
    {
        return $this->ratingN;
    }

    /**
     * @param mixed $ratingN
     */
    public function setRatingN($ratingN): void
    {
        $this->ratingN = $ratingN;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating): void
    {
        $this->rating = $rating;
    }


    public function addChoice(QCMChoice $choice)
    {
        if (!$this->choices->contains($choice)) {
            $this->choices->add($choice);
            $choice->setQcmPrime($this);
        }
    }

    public  function  removeChoice(QCMChoice $choice)
    {
        if ($this->choices->contains($choice)){

            $this->choices->removeElement($choice);
            $choice->setQcmPrime(null);

        }
    }

    /**
     * @return mixed
     */
    public function getChoices()
    {
        return $this->choices;
    }

    /**
     * @return User
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return Vote
     */
    public function getVote(): ?Vote
    {
        return $this->vote;
    }

    /**
     * @param Vote $vote
     */
    public function setVote(Vote $vote): void
    {
        $this->vote = $vote;
    }




}
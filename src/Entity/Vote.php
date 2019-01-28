<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 03/12/2018
 * Time: 13:52
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Vote
 * @package App\Entity
 *
 *
 * @Table(uniqueConstraints={
 *        @UniqueConstraint(name="vote_unique",
 *            columns={"user_id", "QCMPrime_id"})
 *    }
 * )
 *
 * @ORM\Entity()
 */

class Vote
{
    use IdTrait;

    /**
     * @var boolean
     * Le vote(positive/negative)
     *
     * @ORM\Column(type="boolean")
     * @Assert\NotNull()
     * @Assert\Type("bool")
     */
    private $vote;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="vote")
     * @ORM\JoinColumn(onDelete="SET NULL")
     *
     */
    private $user;


    /**
     * @var QCMPrime
     *
     *@ORM\ManyToOne(targetEntity="QCMPrime", inversedBy="vote")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $QCMPrime;




    /**
     * @return bool
     */
    public function isVote(): bool
    {
        return $this->vote;
    }

    /**
     * @param bool $vote
     */
    public function setVote(bool $vote): void
    {
        $this->vote = $vote;
    }

    /**
     * @return User
     */
    public function getUser(): User
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
     * @return QCMPrime
     */
    public function getQCMPrime(): QCMPrime
    {
        return $this->QCMPrime;
    }

    /**
     * @param QCMPrime $QCMPrime
     */
    public function setQCMPrime(QCMPrime $QCMPrime): void
    {
        $this->QCMPrime = $QCMPrime;
    }




}
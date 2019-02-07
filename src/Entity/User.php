<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 28/11/2018
 * Time: 13:11
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class User
 * @package App\Entity
 *
 * @ORM\Entity()
 */

class User implements UserInterface
{

    use IdTrait;
    /**
     * @var  string
     * @ORM\Column(unique=true)
     * @Assert\NotNull()
     * @Assert\Type("string")
     * @Assert\Length(max=255)
     * @Assert\Email()
     */
    private $email;
    /**
     * @var  string
     * @ORM\Column()
     * @Assert\NotNull()
     * @Assert\Type("string")
     * @Assert\Length(max=255)
     */
    private $password;
    /**
     * @var integer
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     */
    private $role=1;

    /**
     * @var Vote
     *
     * @ORM\OneToMany(targetEntity="Vote",mappedBy="user")
     * @ORM\JoinColumn(nullable=false)
     *
     */
    private $vote;

    /**
     * @var QCMPrime
     *
     * @ORM\OneToMany(targetEntity="QCMPrime",mappedBy="user")
     */
    private $qcmprimes;

    public function __construct()
    {
        $this->vote = new ArrayCollection();
        $this->qcmprimes = new  ArrayCollection();
    }


    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return int
     */
    public function getRole(): int
    {
        return $this->role;
    }



    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @param int $role
     */
    public function setRole(int $role): void
    {
        $this->role = $role;
    }



    public function getRoles()
    {
        switch ($this->role)
        {
            case 1: return ['ROLE_USER'];
            case 2: return ['ROLE_MODO'];
            case 3: return ['ROLE_ADMIN'];
        }
    }

    /**
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }



    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
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

    /**
     * @return QCMPrime
     */
    public function getQcmprimes(): QCMPrime
    {
        return $this->qcmprimes;
    }

    /**
     * @param QCMPrime $qcmprimes
     */
    public function setQcmprimes(QCMPrime $qcmprimes): void
    {
        $this->qcmprimes = $qcmprimes;
    }



}
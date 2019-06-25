<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 27/11/2018
 * Time: 13:19
 */

namespace App\Entity;

use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class QCMChoice
 * @package App\Entity
 * @ORM\Entity()
 *
 */

class QCMChoice
{
    use IdTrait;


    /**
     *
     * @var string
     * Le text d'une des reponses d'une question de QCM
     *
     * @ORM\Column()
     * @Assert\NotNull()
     * @Assert\Type("string")
     * @Assert\Length(max=255)
     */
    private $answer;
    /**
     * @var boolean
     * Le status de la reponse qui determiner si c'est la ou l'une des bonnes reponse a la question.
     *
     * @ORM\Column(type="boolean")
     * @Assert\NotNull()
     * @Assert\Type("bool")
     */
    private $validation;

    /**
     * @var QCMPrime
     *
     * @ManyToOne(targetEntity="App\Entity\QCMPrime", inversedBy="choices")
     * @JoinColumn(name="qcm_prime_id", referencedColumnName="id", onDelete="CASCADE")
     *
     */
    private $qcmPrime;

    /**
     * @var QCM
     *
     * @ManyToOne(targetEntity="QCM", inversedBy="choices")
     * @JoinColumn(name="qcm_id", referencedColumnName="id")
     *
     */
    private $qcm;

    /**
     * @return QCM
     */
    public function getQcm(): ?QCM
    {
        return $this->qcm;
    }

    /**
     * @param QCM $qcm
     */
    public function setQcm(QCM $qcm): void
    {
        $this->qcm = $qcm;
    }


    /**
     * @return QCMPrime
     */
    public function getQcmPrime(): QCMPrime
    {
        return $this->qcmPrime;
    }

    /**
     * @param QCMPrime $qcmPrime
     */
    public function setQcmPrime(QCMPrime $qcmPrime): void
    {
        $this->qcmPrime = $qcmPrime;
    }


    /**
     * @return string
     */
    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    /**
     * @param string $answer
     */
    public function setAnswer(string $answer): void
    {
        $this->answer = $answer;
    }

    /**
     * @return bool
     */
    public function isValidation(): ?bool
    {
        return $this->validation;
    }

    /**
     * @param bool $validation
     */
    public function setValidation(bool $validation): void
    {
        $this->validation = $validation;
    }




}
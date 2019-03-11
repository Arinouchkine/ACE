<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MonstreRepository")
 */
class Monstre
{

    use IdTrait;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image_monstre_url;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image_monstre_name;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Description;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrEasyQuestion;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrMediumQuestion;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrHardQuestion;

    /**
     * @ORM\Column(type="integer")
     */
    private $force;

    /**
     * @todo liason loot many to many
     */

    /**
     * @todo liason caseMap many to many
     */


    public function getImageMonstreUrl(): ?string
    {
        return $this->image_monstre_url;
    }

    public function setImageMonstreUrl(string $image_monstre_url): self
    {
        $this->image_monstre_url = $image_monstre_url;

        return $this;
    }

    public function getImageMonstreName(): ?string
    {
        return $this->image_monstre_name;
    }

    public function setImageMonstreName(string $image_monstre_name): self
    {
        $this->image_monstre_name = $image_monstre_name;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getNbrEasyQuestion(): ?int
    {
        return $this->nbrEasyQuestion;
    }

    public function setNbrEasyQuestion(int $nbrEasyQuestion): self
    {
        $this->nbrEasyQuestion = $nbrEasyQuestion;

        return $this;
    }

    public function getNbrMediumQuestion(): ?int
    {
        return $this->nbrMediumQuestion;
    }

    public function setNbrMediumQuestion(int $nbrMediumQuestion): self
    {
        $this->nbrMediumQuestion = $nbrMediumQuestion;

        return $this;
    }

    public function getNbrHardQuestion(): ?int
    {
        return $this->nbrHardQuestion;
    }

    public function setNbrHardQuestion(int $nbrHardQuestion): self
    {
        $this->nbrHardQuestion = $nbrHardQuestion;

        return $this;
    }

    public function getForce(): ?int
    {
        return $this->force;
    }

    public function setForce(int $force): self
    {
        $this->force = $force;

        return $this;
    }
}

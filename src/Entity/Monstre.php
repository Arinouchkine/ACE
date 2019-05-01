<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MonstreRepository")
 */
class Monstre
{

    use IdTrait;

    /**
     * @var FileSave
     * @ORM\OneToOne(targetEntity="FileSave",cascade={"persist"})
     */
    private $imageMonstre;



    /**
     * @ORM\Column(type="string", length=20)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

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
     * @ORM\ManyToMany(targetEntity="Loot", mappedBy="monstres")
     */
    private $loots;
    /**
     * @ORM\ManyToMany(targetEntity="CaseMapEvent", inversedBy="monstres")
     */
    private $caseMapEvents;

    public function __construct()
    {
        $this->caseMapEvents=new ArrayCollection();
        $this->loots=new ArrayCollection();
    }

    /**
     * @return FileSave
     */
    public function getImageMonstre(): FileSave
    {
        return $this->imageMonstre;
    }

    /**
     * @param FileSave $image_monstre
     */
    public function setImageMonstre(FileSave $image_monstre): void
    {
        $this->imageMonstre = $image_monstre;
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
        return $this->description;
    }

    public function setDescription(string $Description): self
    {
        $this->description = $Description;

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

    /**
     * @param Loot $loot
     * @return Monstre
     */
    public function addLoot(Loot $loot):Monstre
    {
        if($this->loots->contains($loot)){
            return $this;
        }
        $this->loots->add($loot);
        $loot->addMonstre($this);
        return $this;
    }

    /**
     * @param Loot $loot
     * @return Monstre
     */
    public function removeLoot(Loot $loot):Monstre
    {
        if (! $this->loots->contains($loot))
        {
            return $this;
        }
        $this->loots->removeElement($loot);
        $loot->removeMonstre($this);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLoots()
    {
        return $this->loots;
    }

    /**
     * @param CaseMapEvent $caseMapEvent
     * @return Monstre
     */
    public function addCaseMapEvent(CaseMapEvent $caseMapEvent):Monstre
    {
        if ($this->caseMapEvents->contains($caseMapEvent))
        {
            return $this;
        }
        $this->caseMapEvents->add($caseMapEvent);
        $caseMapEvent->addMonstre($this);
        return $this;
    }

    /**
     * @param CaseMapEvent $caseMapEvent
     * @return Monstre
     */
    public function removeCaseMapEvent(CaseMapEvent $caseMapEvent):Monstre
    {
        if (!$this->caseMapEvents->contains($caseMapEvent))
        {
            return $this;
        }
        $this->caseMapEvents->removeElement($caseMapEvent);
        $caseMapEvent->removeMonstre($this);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCaseMapEvents()
    {
        return $this->caseMapEvents;
    }


}

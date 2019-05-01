<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CaseMapEventRepository")
 */
class CaseMapEvent
{
    use IdTrait;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @var caseMapEventType
     * @ORM\ManyToOne(targetEntity="CaseMapEventType")
     */
    private $caseMapEventType;


    /**
     * @ORM\ManyToMany(targetEntity="Monstre", mappedBy="caseMapEvents")
     */
    private $monstres;

    /**
     * @ORM\ManyToMany(targetEntity="Loot", mappedBy="caseMapEvents")
     */
    private $loots;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $conditionEvent;

    /**
     * @ORM\Column(type="string", length=510, nullable=true)
     */
    private $texte;

    /**
     * @var FileSave
     * @ORM\OneToOne(targetEntity="FileSave",cascade={"persist"})
     */
    private $imageSup;

    /**
     * @ORM\ManyToMany(targetEntity="CaseMap", inversedBy="caseMapEvents")
     */
    private $caseMaps;

    public function __construct()
    {
        $this->monstres = new ArrayCollection();
        $this->caseMaps = new ArrayCollection();
        $this->loots = new  ArrayCollection();
    }


    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * @return caseMapEventType
     */
    public function getCaseMapEventType(): ?caseMapEventType
    {
        return $this->caseMapEventType;
    }

    /**
     * @param caseMapEventType $caseMapEventType
     * @return self
     */
    public function setCaseMapEventType(caseMapEventType $caseMapEventType): self
    {
        $this->caseMapEventType = $caseMapEventType;
        return $this;
    }



    /**
     * @param Monstre $monstre
     * @return CaseMapEvent
     */
    public function addMonstre(Monstre $monstre):CaseMapEvent
    {
        if ($this->monstres->contains($monstre))
        {
            return $this;
        }
        $this->monstres->add($monstre);
        $monstre->addCaseMapEvent($this);
        return $this;

    }

    /**
     * @param Monstre $monstre
     * @return CaseMapEvent
     */
    public function removeMonstre(Monstre $monstre):CaseMapEvent
    {
        if (!$this->monstres->contains($monstre))
        {
            return $this;
        }
        $this->monstres->removeElement($monstre);
        $monstre->removeCaseMapEvent($this);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMonstres()
    {
        return $this->monstres;
    }

    /**
     * @param Loot $loot
     * @return CaseMapEvent
     */
    public function addLoot(Loot $loot): CaseMapEvent
    {
        if($this->loots->contains($loot))
        {
            return $this;
        }
        $this->loots->add($loot);
        $loot->addCaseMapEvent($this);
        return $this;
    }

    public function removeLoot(Loot $loot): CaseMapEvent
    {
        if (!$this->loots->contains($loot))
        {
            return $this;
        }
        $this->loots->removeElement($loot);
        $loot->removeCaseMapEvent($this);
        return $this;
    }

    public function getLoots()
    {
        return $this->loots;
    }


    public function getConditionEvent(): ?string
    {
        return $this->conditionEvent;
    }

    public function setConditionEvent(?string $conditionEvent): self
    {
        $this->conditionEvent = $conditionEvent;

        return $this;
    }

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(?string $texte): self
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * @return FileSave
     */
    public function getImageSup(): ?FileSave
    {
        return $this->imageSup;
    }

    /**
     * @param FileSave $imageSup
     * @return CaseMapEvent
     */
    public function setImageSup(FileSave $imageSup): CaseMapEvent
    {
        $this->imageSup = $imageSup;
        return $this;
    }


    /**
     * @param CaseMap $caseMap
     * @return CaseMapEvent
     */
    public function addCaseMap(CaseMap $caseMap):CaseMapEvent
    {
        if ($this->caseMaps->contains($caseMap))
        {
            return $this;
        }
        $this->caseMaps->add($caseMap);
        $caseMap->addCaseMapEvent($this);
        return $this;
    }

    /**
     * @param CaseMap $caseMap
     * @return CaseMapEvent
     */
    public function removeCaseMap(CaseMap $caseMap):CaseMapEvent
    {
        if (!$this->caseMaps->contains($caseMap))
        {
            return $this;
        }
        $this->caseMaps->removeElement($caseMap);
        $caseMap->removeCaseMapEvent($this);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCaseMaps()
    {
        return $this->caseMaps;
    }

    
}

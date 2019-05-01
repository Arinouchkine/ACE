<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CaseMapTypeRepository")
 */
class CaseMapType
{
    use IdTrait;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=510)
     */
    private $description;

    /**
     * @var FileSave
     * @ORM\OneToOne(targetEntity="FileSave",cascade={"persist"})
     */
    private $caseMapImage;

    /**
     * @var CaseMap
     * @ORM\OneToMany(targetEntity="CaseMap", mappedBy="caseMapType")
     */
    private $caseMaps;

    public function __construct()
    {
        $this->caseMaps = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return FileSave
     */
    public function getCaseMapImage(): ?FileSave
    {
        return $this->caseMapImage;
    }

    /**
     * @param FileSave $caseMapImage
     * @return CaseMapType
     */
    public function setCaseMapImage(FileSave $caseMapImage): CaseMapType
    {
        $this->caseMapImage = $caseMapImage;
        return $this;
    }

    /**
     * @param CaseMap $caseMap
     * @return CaseMapType
     */
    public function addCaseMap(CaseMap $caseMap):CaseMapType
    {
        if ($this->caseMaps->contains($caseMap))
        {
            return $this;
        }
        $this->caseMaps->add($caseMap);
        $caseMap->setCaseMapType($this);
        return $this;
    }

    /**
     * @param CaseMap $caseMap
     * @return CaseMapType
     */
    public function removeCaseMap(CaseMap $caseMap):CaseMapType
    {
        if (!$this->caseMaps->contains($caseMap))
        {
            return $this;
        }
        $this->caseMaps->removeElement($caseMap);

        return $this;
    }
}

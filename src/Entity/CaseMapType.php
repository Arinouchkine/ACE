<?php

namespace App\Entity;

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
     * @ORM\OneToOne(targetEntity="FileSave")
     */
    private $caseMapImage;


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
    public function getCaseMapImage(): FileSave
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
}

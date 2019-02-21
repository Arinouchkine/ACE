<?php

namespace App\Entity;

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
     * @todo liason avec entiter type
     */
    /**
     * @ORM\Column(type="integer")
     */
    private $type;


    /**
     * @todo liason avec entiter monstre
     */
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $monstre;
    /**
     * @todo liason avec entiter loot
     */
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $loot;
    /**
     * @todo liason avec entiter conditionEvent
     */
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $conditionEvent;

    /**
     * @ORM\Column(type="string", length=510, nullable=true)
     */
    private $texte;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imgSupTitre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imgSupUrl;



    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getMonstre(): ?string
    {
        return $this->monstre;
    }

    public function setMonstre(string $monstre): self
    {
        $this->monstre = $monstre;

        return $this;
    }

    public function getLoot(): ?string
    {
        return $this->loot;
    }

    public function setLoot(?string $loot): self
    {
        $this->loot = $loot;

        return $this;
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

    public function getImgSupTitre(): ?string
    {
        return $this->imgSupTitre;
    }

    public function setImgSupTitre(string $imgSupTitre): self
    {
        $this->imgSupTitre = $imgSupTitre;

        return $this;
    }

    public function getImgSupUrl(): ?string
    {
        return $this->imgSupUrl;
    }

    public function setImgSupUrl(string $imgSupUrl): self
    {
        $this->imgSupUrl = $imgSupUrl;

        return $this;
    }
}

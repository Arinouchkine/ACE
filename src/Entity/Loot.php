<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LootRepository")
 */
class Loot
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageLootName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageLootUrl;

    /**
     * @todo liason users many to many
     */

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

    public function getImageLootName(): ?string
    {
        return $this->imageLootName;
    }

    public function setImageLootName(?string $imageLootName): self
    {
        $this->imageLootName = $imageLootName;

        return $this;
    }

    public function getImageLootUrl(): ?string
    {
        return $this->imageLootUrl;
    }

    public function setImageLootUrl(?string $imageLootUrl): self
    {
        $this->imageLootUrl = $imageLootUrl;

        return $this;
    }
}

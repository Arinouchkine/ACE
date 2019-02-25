<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CaseMapEventTypeRepository")
 */
class CaseMapEventType
{
    use IdTrait;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\OneToOne(targetEntity="FileSave",cascade={"persist"})
     */
    private $imageLoot;


    /**
     * @ORM\ManyToMany(targetEntity="User",mappedBy="loots")
     */
    private $users;

    /**
     * @ORM\ManyToMany(targetEntity="CaseMapEvent", inversedBy="loots")
     */
    private $caseMapEvents;

    /**
     * @ORM\ManyToMany(targetEntity="Monstre", inversedBy="loots")
     */
    private $monstres;


    public function __construct()
    {
        $this->caseMapEvents = new  ArrayCollection();
        $this->monstres = new ArrayCollection();
        $this->users = new ArrayCollection();
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
    public function getImageLoot(): ?FileSave
    {
        return $this->imageLoot;
    }

    /**
     * @param FileSave $imageLoot
     * @return Loot
     */
    public function setImageLoot(FileSave $imageLoot): Loot
    {
        $this->imageLoot = $imageLoot;
        return $this;
    }



    /**
     * @param User $user
     * @return Loot
     */
    public function addUser(User $user):Loot
    {
        if ($this->users->contains($user))
        {
            return $this;
        }
        $this->users->add($user);
        $user->addLoot($this);
        return $this;

    }

    /**
     * @param User $user
     * @return Loot
     */
    public function removeUser(User $user):Loot
    {
        if (! $this->users->contains($user))
        {
            return $this;
        }
        $this->users->removeElement($user);
        $user->removeLoot($this);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param CaseMapEvent $caseMapEvent
     * @return Loot
     */
    public function addCaseMapEvent(CaseMapEvent $caseMapEvent): Loot
    {
        if ($this->caseMapEvents->contains($caseMapEvent))
        {
            return $this;
        }
        $this->caseMapEvents->add($caseMapEvent);
        $caseMapEvent->addLoot($this);
        return $this;
    }

    /**
     * @param CaseMapEvent $caseMapEvent
     * @return Loot
     */
    public function removeCaseMapEvent(CaseMapEvent $caseMapEvent): Loot
    {
        if (!$this->caseMapEvents->contains($caseMapEvent))
        {
            return $this;
        }
        $this->caseMapEvents->removeElement($caseMapEvent);
        $caseMapEvent->removeLoot($this);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCaseMapEvents()
    {
        return $this->caseMapEvents;
    }

    /**
     * @param Monstre $monstre
     * @return Loot
     */
    public function addMonstre(Monstre $monstre):Loot
    {
        if ($this->monstres->contains($monstre))
        {
            return $this;
        }
        $this->monstres->add($monstre);
        $monstre->addLoot($this);
        return $this;
    }

    /**
     * @param Monstre $monstre
     * @return Loot
     */
    public function removeMonstre(Monstre $monstre):Loot
    {
        if (!$this->monstres->contains($monstre))
        {
            return $this;
        }
        $this->monstres->removeElement($monstre);
        $monstre->removeLoot($this);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMonstres()
    {
        return $this->monstres;
    }


}

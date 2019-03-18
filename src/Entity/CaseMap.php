<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Self_;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CaseMapRepository")
 */
class CaseMap
{
    use IdTrait;
    /*
    *
     * Many Users have Many Groups.
     * @ManyToMany(targetEntity="Group", inversedBy="users")
     * @JoinTable(name="users_groups")
     *
    private $groups;

    public function __construct() {
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
    }

    *
     * Many Groups have Many Users.
     * @ManyToMany(targetEntity="User", mappedBy="groups")
     *
    private $users;

    public function __construct() {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    */
    /**
     * @ORM\ManyToMany(targetEntity="caseMapEvent", mappedBy="caseMaps")
     */
    private $caseMapEvents;


    /**
     * @todo liason avec caseMapType many to one
     */

    /**
     * @ORM\ManyToMany(targetEntity="CaseMapType", mappedBy="caseMaps")
     */
    private $caseMapTypes;

    /**
     * @todo liason monstre many to many
     */
    /**
     * @ORM\ManyToMany(targetEntity="Monstre", mappedBy="caseMaps")
     */
    private $monstres;

    public function __construct()
    {
        $this->caseMapEvents = new ArrayCollection();
        $this->caseMapTypes = new ArrayCollection();
        $this->monstres = new ArrayCollection();
    }

    /**
     * @param CaseMapEvent $caseMapEvent
     * @return CaseMap
     */
    public function addCaseMapEvent(CaseMapEvent $caseMapEvent):CaseMap
    {
        if ($this->caseMapEvents->contains($caseMapEvent))
        {
            return $this;
        }
        $this->caseMapEvents->add($caseMapEvent);
        /**
         * @todo addCaseMap in CaseMapEvent
         */
        $caseMapEvent->addCaseMap($this);
        return $this;
    }

    /**
     * @param CaseMapEvent $caseMapEvent
     * @return CaseMap
     */
    public function removeCaseMapEvent(CaseMapEvent $caseMapEvent):CaseMap
    {
        if (!$this->caseMapEvents->contains($caseMapEvent))
        {
            return $this;
        }
        $this->caseMapEvents->removeElement($caseMapEvent);
        /**
         * @todo removeCaseMap in CaseMapEvent
         */
        $caseMapEvent->removeCaseMap($this);
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
     * @param CaseMapType $caseMapType
     * @return CaseMap
     */
    public function addCaseMapType(CaseMapType $caseMapType):CaseMap
    {
        if ($this->caseMapTypes->contains($caseMapType))
        {
            return $this;
        }
        $this->caseMapTypes->add($caseMapType);
        /**
         * @todo addCaseMap in CaseMapType
         */
        $caseMapType->addCaseMap($this);
        return $this;
    }

    /**
     * @param CaseMapType $caseMapType
     * @return CaseMap
     */
    public function removeCaseMapType(CaseMapType $caseMapType):CaseMap
    {
        if(!$this->caseMapTypes->contains($caseMapType))
        {
            return $this;
        }
        $this->caseMapTypes->removeElement($caseMapType);
        /**
         * @todo removeCaseMap in CaseMapType
         */
        $caseMapType->removeCaseMap($this);
        return $this;

    }

    /**
     * @return mixed
     */
    public function getCaseMapTypes()
    {
        return $this->caseMapTypes;
    }

    /**
     * @param Monstre $monstre
     * @return CaseMap
     */
    public function addMonstre(Monstre $monstre):CaseMap
    {
        if ($this->monstres->contains($monstre))
        {
            return $this;
        }
        $this->monstres->add($monstre);
        /**
         * @todo addCaseMap in Monstre
         */
        $monstre->addCaseMap($this);
        return $this;

    }

    /**
     * @param Monstre $monstre
     * @return CaseMap
     */
    public function removeMonstre(Monstre $monstre):CaseMap
    {
        if (!$this->monstres->contains($monstre))
        {
            return $this;
        }
        $this->monstres->removeElement($monstre);
        /**
         * @todo removeCaseMap in Monstre
         */
        $monstre->removeCaseMap($this);
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

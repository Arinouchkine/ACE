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

    /**
     * @ORM\ManyToMany(targetEntity="caseMapEvent", mappedBy="caseMaps")
     */
    private $caseMapEvents;



    /**
     * @ORM\ManyToOne(targetEntity="CaseMapType", inversedBy="caseMaps")
     */
    private $caseMapType;



    public function __construct()
    {
        $this->caseMapEvents = new ArrayCollection();

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
    public function setCaseMapType(CaseMapType $caseMapType):CaseMap
    {
        $this->caseMapType = $caseMapType;
        /**
         * @todo addCaseMap in CaseMapType
         */
        $caseMapType->addCaseMap($this);
        return $this;
    }


    /**
     * @return mixed
     */
    public function getCaseMapType()
    {
        return $this->caseMapType;
    }





}

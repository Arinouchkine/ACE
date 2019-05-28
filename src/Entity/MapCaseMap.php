<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MapCaseMapRepository")
 */
class MapCaseMap
{
    use IdTrait;

    /**
     * @var caseMap
     * @ORM\ManyToOne(targetEntity="CaseMap")
     */
    private $caseMap;

    /**
     * @var map
     * @ORM\ManyToOne(targetEntity="Map")
     */
    private $map;

    /**
     * @ORM\Column(type="integer")
     */
    private $lat;

    /**
     * @ORM\Column(type="integer")
     */
    private $lng;


    public function getLat(): ?int
    {
        return $this->lat;
    }

    public function setLat(int $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLng(): ?int
    {
        return $this->lng;
    }

    public function setLng(int $lng): self
    {
        $this->lng = $lng;

        return $this;
    }

    /**
     * @return caseMap
     */
    public function getCaseMap(): caseMap
    {
        return $this->caseMap;
    }

    /**
     * @param caseMap $caseMap
     */
    public function setCaseMap(caseMap $caseMap): void
    {
        $this->caseMap = $caseMap;
    }

    /**
     * @return map
     */
    public function getMap(): map
    {
        return $this->map;
    }

    /**
     * @param map $map
     */
    public function setMap(map $map): void
    {
        $this->map = $map;
    }



}

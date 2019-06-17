<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MapRepository")
 */
class Map
{
    use IdTrait;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var mapCaseMap
     * @ORM\OneToMany(targetEntity="MapCaseMap", mappedBy="map")
     */
    private $mapCaseMaps;

    public function __construct()
    {
        $this->mapCaseMaps = new ArrayCollection();
    }


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function addMapCaseMap(MapCaseMap $mapCaseMap){
        if($this->mapCaseMaps->contains($mapCaseMap)){
            return ;
        }
        $this->mapCaseMaps->add($mapCaseMap);
    }

    public function remouveMapCaseMap(MapCaseMap $mapCaseMap)
    {
        if(!$this->mapCaseMaps->contains($mapCaseMap)){
            return ;
        }
        $this->mapCaseMaps->removeElement($mapCaseMap);
    }
}

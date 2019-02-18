<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CaseMapRepository")
 */
class CaseMap
{
    use IdTrait;
}

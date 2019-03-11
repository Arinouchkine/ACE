<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CaseMapRepository")
 */
class CaseMap
{
    use IdTrait;

    /**
     * @todo liason avec caseMapEvent many to many
     */

    /**
     * @todo liason avec caseMapType many to one
     */


    /**
     * @todo liason monstre many to many
     */



}

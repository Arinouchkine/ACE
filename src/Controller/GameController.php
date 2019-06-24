<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 23/06/2019
 * Time: 23:03
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class GameController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function connexion(AuthenticationUtils $utils){

        return $this->render('Game/game.html.twig',[
        ]);
    }
}
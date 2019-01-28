<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 28/11/2018
 * Time: 09:59
 */

namespace App\Controller;

/**
 * @Route("/admin")
 */

use App\Entity\User;
use App\Form\Type\UserRoleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route()
     */
    public function index()
    {

        $em = $this->getDoctrine()->getManager();

        $userRepo = $em->getRepository(User::class);

        $users = $userRepo->findAll();

        return $this->render('admin/index.html.twig',[
            'users'=>$users,
        ]);
    }

    /**
     * @Route("/userMod/{id}")
     */
    public function userMod(Request $request, User $user)
    {
        $form = $this->createForm(UserRoleType::class,$user);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('app_admin_index');
        }
        return $this->render('admin/user_mod.html.twig',[
            'form' => $form->createView(),
        ]);
    }
}
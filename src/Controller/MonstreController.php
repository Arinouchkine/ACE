<?php

namespace App\Controller;

use App\Entity\Monstre;
use App\Form\Type\MonstreFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class MonstreController
 * @package App\Controller
 *
 */
class MonstreController extends AbstractController
{

    /*
     * @Route("/monstre", name="monstre")
     */
    /*
    public function index()
    {
        return $this->render('monstre/index.html.twig', [
            'controller_name' => 'MonstreController',
        ]);
    }
    */

    /**
     * @Route("/monstre/add", name="createMonstre")
     */

    public function createMonstreAction(Request $request)
    {
        $monstre = new Monstre();

        $form = $this->createForm(MonstreFormType::class, $monstre);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($monstre);
            $em->flush();

            return $this->redirectToRoute('listMonstre');
        }
        return $this->render('Monstre/create.html.twig',[
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/monstre/edit/{id]", name="editMonstre")
     */

    public function editMonstreAction(Request $request , Monstre $monstre)
    {
        $form = $this->createForm(LootFormType::class, $monstre);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($monstre);
            $em->flush();

            return $this->redirectToRoute('listMonstre');
        }
        return $this->render('Monstre/create.html.twig',[
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/monstre/list", name="listMonstre" )
     */
    public function listmonstreAction(){
        $em=$this->getDoctrine()->getManager();
        $monstreRepository = $em->getRepository(Monstre::class);

        $monstres = $monstreRepository->findAll();


        return $this->render('Monstre/index.html.twig', [
            'monstres' => $monstres,
        ]);
    }

    /**
     * @Route("/monstre/{id}/supprimer", requirements={"id":"\d+"}, name="deleteMonstre")
     */
    public function deleteMonstreAction(Monstre $monstre,Request $request)
    {

        $token = $request->query->get('token');
        if (!$this->isCsrfTokenValid('MONSTRE_DELETE',$token))
        {
            throw $this->createAccessDeniedException();
        }

        $em=$this->getDoctrine()->getManager();
        $em->remove($monstre);
        $em->flush();
        return $this->redirectToRoute('listMonstre');
    }
}

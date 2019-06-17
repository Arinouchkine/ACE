<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 15/06/2019
 * Time: 16:59
 */

namespace App\Controller;


use App\Entity\Map;
use App\Form\Type\MapFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MapController
 * @package App\Controller
 *
 * @Route("/admin")
 */
class MapController extends AbstractController
{
    /**
     * @Route("/map/add", name="createMap")
     */

    public function createMapAction(Request $request)
    {
        $map = new Map();

        $form = $this->createForm(MapFormType::class, $map);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($map);
            $em->flush();

            return $this->redirectToRoute('listMap');
        }
        return $this->render('Map/create.html.twig',[
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/map/edit/{id}", name="editMap")
     */

    public function editMapAction(Request $request , Map $map)
    {
        $form = $this->createForm(MapFormType::class, $map);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($map);
            $em->flush();

            return $this->redirectToRoute('listMap');
        }
        return $this->render('Map/create.html.twig',[
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/map/list", name="listMap" )
     */
    public function listMapAction(){
        $em=$this->getDoctrine()->getManager();
        $mapRepository = $em->getRepository(Map::class);

        $maps = $mapRepository->findAll();


        return $this->render('Map/index.html.twig', [
            'maps' => $maps,
        ]);
    }

    /**
     * @Route("/map/{id}/supprimer", requirements={"id":"\d+"}, name="deleteMap")
     */
    public function deleteMapAction(Map $map,Request $request)
    {

        $token = $request->query->get('token');
        if (!$this->isCsrfTokenValid('MAP_DELETE',$token))
        {
            throw $this->createAccessDeniedException();
        }

        $em=$this->getDoctrine()->getManager();
        $em->remove($map);
        $em->flush();
        return $this->redirectToRoute('listMap');
    }
}
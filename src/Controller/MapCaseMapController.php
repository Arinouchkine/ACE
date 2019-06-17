<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 15/06/2019
 * Time: 17:00
 */

namespace App\Controller;


use App\Entity\MapCaseMap;
use App\Form\Type\MapCaseMapFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class MapCaseMapController
 * @package App\Controller
 *
 * @Route("/admin")
 */
class MapCaseMapController extends AbstractController
{
    /**
     * @Route("/mapCaseMap/add", name="createMapCaseMap")
     */

    public function createMapCaseMapAction(Request $request)
    {
        $mapCaseMap = new MapCaseMap();

        $form = $this->createForm(MapCaseMapFormType::class, $mapCaseMap);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($mapCaseMap);
            $em->flush();

            return $this->redirectToRoute('listMapCaseMap');
        }
        return $this->render('MapCaseMap/create.html.twig',[
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/mapCaseMap/edit/{id}", name="editMapCaseMap")
     */

    public function editMapCaseMapAction(Request $request , MapCaseMap $mapCaseMap)
    {
        $form = $this->createForm(MapCaseMapFormType::class, $mapCaseMap);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($mapCaseMap);
            $em->flush();

            return $this->redirectToRoute('listMapCaseMap');
        }
        return $this->render('MapCaseMap/create.html.twig',[
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/mapCaseMap/list", name="listMapCaseMap" )
     */
    public function listMapCaseMapAction(){
        $em=$this->getDoctrine()->getManager();
        $mapCaseMapRepository = $em->getRepository(MapCaseMap::class);

        $mapCaseMaps = $mapCaseMapRepository->findAll();


        return $this->render('MapCaseMap/index.html.twig', [
            'mapCaseMaps' => $mapCaseMaps,
        ]);
    }

    /**
     * @Route("/mapCaseMap/{id}/supprimer", requirements={"id":"\d+"}, name="deleteMapCaseMap")
     */
    public function deleteMapCaseMapAction(MapCaseMap $mapCaseMap,Request $request)
    {

        $token = $request->query->get('token');
        if (!$this->isCsrfTokenValid('MAPCASEMAP_DELETE',$token))
        {
            throw $this->createAccessDeniedException();
        }

        $em=$this->getDoctrine()->getManager();
        $em->remove($mapCaseMap);
        $em->flush();
        return $this->redirectToRoute('listMapCaseMap');
    }
}
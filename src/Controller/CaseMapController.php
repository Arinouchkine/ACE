<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 21/04/2019
 * Time: 16:11
 */

namespace App\Controller;


use App\Entity\CaseMap;
use App\Form\Type\CaseMapFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CaseMapController
 * @package App\Controller
 *
 * @Route("/admin")
 */

class CaseMapController extends AbstractController
{
    /**
     * @Route("/case-map/add", name="createCaseMap")
     */

    public function createCaseMapAction(Request $request)
    {
        $caseMap = new CaseMap();

        $form = $this->createForm(CaseMapFormType::class, $caseMap);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($caseMap);
            $em->flush();

            return $this->redirectToRoute('listCaseMap');
        }
        return $this->render('CaseMap/create.html.twig',[
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/case-map/edit/{id}", name="editCaseMap")
     */

    public function editCaseMapAction(Request $request , CaseMap $caseMap)
    {
        $form = $this->createForm(CaseMapFormType::class, $caseMap);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($caseMap);
            $em->flush();

            return $this->redirectToRoute('listCaseMap');
        }
        return $this->render('CaseMap/create.html.twig',[
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/case-map/list", name="listCaseMap" )
     */
    public function listCaseMapAction(){
        $em=$this->getDoctrine()->getManager();
        $caseMapRepository = $em->getRepository(CaseMap::class);

        $caseMaps = $caseMapRepository->findAll();


        return $this->render('CaseMap/index.html.twig', [
            'caseMaps' => $caseMaps,
        ]);
    }

    /**
     * @Route("/case-map/{id}/supprimer", requirements={"id":"\d+"}, name="deleteCaseMap")
     */
    public function deleteCaseMapAction(CaseMap $caseMap,Request $request)
    {

        $token = $request->query->get('token');
        if (!$this->isCsrfTokenValid('CASEMAP_DELETE',$token))
        {
            throw $this->createAccessDeniedException();
        }

        $em=$this->getDoctrine()->getManager();
        $em->remove($caseMap);
        $em->flush();
        return $this->redirectToRoute('listCaseMap');
    }
}
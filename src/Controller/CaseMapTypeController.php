<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 21/04/2019
 * Time: 16:13
 */

namespace App\Controller;


use App\Entity\CaseMapType;
use App\Form\Type\CaseMapTypeFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CaseMapTypeController
 * @package App\Controller
 *
 * @Route("/admin")
 */

class CaseMapTypeController extends AbstractController
{
    /**
     * @Route("/case-map/type/add", name="createCaseMapType")
     */

    public function createCaseMapTypeAction(Request $request)
    {
        $caseMapType = new CaseMapType();

        $form = $this->createForm(CaseMapTypeFormType::class, $caseMapType);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($caseMapType);
            $em->flush();

            return $this->redirectToRoute('listCaseMapType');
        }
        return $this->render('CaseMapType/create.html.twig',[
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/case-map/type/edit/{id]", name="editCaseMapType")
     */

    public function editCaseMapTypeAction(Request $request , CaseMapType $caseMapType)
    {
        $form = $this->createForm(CaseMapTypeFormType::class, $caseMapType);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($caseMapType);
            $em->flush();

            return $this->redirectToRoute('listCaseMapType');
        }
        return $this->render('CaseMapType/create.html.twig',[
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/case-map/type/list", name="listCaseMapType" )
     */
    public function listCaseMapTypeAction(){
        $em=$this->getDoctrine()->getManager();
        $caseMapTypeRepository = $em->getRepository(CaseMapType::class);

        $caseMapTypes = $caseMapTypeRepository->findAll();


        return $this->render('CaseMapType/index.html.twig', [
            'caseMapTypes' => $caseMapTypes,
        ]);
    }

    /**
     * @Route("/case-map/type/{id}/supprimer", requirements={"id":"\d+"}, name="deleteCaseMapType")
     */
    public function deleteCaseMapTypeAction(CaseMapType $caseMapType,Request $request)
    {

        $token = $request->query->get('token');
        if (!$this->isCsrfTokenValid('CASEMAPTYPE_DELETE',$token))
        {
            throw $this->createAccessDeniedException();
        }

        $em=$this->getDoctrine()->getManager();
        $em->remove($caseMapType);
        $em->flush();
        return $this->redirectToRoute('listCaseMapType');
    }
}
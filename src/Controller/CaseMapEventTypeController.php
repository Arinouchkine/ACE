<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 21/04/2019
 * Time: 16:12
 */

namespace App\Controller;


use App\Entity\CaseMapEventType;
use App\Form\Type\CaseMapEventTypeFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CaseMapEventTypeController
 * @package App\Controller
 *
 * @Route("/admin")
 */

class CaseMapEventTypeController extends AbstractController
{
    /**
     * @Route("/case-map/event-type/add", name="createCaseMapEventType")
     */

    public function createCaseMapEventTypeAction(Request $request)
    {
        $caseMapEventType = new CaseMapEventType();

        $form = $this->createForm(CaseMapEventTypeFormType::class, $caseMapEventType);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($caseMapEventType);
            $em->flush();

            return $this->redirectToRoute('listCaseMapEventType');
        }
        return $this->render('CaseMapEventType/create.html.twig',[
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/case-map/event-type/edit/{id]", name="editCaseMapEventType")
     */

    public function editCaseMapEventTypeAction(Request $request , CaseMapEventType $caseMapEventType)
    {
        $form = $this->createForm(CaseMapEventTypeFormType::class, $caseMapEventType);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($caseMapEventType);
            $em->flush();

            return $this->redirectToRoute('listCaseMapEventType');
        }
        return $this->render('CaseMapEventType/create.html.twig',[
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/case-map/event-type/list", name="listCaseMapEventType" )
     */
    public function listCaseMapEventTypeAction(){
        $em=$this->getDoctrine()->getManager();
        $caseMapEventTypeRepository = $em->getRepository(CaseMapEventType::class);

        $caseMapEventTypes = $caseMapEventTypeRepository->findAll();


        return $this->render('CaseMapEventType/index.html.twig', [
            'caseMapEventTypes' => $caseMapEventTypes,
        ]);
    }

    /**
     * @Route("/case-map/event/{id}/supprimer", requirements={"id":"\d+"}, name="deleteCaseMapEventType")
     */
    public function deleteCaseMapEventTypeAction(CaseMapEventType $caseMapEventType,Request $request)
    {

        $token = $request->query->get('token');
        if (!$this->isCsrfTokenValid('CASEMAPEVENTTYPE_DELETE',$token))
        {
            throw $this->createAccessDeniedException();
        }

        $em=$this->getDoctrine()->getManager();
        $em->remove($caseMapEventType);
        $em->flush();
        return $this->redirectToRoute('listCaseMapEventType');
    }
}
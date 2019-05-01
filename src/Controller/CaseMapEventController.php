<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 21/04/2019
 * Time: 16:12
 */

namespace App\Controller;


use App\Entity\CaseMapEvent;
use App\Form\Type\CaseMapEventFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CaseMapEventController
 * @package App\Controller
 *
 * @Route("/admin")
 */

class CaseMapEventController extends AbstractController
{
    /**
     * @Route("/case-map/event/add", name="createCaseMapEvent")
     */

    public function createCaseMapEventAction(Request $request)
    {
        $caseMapEvent = new CaseMapEvent();

        $form = $this->createForm(CaseMapEventFormType::class, $caseMapEvent);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($caseMapEvent);
            $em->flush();

            return $this->redirectToRoute('listCaseMapEvent');
        }
        return $this->render('CaseMapEvent/create.html.twig',[
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/case-map/event/edit/{id]", name="editCaseMapEvent")
     */

    public function editCaseMapEventAction(Request $request , CaseMapEvent $caseMapEvent)
    {
        $form = $this->createForm(CaseMapEventFormType::class, $caseMapEvent);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($caseMapEvent);
            $em->flush();

            return $this->redirectToRoute('listCaseMapEvent');
        }
        return $this->render('CaseMapEvent/create.html.twig',[
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/case-map/event/list", name="listCaseMapEvent" )
     */
    public function listCaseMapEventAction(){
        $em=$this->getDoctrine()->getManager();
        $caseMapEventRepository = $em->getRepository(CaseMapEvent::class);

        $caseMapEvents = $caseMapEventRepository->findAll();


        return $this->render('CaseMapEvent/index.html.twig', [
            'caseMapEvents' => $caseMapEvents,
        ]);
    }

    /**
     * @Route("/case-map/event/{id}/supprimer", requirements={"id":"\d+"}, name="deleteCaseMapEvent")
     */
    public function deleteCaseMapEventAction(CaseMapEvent $caseMapEvent,Request $request)
    {

        $token = $request->query->get('token');
        if (!$this->isCsrfTokenValid('CASEMAPEVENT_DELETE',$token))
        {
            throw $this->createAccessDeniedException();
        }

        $em=$this->getDoctrine()->getManager();
        $em->remove($caseMapEvent);
        $em->flush();
        return $this->redirectToRoute('listCaseMapEvent');
    }
}
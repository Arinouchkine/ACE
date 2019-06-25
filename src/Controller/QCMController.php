<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 04/12/2018
 * Time: 14:01
 */

namespace App\Controller;


use App\Entity\QCM;
use App\Entity\QCMChoice;
use App\Entity\QCMPrime;
use App\Form\Type\QCMType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class QCMController
 * @package App\Controller
 *
 * @Route("/modo")
 */

class QCMController extends AbstractController
{
    /**
     *
     * @Route("/create/from/qcmprime/{id}")
     */

    public function createFromQCMPrime(Request $request,QCMPrime $QCMPrime)
    {
        $token = $request->query->get('token');
        $em = $this->getDoctrine()->getManager();
        $qcm = new QCM();
        foreach($QCMPrime->getChoices() as $choice)
        {
            $qcmchoice = new QCMChoice();
            $qcmchoice->setAnswer($choice->getAnswer());
            $qcmchoice->setValidation($choice->isValidation());
            $qcm->addChoices($qcmchoice);
            $qcmchoice->setQcm($qcm);
            $em->persist($qcmchoice);
        }
        $qcm->setExplication($QCMPrime->getExplication());
        $qcm->setQuestion($QCMPrime->getQuestion());

        $form = $this->createForm(QCMType::class, $qcm);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()) {

            $em->persist($qcm);
            $em->flush();

            return $this->redirectToRoute('app_qcmprime_delete',["id"=>$QCMPrime->getId(),"token"=>$token]);
        }



        return $this->render('qcm/create.html.twig',[
            'form'=>$form->createView(),
        ]);
    }

    /**
     *
     * @Route("/qcm-list")
     *
     */
    public function index(){
        $em=$this->getDoctrine()->getManager();
        $qcmRepository = $em->getRepository(QCM::class);

        $qcms = $qcmRepository->findAll();


        return $this->render('qcm/index.html.twig', [
            'qcms' => $qcms,
        ]);
    }

}
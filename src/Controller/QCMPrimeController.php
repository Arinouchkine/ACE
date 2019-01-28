<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 27/11/2018
 * Time: 14:33
 */

namespace App\Controller;


use App\Entity\QCMChoice;
use App\Entity\QCMPrime;
use App\Entity\Vote;
use App\Form\Type\QCMPrimeType;
use App\Form\Type\TestQCMType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class QCMPrimeController
 * @package App\Controller
 *
 * @Route("/QCM-test")
 *
 */

class QCMPrimeController extends AbstractController
{
    /**
     *
     * @Route("/create")
     *
     */
    public function create(Request $request){
        $qcmPrime = new QCMPrime();
        $form = $this->createForm(QCMPrimeType::class, $qcmPrime);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($qcmPrime);
            $em->flush();
            return $this->redirectToRoute('app_qcmprime_index');
        }

        return $this->render('qcmprime/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route()
     * @Route("/show-list")
     *
     */
    public function index(){
        $em = $this->getDoctrine()->getManager();
        $qcmPrimRepo = $em->getRepository(QCMPrime::class);
        if($this->isGranted('ROLE_MODO'))
        {
            $qcmPrims = $qcmPrimRepo->findBy(
                [],
                ['rating'=>'DESC']
            );
        }
        else
        {
            $qcmPrims = $qcmPrimRepo->findAll();
        }



        return $this->render('qcmprime/show_list.html.twig',[
            'qcmPrims'=>$qcmPrims,
        ]);
    }

    /**
     *
     * @Route("/modif/{id}")
     *
     *
     */
    public function modif(Request $request, QCMPrime $qcmPrime)
    {
        $form = $this->createForm(QCMPrimeType::class, $qcmPrime);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($qcmPrime);
            $em->flush();
            return $this->redirectToRoute('app_qcmprime_index');
        }

        return $this->render('qcmprime/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     *
     * @Route("/test/{id}")
     *
     */
    public function test(Request $request, QCMPrime $QCMPrime)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $voteRepo = $em->getRepository(Vote::class);
        $buttons = $voteRepo->findBy(['user'=>$user,'QCMPrime'=>$QCMPrime])===array()?true:false;
        $label = $QCMPrime->getQuestion();
        $options = array();
        $choices = array();
        foreach ($QCMPrime->getChoices()->toArray() as $choice)
        {

            /**
             * @var QCMChoice $choice
             */
            $options[$choice->getAnswer()]= $choice->isValidation();

            $choices[$choice->getId()]=$choice->isValidation();

        }
        $form = $this->createForm(TestQCMType::class, null, [
            'label'=>$label,
            'options'=>$options
        ]);


        $form->handleRequest($request);

        if($form->isSubmitted())
        {

            $result = $form->getData();
            return $this->render('qcmprime/test.html.twig', [
                'form' => $form->createView(),
                'question'=> $QCMPrime->getQuestion(),
                'explication'=> $QCMPrime->getExplication(),
                'id'=>$QCMPrime->getId(),
                'buttons'=>$buttons,
            ]);
        }


        return $this->render('qcmprime/test.html.twig', [
            'form' => $form->createView(),
            'question'=> $QCMPrime->getQuestion(),
            'id'=>$QCMPrime->getId(),
            'buttons'=>$buttons,
        ]);
    }


    /**
     * @param QCMPrime $QCMPrime
     *
     * @Route("/qcmprime/positive/vote/{id}/yes")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function votingP(QCMPrime $QCMPrime)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $voteRepo = $em->getRepository(Vote::class);
        if ($voteRepo->findBy(['user'=>$user,'QCMPrime'=>$QCMPrime])===array())
        {
            $rating = $QCMPrime->getRating();
            $ratingN = $QCMPrime->getRatingN();
            $rating  = ($rating * $ratingN + 1)/($ratingN+1);
            $ratingN++;
            $QCMPrime->setRating($rating);
            $QCMPrime->setRatingN($ratingN);
            $vote = new Vote();
            $vote->setUser($user);
            $vote->setQCMPrime($QCMPrime);
            $vote->setVote(true);
            $em->persist($QCMPrime);
            $em->persist($vote);
            $em->flush();
        }
       return $this->redirectToRoute('app_qcmprime_index');
    }

    /**
     * @param QCMPrime $QCMPrime
     *
     * @Route("/qcmprime/negative/vote/{id}/no")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function votingN(QCMPrime $QCMPrime)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $voteRepo = $em->getRepository(Vote::class);
        if ($voteRepo->findBy(['user'=>$user,'QCMPrime'=>$QCMPrime])===array())
        {
            $rating = $QCMPrime->getRating();
            $ratingN = $QCMPrime->getRatingN();
            $rating  = ($rating * $ratingN - 1)/($ratingN+1);
            $ratingN++;
            $QCMPrime->setRating($rating);
            $QCMPrime->setRatingN($ratingN);
            $vote = new Vote();
            $vote->setUser($user);
            $vote->setQCMPrime($QCMPrime);
            $vote->setVote(false);
            $em->persist($QCMPrime);
            $em->persist($vote);
            $em->flush();
        }
        return $this->redirectToRoute('app_qcmprime_index');
    }

    /**
     * @Route("/{id}/supprimer", requirements={"id":"\d+"})
     */
    public function delete(QCMPrime $QCMPrime,Request $request)
    {

        $token = $request->query->get('token');
        if (!$this->isCsrfTokenValid('QCMPRIME_DELETE',$token))
        {
            throw $this->createAccessDeniedException();
        }
        if ($this->getUser()!==$QCMPrime->getUser()&&(!$this->isGranted('ROLE_MODO')))
        {
            throw $this->createAccessDeniedException();
        }
        $em=$this->getDoctrine()->getManager();
        $em->remove($QCMPrime);
        $em->flush();
        return $this->redirectToRoute('app_qcmprime_index');
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 22/06/2019
 * Time: 13:54
 */

namespace App\Controller;


use App\Entity\Battle;
use App\Entity\Map;
use App\Entity\Monstre;
use App\Entity\QCM;
use App\Entity\QCMChoice;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\FOSRestBundle;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;

/**
 * @Route("/api")
 */
class MapAPIController extends FOSRestBundle
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    /**
     * @return JsonResponse
     *
     * @Rest\Route("/test")
     */
    public function getTestAction()
    {

        $formatted = [];

        $formatted[] = [
            'id' => 'testId',
            'name' => 'testName',
            'address' => 'testAdress',
        ];


        return new JsonResponse($formatted);
    }

    /**
     * @return JsonResponse
     *
     * @Rest\Route("/test2/{id}")
     */
    public function getFieldsetAction($id)
    {
      /*  $em = $this->getDoctrine()->getManager();

        $MapRepo = $em->getRepository(Map::class);*/


        $formatted = [];
        $formatted[] = [
            'id' => $id,
            'name' => 'testName',
            'address' => 'testAdress',
        ];


        return new JsonResponse($formatted);
    }


    /**
     * @return JsonResponse
     *
     * @Rest\Route("/battle/{id}")
     */
    public function getBattleAction(Monstre $monstre){

        $repo = $this->em->getRepository(QCM::class);

        $battle = new Battle();

        $battle->setQuestionE($monstre->getNbrEasyQuestion());
        $battle->setQuestionM($monstre->getNbrMediumQuestion());
        $battle->setQuestionH($monstre->getNbrHardQuestion());
        $battle->setHealth(3);
        $this->em->persist($battle);
        $this->em->flush();
        $question = null;
        $win = false;
        if($battle->getQuestionE()>0)
        {
            $question =  $this->getQuestion(1);
            $nmb = $battle->getQuestionE() - 1;
            $battle->setQuestionE($nmb);
            $this->em->persist($battle);
            $this->em->flush();
        }
        elseif ($battle->getQuestionM()>0)
        {
            $question =  $this->getQuestion(2);
            $nmb = $battle->getQuestionM() - 1;
            $battle->setQuestionM($nmb);
            $this->em->persist($battle);
            $this->em->flush();
        }
        elseif($battle->getQuestionH()>0)
        {
            $question =  $this->getQuestion(3);
            $nmb = $battle->getQuestionH() - 1;
            $battle->setQuestionH($nmb);
            $this->em->persist($battle);
            $this->em->flush();
        }
        else
        {
            $win = true;
        }
        $formatted = [
            'id-battle'=>$battle->getId(),
            'win' => $win,
            'question' => $question,
        ];

        return new JsonResponse($formatted);
    }
    /**
     * @return JsonResponse
     *
     * @Rest\Route("/battleNext/{id}/{id2}")
     *
     * @Entity("battle", expr="repository.find(id2)")
     * @Entity("qcmchoice", expr="repository.find(id)")
     */
    public function getBattleNextAction(Battle $battle, QCMChoice $QCMChoice){


        $question = null;
        $win = false;
        $gameover = false;
        if($QCMChoice->isValidation())
        {
            $round = true;

        }
        else{
            $round = false;
            $nh = $battle->getHealth()-1;
            if ( $nh < 1)
            {
                $gameover = true;
            }
            $battle->setHealth($nh);
            $this->em->persist($battle);
            $this->em->flush();
        }
        if($battle->getQuestionE()>0)
        {
            $question =  $this->getQuestion(1);
            if($round)
            {
                $nmb = $battle->getQuestionE() - 1;
                $battle->setQuestionE($nmb);
                $this->em->persist($battle);
                $this->em->flush();
            }

        }
        elseif ($battle->getQuestionM()>0)
        {
            $question =  $this->getQuestion(2);
            if($round) {
                $nmb = $battle->getQuestionM() - 1;
                $battle->setQuestionM($nmb);
                $this->em->persist($battle);
                $this->em->flush();
            }
        }
        elseif($battle->getQuestionH()>0)
        {
            $question =  $this->getQuestion(3);
            if($round) {
                $nmb = $battle->getQuestionH() - 1;
                $battle->setQuestionH($nmb);
                $this->em->persist($battle);
                $this->em->flush();
            }
        }
        else
        {
            $win = true;
        }
        $formatted = [
            'id-battle'=>$battle->getId(),
            'win' => $win,
            'question' => $question,
            'round' => $round,
            'gameover'=>$gameover,
            'health'=>$battle->getHealth(),
        ];

        if($gameover || $win)
        {
            $this->em->remove($battle);
            $this->em->flush();
        }

        return new JsonResponse($formatted);
    }


    private function getQuestion($diff)
    {
        $repo = $this->em->getRepository(QCM::class);
        $question = $repo->getOneQuestionByDifficulty($diff)[0];

        /**
        * @var QCM $question
         */

        $ret = [];

        $ret['question'] = $question->getQuestion();
        $ret['explication'] = $question->getExplication();
        $ret['theme'] = $question->getTheme();
        foreach($question->getChoices() as $num => $choice)
        {
            /**
             *  @var QCMChoice $choice
             */
            $ret['choice'][$num]['answer'] = $choice->getAnswer();
            $ret['choice'][$num]['id'] = $choice->getId();
        }

        return $ret;

    }
}
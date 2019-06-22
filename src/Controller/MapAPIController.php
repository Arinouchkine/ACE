<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 22/06/2019
 * Time: 13:54
 */

namespace App\Controller;


use App\Entity\Map;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\FOSRestBundle;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class MapAPIController extends FOSRestBundle
{
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
     * @Rest\Route("/test")
     */
    public function getFieldsetAction()
    {
        $em = $this->getDoctrine()->getManager();

        $MapRepo = $em->getRepository(Map::class);

        $formatted = [];

        $formatted[] = [
            'id' => 'testId',
            'name' => 'testName',
            'address' => 'testAdress',
        ];


        return new JsonResponse($formatted);
    }

}
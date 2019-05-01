<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 21/04/2019
 * Time: 16:13
 */

namespace App\Controller;


use App\Entity\Loot;
use App\Form\Type\LootFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LootController
 * @package App\Controller
 *
 * @Route("/admin")
 */
class LootController extends AbstractController
{
    /**
     * @Route("/loot/add", name="createLoot")
     */

    public function createLootAction(Request $request)
    {
        $loot = new Loot();

        $form = $this->createForm(LootFormType::class, $loot);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($loot);
            $em->flush();

            return $this->redirectToRoute('listLoot');
        }
        return $this->render('Loot/create.html.twig',[
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/loot/edit/{id}", name="editLoot")
     */

    public function editLootAction(Request $request , Loot $loot)
    {
        $form = $this->createForm(LootFormType::class, $loot);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($loot);
            $em->flush();

            return $this->redirectToRoute('listLoot');
        }
        return $this->render('Loot/create.html.twig',[
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/loot/list", name="listLoot" )
     */
    public function listLootAction(){
        $em=$this->getDoctrine()->getManager();
        $lootRepository = $em->getRepository(Loot::class);

        $loots = $lootRepository->findAll();


        return $this->render('Loot/index.html.twig', [
            'loots' => $loots,
        ]);
    }

    /**
     * @Route("/loot/{id}/supprimer", requirements={"id":"\d+"}, name="deleteLoot")
     */
    public function deleteLootAction(Loot $loot,Request $request)
    {

        $token = $request->query->get('token');
        if (!$this->isCsrfTokenValid('LOOT_DELETE',$token))
        {
            throw $this->createAccessDeniedException();
        }

        $em=$this->getDoctrine()->getManager();
        $em->remove($loot);
        $em->flush();
        return $this->redirectToRoute('listLoot');
    }
}
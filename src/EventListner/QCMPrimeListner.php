<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 27/11/2018
 * Time: 15:38
 */

namespace App\EventListner;


use App\Entity\QCMPrime;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class QCMPrimeListner
{
    /**
     * @var TokenStorage
     */
    private $token;

    public function __construct(TokenStorage $token)
    {
        $this->token = $token;
    }


    public function prePersist(LifecycleEventArgs $args){
        $entity = $args->getObject();

        if (!$entity instanceof QCMPrime) {
            return;
        }

        $entity->setRating(0);
        $entity->setRatingN(0);
        $entity->setUser($this->token->getToken()->getUser());
        $em = $args->getObjectManager();
    }
}
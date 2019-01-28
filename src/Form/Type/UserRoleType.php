<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 04/12/2018
 * Time: 10:06
 */

namespace App\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class UserRoleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('role',ChoiceType::class,[
            'label'=>'Le role de user',
            'choices'=>[
                'Admin' => 3,
                'Moderateur'=>2,
                'User'=>1,
            ],
        ]);
    }

}
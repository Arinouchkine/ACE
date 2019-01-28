<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 04/12/2018
 * Time: 13:58
 */

namespace App\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class QCMType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('difficulty', NumberType::class,[
            'label'=>'Difficulter de la question'
        ])
        ->add('theme', TextType::class,[
            'label'=>'Theme de la question'
        ]);
    }


}
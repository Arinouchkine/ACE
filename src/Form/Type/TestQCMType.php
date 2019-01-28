<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 30/11/2018
 * Time: 15:59
 */

namespace App\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsFalse;
use Symfony\Component\Validator\Constraints\IsTrue;

class TestQCMType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        foreach ($options['options'] as $key => $option)
        {
            $builder->add($key,CheckboxType::class,[
                'label'=>$key,
                'mapped'=>false,
                'required'=>false,
                'constraints' => [$option? new IsTrue(["message" =>"C'est une bonne reponse"]):new IsFalse(["message"=>"C'est une mauvaise reponse"]),],
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'label' => 'Explication de la reponse',
            'options'=> array('1'=>'reponse'),
        ]);
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 28/11/2018
 * Time: 15:12
 */

namespace App\Form\Type;


use App\Entity\QCMChoice;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QCMChoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('answer', TextType::class,[
            'label'=>'La reponse'
        ])
            ->add('validation', ChoiceType::class,[
                'label'=>'La reponse est valide?',
                'choices'  => array(
                            'Yes' => true,
                            'No' => false,
                        ),
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'=> QCMChoice::class,
        ));
    }

}
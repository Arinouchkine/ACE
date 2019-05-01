<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 18/04/2019
 * Time: 22:12
 */

namespace App\Form\Type;



use App\Entity\FileSave;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CaseMapTypeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre',TextType::class,array(
            'label'=>'Titre du type de case',
        ))
        ->add('description', TextareaType::class,array(
            'label'=>'Description du type de case',
        ))
        ->add('caseMapImage', FileSaveFormType::class,array(
            'label' => 'Loot',
            'data_class' => FileSave::class,
        ))
        ;
    }

}
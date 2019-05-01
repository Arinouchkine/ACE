<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 17/04/2019
 * Time: 23:37
 */

namespace App\Form\Type;

use App\Entity\CaseMapEventType;
use App\Entity\FileSave;
use App\Entity\Loot;
use App\Entity\Monstre;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class CaseMapEventFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titre', TextType::class, array(
            'label' => 'Titre du l\'evenementt',
        ))
        ->add('texte', TextareaType::class,array(
            'label' => 'Description du l\'evenementt',
        ))
        ->add('caseMapEventType', EntityType::class, array(
            "class"        => CaseMapEventType::class,
            'choice_label' => 'titre',
            'label'        => 'Selectionner le type pour l\evenement de case',
        ))
        ->add('monstres', EntityType::class, array(
            "class"        => Monstre::class,
            'choice_label' => 'nom',
            'label'        => 'Selectionner les monstres',
            'expanded'     => true,
            'multiple'     => true,
        ))
        ->add('loots', EntityType::class, array(
            "class"        => Loot::class,
            'choice_label' => 'titre',
            'label'        => 'Selectionner les loots de l\'evenement',
            'expanded'     => true,
            'multiple'     => true,
        ))
        ->add('conditionEvent', TextType::class, array(
            'label' => 'La condiotion de l\'evenement',
        ))
        ->add('imageSup', FileSaveFormType::class,array(
            'label' => 'Sup',
            'data_class' => FileSave::class,
        ))
        ;


    }

}
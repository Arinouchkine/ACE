<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 20/04/2019
 * Time: 20:27
 */

namespace App\Form\Type;


use App\Entity\FileSave;
use App\Entity\Loot;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class MonstreFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder
           ->add('imageMonstre', FileSaveFormType::class, array(
               'label' => 'Image du monstre',
               'data_class' => FileSave::class,
           ))
           ->add('nom',TextType::class, array(
               'label' => 'Nom du monstre',
           ))
           ->add('description', TextareaType::class,array(
               'label' => 'Description du monstre',
           ))
           ->add('nbrEasyQuestion',NumberType::class,array(
               'label' => 'Nombre de question facile',
           ))
           ->add('nbrMediumQuestion',NumberType::class,array(
               'label' => 'Nombre de question intermediare',
           ))
           ->add('nbrHardQuestion',NumberType::class,array(
               'label' => 'Nombre de question difficile',
           ))
           ->add('force',NumberType::class,array(
               'label' => 'La force du monstre',
           ))
           ->add('loots', EntityType::class, array(
               "class"        => Loot::class,
               'choice_label' => 'titre',
               'label'        => 'Selectionner les loots de monstre',
               'expanded'     => true,
               'multiple'     => true,
           ))

       ;
    }


}
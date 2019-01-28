<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 27/11/2018
 * Time: 14:53
 */

namespace App\Form\Type;


use App\Entity\QCMChoice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class QCMPrimeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder
           ->add('question',TextType::class,[
               'label'=>'Question'
           ])
           ->add('choices', CollectionType::class, [
               'entry_type'=>QCMChoiceType::class,
               'allow_add' => true,
               'allow_delete' => true,
               'prototype' => true,
               'by_reference' => false,
               'label'=>false,

           ])
           ->add('explication',TextType::class,[
               'label'=>'Explication'
           ]);
    }


}
<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 18/04/2019
 * Time: 22:10
 */

namespace App\Form\Type;


use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CaseMapEventTypeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder->add('titre',TextType::class,array(
           'label'=>'Titre de type d\'evenement',
       ));
    }

}
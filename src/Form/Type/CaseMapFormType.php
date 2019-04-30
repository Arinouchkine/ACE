<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 14/04/2019
 * Time: 17:46
 */

namespace App\Form\Type;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CaseMapFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('caseMapEvents', EntityType::class, array(
            'choice_label' => 'titre',
            'label'        => 'Selectionner les evenements pour la case',
            'expanded'     => true,
            'multiple'     => true,
            'html5'        => true,
        ))
        ->add('caseMapType', EntityType::class, array(
            'choice_label' => 'titre',
            'label'        => 'Selectionner le type pour la case',
        ));


    }

}
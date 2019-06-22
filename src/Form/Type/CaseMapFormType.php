<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 14/04/2019
 * Time: 17:46
 */

namespace App\Form\Type;


use App\Entity\CaseMapEvent;
use App\Entity\CaseMapType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class CaseMapFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('caseMapEvents', EntityType::class, array(
            "class"        => CaseMapEvent::class,
            'choice_label' => 'titre',
            'label'        => 'Selectionner les evenements pour la case',
            'expanded'     => true,
            'multiple'     => true,
        ))
        ->add('caseMapType', EntityType::class, array(
            "class"        => CaseMapType::class,
            'choice_label' => 'titre',
            'label'        => 'Selectionner le type pour la case',
        ))
        ->add('fieldset',NumberType::class,array(
            'label' => 'Numero de fieldset',
        ))
        ;


    }

}
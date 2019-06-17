<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 15/06/2019
 * Time: 16:26
 */

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MapFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,array(
            'label' => 'Titre du loot',
            ))
        ;
    }

}
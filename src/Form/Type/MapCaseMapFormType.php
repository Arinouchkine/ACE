<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 15/06/2019
 * Time: 16:27
 */

namespace App\Form\Type;


use App\Entity\CaseMap;
use App\Entity\Map;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;

class MapCaseMapFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('caseMap', EntityType::class, array(
                "class"        => CaseMap::class,
                'choice_label' => 'id',
                'label'        => 'Selectionner les cases',
            ))
            ->add('map', EntityType::class, array(
                "class"        => Map::class,
                'choice_label' => 'id',
                'label'        => 'Selectionner la map',
            ))
            ->add('lat', IntegerType::class, array(
                "label" => 'latitude'
            ))
            ->add('lng', IntegerType::class, array(
                "label" => 'longitude'
            ))
        ;
    }

}
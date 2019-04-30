<?php
/**
 * Created by PhpStorm.
 * User: arino
 * Date: 18/04/2019
 * Time: 22:18
 */

namespace App\Form\Type;

use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class FileSaveFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('imageFile', VichImageType::class, [
            'required' => false,
            'allow_delete' => true,
            'download_label' => 'Ajouter l\'image',
            'download_uri' => true,
            'image_uri' => true,
        ]);
    }

}
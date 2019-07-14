<?php


namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PicType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageFile', VichImageType::class, [
                'required' => true,
                'allow_delete' => true,
                'download_label' => true,
            ])
            ->add('Date', DateType::class, [
                'label' => 'Date de prise photo',
                'widget' => 'single_text'
            ])
            ->add('Caption', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Description image'
                ]
            ]);
    }

}
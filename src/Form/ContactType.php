<?php


namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => "Nom",
                    'class' => 'form-border'
            ]])
            ->add('prenom', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => "Prénom",
                    'class' => 'form-border'
                ]])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new Email()
                ],
                'label' => false,
                'attr' => [
                    'placeholder' => "Email",
                    'class' => 'form-border'
                ],
                'required' => true
            ])
            ->add('objet', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => "Objet",
                    'class' => 'form-border'
                ]])
            ->add('message', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => "Votre message ici...",
                    'class' => 'form-border'
                ],
                'required' => true])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'error_building' => true
        ));
    }
}
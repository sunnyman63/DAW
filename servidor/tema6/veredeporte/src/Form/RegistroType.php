<?php

namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, array('label'=>'Correo:'))
            ->add('nombre', TextType::class, array('label'=>'Nombre:'))
            ->add('apellidos', TextType::class, array('label'=>'Apellidos:'))
            ->add('password', PasswordType::class, array('label'=>'Contraseña:'))
            ->add('password2', PasswordType::class, array('mapped'=>false, 'label'=>'Repetir Contraseña:'))
            ->add('guardar',SubmitType::class, array('label'=>'Enviar'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Usuario;
use Doctrine\DBAL\Types\BlobType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
            ->add('nombre',TextType::class)
            ->add('email',TextType::class)
            ->add('rol',TextType::class,['mapped'=>false])
            ->add('password',PasswordType::class)
            ->add('password2',PasswordType::class,['label'=>'Repita Contraseña','mapped'=>false])
            ->add('foto',FileType::class,['required'=>false])
            ->add('submit', SubmitType::class,['label'=>'Registrarse'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Liga;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LigaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, array('label'=>'Nombre: '))
            ->add('tipo', ChoiceType::class, array(
                                                'label'=>'Deporte:',
                                                'choices' => array(
                                                    'Futbol'=>'futbol',
                                                    'Baloncesto'=>'baloncesto'
                                                )
            ))
            ->add('fecha_inicio', DateTimeType::class, array('label'=>'Fecha de Inicio: '))
            ->add('guardar',SubmitType::class, array('label'=>'Crear'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Liga::class,
        ]);
    }
}
<?php

namespace App\Form;

use App\Entity\Equipo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquipoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, array('label'=>'Nombre:'))
            ->add('tipo', ChoiceType::class, array(
                                                'label'=>'Deporte:',
                                                'choices' => array(
                                                    'Futbol'=>'futbol',
                                                    'Baloncesto'=>'baloncesto'
                                                )
                                            ))
            ->add('guardar',SubmitType::class, array('label'=>'Crear'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Equipo::class,
        ]);
    }
}

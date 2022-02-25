<?php

namespace App\Form;

use App\Entity\Liga;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
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
            ->add('fecha_inicio', DateTimeType::class, array(
                                                            'date_label'=>'Fecha de Inicio: ',
                                                            'time_label'=>'Hora de cierre: '))
            ->add('max_equipos', RangeType::class, array(
                                                        'label'=>'Nº Maximo de Equipos:',
                                                        'attr'=> ['min'=>4, 'max'=>10],
                                                        'data'=>4
                                                        ))
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

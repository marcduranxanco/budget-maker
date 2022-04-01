<?php

namespace App\Form;

use App\Entity\Proyecto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProyectoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('presupuesto')
            ->add('fecha_entrega', DateTimeType::class)
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            /** @var var Presupuesto $presupuesto */
            $proyecto = $event->getData();
            $form = $event->getForm();

            if(null !== $proyecto->getId()) {
                $form->add('estado', ChoiceType::class, [
                    'choices'  => Proyecto::PROYECTO_STATE
                ]);
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Proyecto::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Presupuesto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PresupuestoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tipo', ChoiceType::class, [
                'label' => 'Tipo de proyecto',
                'choices'  => Presupuesto::PRESUPUESTO_TYPES
            ])
            ->add('correoContacto', EmailType::class, [
                'label' => 'Correo de Contacto',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('descripcionProyecto', TextareaType::class, [
                'label' => 'Descripción del Proyecto',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('user')
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            /** @var var Presupuesto $presupuesto */
            $presupuesto = $event->getData();
            $form = $event->getForm();

            if(null !== $presupuesto->getId()) {
                $form->add('estado', ChoiceType::class, [
                        'choices'  => Presupuesto::PRESUPUESTO_STATES,
                        'label' => 'Status',
                    ]);
                $form->add('precio_final', NumberType::class, [
                    'label' => 'Precio Final',
                ]);
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Presupuesto::class,
        ]);
    }
}

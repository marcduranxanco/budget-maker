<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserType extends AbstractType
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
            ])
            ->add('phone', TextType::class, [
                'label' => 'Phone',
            ])
            ->add('roles', ChoiceType::class, [
                'label' => 'Roles',
                'choices'  => User::ROLES
            ])
            ->add('locale', ChoiceType::class, [
                'label' => 'Idioma local',
                'choices'  => User::LOCALE
            ])
            ->add('password', TextType::class, [
                'label' => 'Password',
            ])
        ;

        $builder->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                function ($rolesArray) {
                    return count($rolesArray)? $rolesArray[0]: null;
                },
                function ($rolesString) {
                    return [$rolesString];
                }
            ));


        $builder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
            $user = $event->getData();

            if ($user->getPassword() !== null) {
                $plainPassword = $user->getPassword();
                $hashedPassword = $this->passwordEncoder->encodePassword($user, $plainPassword);
                $user->setPassword($hashedPassword);
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

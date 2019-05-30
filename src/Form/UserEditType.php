<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
Use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr'=>[
                    'class'=>'useredit1']
            ])

            ->add('password', PasswordType::class, [
                'label' => 'Contraseña',
                'attr'=>[
                    'class'=>'useredit2',
                    'placeholder'=>'Contraseña'
                ]
            ])

            ->add('username', TextType::class, [
                'label' => 'Usuario',
                'attr'=>[
                    'class'=>'useredit3']
            ])
            ->add('accountnumber', TextType::class, [
                'label' => 'Número de Cuenta',
                'attr'=>[
                    'class'=>'useredit4',
                    'placeholder'=>'Número de Cuenta']
            ])
            ->add('dateofbirth', DateType::class, [
                'label' => 'Fecha Nacimiento',
                'widget'=>'single_text',
                'attr'=>[
                    'class'=>'form-control js-datepicker useredit5'
                ]
            ])

            ->add('name', TextType::class, [
                'label' => 'Nombre',
                'attr'=>[
                    'class'=>'useredit6',
                    'placeholder'=>'Nombre'
                ]
            ])

            ->add('phone', TextType::class,[
                'label' => 'Teléfono',
                'attr'=>[
                    'class'=>'useredit7',
                    'placeholder'=>'Teléfono'
                ]
            ])
            ->add('surname', TextType::class, [
                'label' => 'Apellidos',
                'attr'=>[
                    'class'=>'useredit8',
                    'placeholder'=>'Apellidos'
                ]
            ])
            ->add('address', TextType::class, [
                'label' => 'Dirección',
                'attr'=>[
                    'class'=>'useredit9',
                    'placeholder'=>'Dirección']
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
Use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class BuyLevelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder


            ->add('name', TextType::class, [
                'label' => 'Nombre',
                'attr'=>[
                    'class'=>'useredit6',
                    'placeholder'=>'Nombre'
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
            ->add('accountnumber', TextType::class, [
                'label' => 'Número de Cuenta',
                'attr'=>[
                    'class'=>'useredit4',
                    'placeholder'=>'Número de Cuenta']
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

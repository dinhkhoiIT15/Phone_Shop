<?php

namespace App\Form;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddCustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,['label_attr' => ['class' => 'form-label'], 'attr' => ['class' => 'form-control']])
            ->add('address',TextType::class,['label_attr' => ['class' => 'form-label'], 'attr' => ['class' => 'form-control']])
            ->add('phone_number',TextType::class,['label_attr' => ['class' => 'form-label'], 'attr' => ['class' => 'form-control']])
            ->add('submit', SubmitType::class, ['attr' => ['class' => 'btn btn-success']]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}

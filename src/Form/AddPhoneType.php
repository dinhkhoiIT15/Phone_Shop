<?php

namespace App\Form;

use App\Entity\Phone;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddPhoneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('phone_name',TextType::class)
            ->add('price',TextType::class)
            ->add('date',TextType::class)
            ->add('product',TextType::class)
            ->add('suppliers',TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Phone::class,
        ]);
    }
}

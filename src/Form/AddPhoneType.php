<?php

namespace App\Form;

use App\Entity\Phone;
use App\Entity\Product;
use App\Entity\Supplier;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class
AddPhoneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('phone_name',TextType::class,['label_attr' => ['class' => 'form-label'], 'attr' => ['class' => 'form-control']])
            ->add('price',TextType::class,['label_attr' => ['class' => 'form-label'], 'attr' => ['class' => 'form-control']])
            ->add('date',DateType::class,['widget' => 'choice',])
            ->add('product',EntityType::class, [
                "class"=>Product::class,
                "query_builder"=>function(EntityRepository $er)
                {
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.pro_name');
                },
                "choice_label"=>'pro_name',
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control']
            ])
            ->add('suppliers',EntityType::class, [
                "class"=>Supplier::class,
                "query_builder"=>function(EntityRepository $er)
                {
                    return $er->createQueryBuilder('s')
                        ->orderBy('s.sup_name');
                },
                "choice_label"=>'sup_name',
                "multiple"=>true,
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control']
            ])
            ->add('submit', SubmitType::class, ['attr' => ['class' => 'btn btn-success']]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Phone::class,
        ]);
    }
}

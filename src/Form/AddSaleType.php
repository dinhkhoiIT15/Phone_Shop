<?php

namespace App\Form;

use App\Entity\Customer;
use App\Entity\Phone;
use App\Entity\Product;
use App\Entity\Sale;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddSaleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('customer',EntityType::class,
                [
                    "class"=>Customer::class,
                    "query_builder"=>function(EntityRepository $er)
                    {
                        return $er->createQueryBuilder('c')
                            ->orderBy('c.name');
                    },
                    "choice_label"=>'name',
                    'label_attr' => ['class' => 'form-label'],
                    'attr' => ['class' => 'form-control']
                ])
            ->add('phone',EntityType::class,
                [
                    "class"=>Phone::class,
                    "query_builder"=>function(EntityRepository $er)
                    {
                        return $er->createQueryBuilder('p')
                            ->orderBy('p.phone_name');
                    },
                    "choice_label"=>'phone_name',
                    'label_attr' => ['class' => 'form-label'],
                    'attr' => ['class' => 'form-control']
                ])
            ->add('save', SubmitType::class, ['attr' => ['class' => 'btn btn-success']]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sale::class,
        ]);
    }
}

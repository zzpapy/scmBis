<?php

namespace App\Form;

use App\Entity\Charges;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ChargesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type',ChoiceType::class, [
                'choices'  => [
                    'fixe' => 0,
                    'variable' => 1
                ],
                'multiple' => false,
                'expanded' => true
            ])
            ->add('montant')
            ->add('nom')
            ->add('createdAt')
            ->add('paymentAt')
            ->add('payedAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Charges::class,
        ]);
    }
}

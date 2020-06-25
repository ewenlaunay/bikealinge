<?php

namespace App\Form;

use App\Entity\OrderHasClothe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderHasClotheType extends AbstractType implements FormTypeInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('clothe')
            ->add('child', CheckboxType::class, [
                'label'    => 'Enfant',
                'required' => false,
            ])
            ->add('adult', CheckboxType::class, [
                'label'    => 'Adulte',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => OrderHasClothe::class,
        ]);
    }
}

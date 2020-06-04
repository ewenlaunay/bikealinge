<?php

namespace App\Form;

use App\Entity\OrderHasClothe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderHasClotheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('clothe')
            ->add('child', CheckboxType::class, [
                'label'    => 'Enfant',
                'required' => true,
            ])
            ->add('adult', CheckboxType::class, [
                'label'    => 'Adulte',
                'required' => true,
            ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'save'],
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => OrderHasClothe::class,
        ]);
    }
}

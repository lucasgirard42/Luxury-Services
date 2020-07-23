<?php

namespace App\Form;

use App\Entity\JobOffer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class JobOfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reference')
            ->add('description')
            ->add('activity')
            ->add('notes')
            ->add('jobTitle')
            ->add('location')
            ->add('closingDate', BirthdayType::class, [
                'widget' => 'single_text',
                'required' => 'false'
            ])
            ->add('salary')
            ->add('dateCreation', BirthdayType::class, [
                'widget' => 'single_text',
                'required' => 'false'
            ])
            ->add('client')
            ->add('jobSector')
            ->add('jobType')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => JobOffer::class,
        ]);
    }
}

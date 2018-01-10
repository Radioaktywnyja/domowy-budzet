<?php

namespace MiloBudzetBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type as formType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use MiloBudzetBundle\Entity as Entity;

class dodajPrzychodType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('data', formType\DateType::class)
                    ->add('kwota', formType\MoneyType::class, array(
                        'currency' => 'PLN'
                    ))
                    ->add('dodajTypy', EntityType::class, array(
                        'class' => Entity\dodajTypPrzychodu::class,
                        'choice_label' => 'grupa',
                    ))
                    ->add('dodajImiona', EntityType::class, array(
                        'class' => Entity\dodajImie::class,
                        'choice_label' => 'imie',
                        'expanded' => true,
                    ))
                    ->add('Zapisz', formType\SubmitType::class);
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
           'data_class' => Entity\dodajPrzychod::class
        ));
    }
    
}

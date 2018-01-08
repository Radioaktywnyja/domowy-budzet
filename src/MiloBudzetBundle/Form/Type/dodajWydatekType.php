<?php

namespace MiloBudzetBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type as formType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use MiloBudzetBundle\Entity as Entity;

class dodajWydatekType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('data', formType\DateType::class)
                    ->add('kwota', formType\MoneyType::class, array(
                        'currency' => 'PLN'
                    ))
                    ->add('typ', EntityType::class, array(
                        'class' => Entity\dodajTypWydatku::class,
                        'choice_label' => 'grupa',
                        'group_by' => 'kategoria'
                    ))
                    ->add('imie', EntityType::class, array(
                        'class' => Entity\dodajImie::class,
                        'choice_label' => 'imie',
                        'expanded' => true,
                    ))
                    ->add('sklep', EntityType::class, array(
                        'class' => Entity\dodajSklep::class,
                        'choice_label' => 'sklep'
                    ))
                    ->add('Zapisz', formType\SubmitType::class);
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
           'data_class' => Entity\dodajWydatek::class
        ));
    }
    
}

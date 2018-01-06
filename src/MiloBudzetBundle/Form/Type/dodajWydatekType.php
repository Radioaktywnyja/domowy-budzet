<?php

namespace MiloBudzetBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type as formType;
use MiloBudzetBundle\Entity\dodajWydatek;

class dodajWydatekType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('data', formType\DateType::class)
                    ->add('kwota', formType\MoneyType::class, array(
                        'currency' => 'PLN'
                    ))
                    ->add('typ', formType\ChoiceType::class, array(
                        'choices' => array(
                            'Jedzenie' => array(
                                'Jedzenie dom' => 'Jedzenie dom',
                                'Jedzenie praca' => 'Jedzenie praca'
                            ),
                            'Samochody' => array(
                                'Paliwo Passat' => 'Paliwo Passat',
                                'Paliwo Golf II' => 'Paliwo Golf II',
                                'Naprawy' => 'Naprawy'
                            ),
                            'Kieszonkowe' => array(
                                'Brajan' => 'Brajan',
                                'Dżesika' => 'Dżesika'
                            )
                        )
                    ))
                    ->add('imie', formType\ChoiceType::class, array(
                        'choices' => array(
                            'Janusz' => 'Janusz',
                            'Grażyna' => 'Grażyna'
                        ),
                        'expanded' => true,
                    ))
                    ->add('sklep', formType\ChoiceType::class, array(
                        'choices' => array(
                            'Biedronka' => 'Biedronka',
                            'Lidl' => 'Lidl',
                            'BP' => 'BP',
                            'Orlen' => 'Orlen',
                            'Kieszonkowe' => 'Kieszonkowe',
                        )
                    ))
                    ->add('Zapisz', formType\SubmitType::class);
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
           'data_class' => dodajWydatek::class
        ));
    }
    
}

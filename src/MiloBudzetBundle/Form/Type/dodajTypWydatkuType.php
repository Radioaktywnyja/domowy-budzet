<?php

namespace MiloBudzetBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type as formType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use MiloBudzetBundle\Entity\dodajTypWydatku;
use MiloBudzetBundle\Entity\dodajKatWydatku;

class dodajTypWydatkuType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder 
                ->add('dodajKategorie', EntityType::class, array(
                    'class' => dodajKatWydatku::class,
                    'choice_label' => 'kategoria'
                ))
                ->add('grupa', formType\TextType::class)
                ->add('Zapisz', formType\SubmitType::class);
        
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => dodajTypWydatku::class
        ));
    }
    
}

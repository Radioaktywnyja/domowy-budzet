<?php

namespace MiloBudzetBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type as formType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use MiloBudzetBundle\Entity\dodajTypPrzychodu;

class dodajTypPrzychoduType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
         $builder
                ->add('grupa', formType\TextType::class)
                ->add('Zapisz', formType\SubmitType::class);
        
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => dodajTypPrzychodu::class
        ));
    }
    
}

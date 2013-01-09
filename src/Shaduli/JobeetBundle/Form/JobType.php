<?php

namespace Shaduli\JobeetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class JobType extends AbstractType {

    static public $types = array(
        'full-time' => 'Full time',
        'part-time' => 'Part time',
        'freelance' => 'Freelance',
    );

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('category', 'entity', array('class' => 'ShaduliJobeetBundle:Category', 'property' => 'name'))
                ->add('type', 'choice', array(
                    'choices' => $this->getTypes(), 
                    'expanded' => true ))
                ->add('company')
                ->add('logo', 'file', array('label' => 'Company logo', 'data_class' => null))
                ->add('url')
                ->add('position')
                ->add('location')
                ->add('description', 'textarea')
                ->add('how_to_apply', 'textarea', array('label' => 'How to apply?'))
                ->add('is_public', 'text', array('label' => 'Public?', 
                    'attr' => array('help' => 'Whether the job can also be published on affiliate websites or not.')))
                ->add('email')
                
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Shaduli\JobeetBundle\Entity\Job'
        ));
    }

    public function getName() {
        return 'shaduli_jobeetbundle_jobtype';
    }

    public function getTypes() {
        return self::$types;
    }

}

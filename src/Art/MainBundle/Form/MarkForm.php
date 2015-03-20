<?php

namespace Art\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MarkForm extends AbstractType
{
    public function getName()
    {
        return 'mark';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('mark1', 'hidden', array('label' => false))
            ->add('mark2', 'hidden', array('label' => false))
            ->add('mark3', 'hidden', array('label' => false))
            ->add('mark4', 'hidden', array('label' => false))
            ->add('mark5', 'hidden', array('label' => false))
            ->add('mark6', 'hidden', array('label' => false))
            ->add('mark7', 'hidden', array('label' => false))
            ->add('mark8', 'hidden', array('label' => false))
            ->add('mark9', 'hidden', array('label' => false))
            ->add('mark10', 'hidden', array('label' => false))
            ->add('mark11', 'hidden', array('label' => false))
            ->add('mark12', 'hidden', array('label' => false))
            ->add('mark13', 'hidden', array('label' => false))
            ->add('mark14', 'hidden', array('label' => false))
            ->add('mark15', 'hidden', array('label' => false))
            ->add('mark16', 'hidden', array('label' => false))
            ->add('mark17', 'hidden', array('label' => false))
            ->add('mark18', 'hidden', array('label' => false))
            ->add('mark19', 'hidden', array('label' => false))
            ->add('mark20', 'hidden', array('label' => false))
            ->add('mark21', 'hidden', array('label' => false))
            ->add('mark22', 'hidden', array('label' => false))
            ->add('mark23', 'hidden', array('label' => false))
            ->add('mark24', 'hidden', array('label' => false))
            ->add('mark25', 'hidden', array('label' => false))
            ->add('mark26', 'hidden', array('label' => false))
            ->add('mark27', 'hidden', array('label' => false))
            ->add('mark28', 'hidden', array('label' => false))
            ->add('mark29', 'hidden', array('label' => false))
            ->add('mark30', 'hidden', array('label' => false));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Art\MainBundle\Entity\Mark'
        ));
    }
} 
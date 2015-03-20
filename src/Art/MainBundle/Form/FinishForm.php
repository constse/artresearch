<?php

namespace Art\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FinishForm extends AbstractType
{
    public function getName()
    {
        return 'finish';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nickname', 'text', array('label' => 'Никнейм'))
            ->add('sex', 'choice', array('label' => 'Пол',
                'choices' => array('male' => 'Мужской', 'female' => 'Женский')
            ))->add('oil', 'choice', array('label' => 'Писали маслом когда-нибудь?',
                'choices' => array(false => 'Нет', true => 'Да')
            ))->add('age', 'integer', array('label' => 'Возраст'))
            ->add('education', 'choice', array('label' => 'Есть ли художественное образование?',
                'choices' => array(false => 'Нет', true => 'Да')
            ))->add('email', 'email', array('label' => 'E-mail', 'required' => false))
            ->add('submit', 'submit', array('label' => 'Завершить'));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Art\MainBundle\Entity\User'
        ));
    }
} 
<?php

namespace DBBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InfractorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('password', "password")->add('nombre')->add('apellidos')
        ->add('tlf')->add('fExpCarnet', "date", [ "years" => range(date('Y') - 10 , date('Y')) ])->add('credencial')
        ->add("password2", "password", [ "mapped" => false ]);
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DBBundle\Entity\Infractor'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'dbbundle_infractor';
    }
}

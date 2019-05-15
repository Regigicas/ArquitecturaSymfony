<?php

namespace DBBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MultasType extends AbstractType
{
    private $matriculas;

    public function __construct($matriculas)
    {
        $this->matriculas = $matriculas;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('razon')
                ->add('fecha')
                ->add('direccion')
                ->add('precio')
                ->add('estado')
                ->add('credencial');

        if ($this->matriculas != null)
            $builder->add("matricula", "entity",
                array("class" => "DBBundle:Matriculas", 'choices'=>
                $this->matriculas, 
                'expanded' => false, 'multiple' => false));
        else
            $builder->add("matricula");
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DBBundle\Entity\Multas'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'dbbundle_multas';
    }
}

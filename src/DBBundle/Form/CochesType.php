<?php

namespace DBBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CochesType extends AbstractType
{
    private $dnis;

    public function __construct($dnis)
    {
        $this->dnis = $dnis;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('year')
                ->add('color')
                ->add('potenciaCv')
                ->add('NBastidor')
                ->add('matricula', TextType::class, array('mapped' => false));

        if ($this->dnis != null)
            $builder->add("credencial", "choice", ["choices" => $this->dnis, "placeholder" => "Selecciona un DNI" ]);
        else
            $builder->add("credencial");
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DBBundle\Entity\Coches'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'dbbundle_coches';
    }
}

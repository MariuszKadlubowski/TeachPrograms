<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChosenProgramType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('class', 'entity', array('class' => 'AppBundle:SchoolClass','choice_label' => 'name',))
            ->add('teacher', 'entity', array('class' => 'AppBundle:User'))
            ->add('program', 'entity', array('class' => 'AppBundle:Program','choice_label' => 'title',))

//            ->add('class')
//            ->add('teacher')
//            ->add('program')
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\ChosenProgram'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_chosenprogram';
    }


}

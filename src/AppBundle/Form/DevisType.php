<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class DevisType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('idClient', EntityType::class, array( 'class' => 'AppBundle:Client', 'choice_label' => 'nom', 'choice_value' => 'id', 'placeholder' => 'Client' , 'attr' => array('name' => 'idClient', 'label' => 'NOM')))->add('titreProjet', TextType::class )->add('typePresta', CollectionType::class, array('entry_type' => TypeType::class, 'allow_add' => true, 'allow_delete' => true))->add('prixTotal', NumberType::class, array( 'attr'=> array('readonly' => true)))->add('Sauvegarder', SubmitType::class , array( 'attr' => array('class' => 'btn btn_form')))->getForm();
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Devis'
        ));
    }

    /**
     * @return null
     */
    public function getBlockPrefix()
    {
        return null;
    }


}

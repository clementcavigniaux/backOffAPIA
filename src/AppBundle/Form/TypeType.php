<?php
/**
 * Created by PhpStorm.
 * User: clementcavigniaux
 * Date: 06/08/2017
 * Time: 14:09
 */

namespace AppBundle\Form;


use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){

        $builder->add( 'typePresta', ChoiceType::class,  array( 'choices' => array( 'Réalisation' => "Réalisation", 'Production' => "Production", 'Autre...' => "Autre"), 'attr' => array('class' => 'type' ), 'placeholder' => "Prestation", 'label' => false))->add('qty', NumberType::class, array( 'attr' => array('class' => 'qty')))->add('prixUnitaire', NumberType::class,  array( 'attr' =>array('class' => 'prixU')))->add('prixCategorie', NumberType::class,  array('attr' => array('class' => 'totalcart' )));
    }

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
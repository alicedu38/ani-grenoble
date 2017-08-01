<?php

namespace AniGrenoble\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AniGrenoble\AppBundle\Form\Type\ImageType;

class AnnonceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', 'text')
            ->add('contenu', 'textarea')
            ->add('auteur', 'text')
            ->add('date', 'date', array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr' => array('class' => 'date')))
            ->add('image', ImageType::class, array(
                'label'    => false,
                'choice_label' => 'alt'
            ))
            ->add('categories', 'entity', array( //Affiche la liste des catégories
                'class'    => 'AniGrenobleAppBundle:Categorie',
                'property' => 'nom',
                'multiple' => true
                //'expanded' => true //Checkbox au lieu d'une liste select
            ))
            ->add('publie', 'checkbox', array('required' => false))// Element non obligatoire dans le form
            ->add('valider', 'submit');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AniGrenoble\AppBundle\Entity\Annonce'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'anigrenoble_appbundle_annonce';
    }


}

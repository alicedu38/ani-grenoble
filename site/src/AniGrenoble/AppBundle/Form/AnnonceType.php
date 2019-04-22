<?php

namespace AniGrenoble\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AniGrenoble\AppBundle\Form\Type\ImageType;
use AniGrenoble\AppBundle\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AnnonceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class)
            ->add('contenu', TextareaType::class)
            ->add('auteur', TextType::class)
            ->add('date', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr' => array('class' => 'date')))
            ->add('image', ImageType::class, array(
                'label' => false,
                'choice_label' => 'alt'
            ))
            ->add('categories', EntityType::class, array( //Affiche la liste des catégories
                'class' => Categorie::class,
                'choice_label' => 'nom',
                'multiple' => true
                //'expanded' => true //Checkbox au lieu d'une liste select
            ))
            ->add('publie', CheckboxType::class, array('required' => false))// Element non obligatoire dans le form
            ->add('valider', SubmitType::class);
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

<?php

namespace AniGrenoble\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class ImageType extends AbstractType
{
    /**
    * {@inheritdoc}
    */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('url', 'text', array(
            'required' => false
        ))
        ->add('alt', 'text', array(
            'required' => false
        ))
        ->add('file', 'file', array(
            'required' => false
        ))
        ->add('categorie', EntityType::class, array( //Affiche la catégorie 'Galerie'
            'class'    => 'AniGrenobleAppBundle:Categorie',
            'query_builder' => function (EntityRepository $er) {
                return $er->getCategorie('Galerie');
            },
            'property' => 'nom',
            'multiple' => false,
            'required' => false
        ))
        ->add('valider', 'submit');
    }

    /**
    * {@inheritdoc}
    */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AniGrenoble\AppBundle\Entity\Image'
        ));
    }

    /**
    * {@inheritdoc}
    */
    public function getBlockPrefix()
    {
        return 'anigrenoble_appbundle_image';
    }


}

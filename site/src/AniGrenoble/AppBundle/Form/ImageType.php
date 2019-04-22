<?php

namespace AniGrenoble\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AniGrenoble\AppBundle\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\EntityRepository;

class ImageType extends AbstractType
{
    /**
    * {@inheritdoc}
    */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('url', TextType::class, array(
            'required' => false
        ))
        ->add('alt', TextType::class, array(
            'required' => false
        ))
        ->add('file', FileType::class, array(
            'required' => false
        ))
        ->add('categorie', EntityType::class, array( //Affiche la catégorie 'Galerie'
            'class'    => Categorie::class,
            'query_builder' => function (EntityRepository $er) {
                return $er->getCategorie('Galerie');
            },
            'choice_label' => 'nom',
            'multiple' => false,
            'required' => false
        ))
        ->add('valider', SubmitType::class);
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

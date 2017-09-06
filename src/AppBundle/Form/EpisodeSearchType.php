<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EpisodeSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('title', TextType::class, array('attr' => array('placeholder' => 'Recherche'),'label'=>' '))
            ->add("valider",SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        //parent::setDefaultOptions($resolver);
        $resolver->setDefaults(array(
            // avoid to pass the csrf token in the url (but it's not protected anymore)
            'csrf_protection' => false,
            'data_class' => 'AppBundle\Model\EpisodeSearch'
        ));
    }

    public function getBlockPrefix()
    {
        return 'app_bundle_episode_search_type';
    }
}

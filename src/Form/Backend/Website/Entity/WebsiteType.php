<?php


namespace App\Form\Backend\Website\Entity;


use App\Entity\Website;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WebsiteType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder
        ->add('name')
        ->add('host')
        ->add('prefix')
        ->add('locale')
        ->add('language', LanguageType::class)
        ->add('extraLanguage', LanguageType::class, ['multiple'=>true])
      ;
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
        'data_class' => Website::class
    ]);
  }
}
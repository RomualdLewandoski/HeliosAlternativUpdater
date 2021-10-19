<?php

namespace App\Form;

use App\Entity\LauncherConfig;
use Artgris\Bundle\MediaBundle\Form\Type\MediaType;
use SebastianBergmann\CodeCoverage\Report\Text;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LauncherConfigType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fallbackVideo', MediaType::class, [
                "label" => "Video",
                "conf" => "default"
            ])
            ->add('fallbackAudio', MediaType::class, [
                "label" => "Audio",
                "conf" => "default",
                "required" => false
            ])
            ->add('loginApi', TextType::class, [
                "label" => "URL api login"
            ])
            ->add('skinApi', TextType::class, [
                "label" => "URL api skin"
            ])
            ->add('serverIp', TextType::class, [
                "label" => "IP du serveur"
            ])
            ->add('serverPort', TextType::class, [
                "label" => "Port du serveur",
                "required" => false,
                "empty_data" => 25565,
            ])
            ->add('distroList', TextType::class, [
                "label" => "URL mise a jour fichier launcher"
            ])
            ->add('siteName', TextType::class, [
                "label" => "Nom du launcher"
            ])
            ->add('newsApi', TextType::class, [
                "label" => "URL api news"
            ])
            ->add("version", TextType::class)
            ->add("java", TextType::class, [
                "label" => "Lien de téléchargement de java"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LauncherConfig::class,
        ]);
    }
}

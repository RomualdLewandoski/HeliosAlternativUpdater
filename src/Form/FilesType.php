<?php

namespace App\Form;

use App\Entity\Files;
use App\Entity\Server;
use Artgris\Bundle\MediaBundle\Form\Type\MediaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('IdName', TextType::class, [
                "label" => "Identifiant du fichier ex: options.txt 1.12"
            ])
            ->add('name', TextType::class, [
                "label" => "nom du fichier"
            ])
            ->add('isMd5', CheckboxType::class, [
                "label" => "Activer la vérification du fichier ? ",
                'required' => false
            ])
            ->add("path", TextType::class, [
                "label" => "Chemin d'enregistrement du fichier et nom du fichier une fois enregistré ex: config/monMod/config.txt"
            ])
            ->add('url', MediaType::class, [
                "label" => "Fichier",
                "conf" => "default"
            ])
            ->add('servers', EntityType::class, [
                "label" => "Serveurs",
                "class" => Server::class,
                "choice_label" => "name",
                "multiple" => true,
                "expanded" => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Files::class,
            'allow_extra_fields'=> true
        ]);
    }
}

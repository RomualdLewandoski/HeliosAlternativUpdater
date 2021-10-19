<?php

namespace App\Form;

use App\Entity\Files;
use App\Entity\ForgeHosted;
use App\Entity\Library;
use App\Entity\Mod;
use App\Entity\Server;
use App\Entity\Version;
use Artgris\Bundle\MediaBundle\Form\Type\MediaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nameId', TextType::class, [
                "label" => "Identifiant du serveur (ne doit pas avoir d'espace, est identique au nom ou les mods serront stocké sur le pc ex: ezariel_main)"
            ])
            ->add('name', TextType::class, [
                "label" => "Nom du serveur (celui afficher sur le launcher et dans le choix des serveurs)"
            ])
            ->add('description', TextType::class)
            ->add('icon', MediaType::class, [
                "conf" => "default"
            ])
            ->add('version', TextType::class, [
                "label" => "Version du serveur (ATTENTION ce n'est pas la version de minecraft)"
            ])
            ->add('minecraftVersion', TextType::class, [
                "label" => "Version de minecraft"
            ])
            ->add('address', TextType::class, [
                "label" => "Ip du serveur sous la forme : ip ou nom de domaine:port"
            ])
            ->add('mainServer', CheckboxType::class, [
                "label" => "Est ce le serveur principal ? ",
                "required" => false
            ])
            ->add('autoConnect', CheckboxType::class, [
                "label" => "Auto connexion au serveur ? ",
                "required" => false
            ])
            ->add('forgeHosted', EntityType::class, [
                "label" => "Forge version",
                "class" => ForgeHosted::class,
                "choice_label" => "name",
                "placeholder" => "Choisir une version de forge (peut etre définit plus tard)",
                "required" => false

            ])
            ->add('versionManifest', EntityType::class, [
                "label" => "Version.json",
                "class" => Version::class,
                "choice_label" => "name",
                "placeholder" => "Choisir un json (correspondant a la version de forge)",
                "required" => false

            ])
           ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Server::class,
        ]);
    }
}

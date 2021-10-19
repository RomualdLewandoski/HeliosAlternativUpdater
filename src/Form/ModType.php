<?php

namespace App\Form;

use App\Entity\Mod;
use App\Entity\Server;
use Artgris\Bundle\MediaBundle\Form\Type\MediaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idName', TextType::class, [
                "label" => "Identifiant ex: net.optifine:optifine:1.12.2_HD_U_F5"
            ])
            ->add('name', TextType::class, [
                "label" => "Nom du fichier ex Optifine 1.12.2"
            ])
            ->add('isRequired', CheckboxType::class, [
                "label" => "Mot obligatoire ?",
                'required' => false
            ])
            ->add('isEnabled', CheckboxType::class, [
                "label" => "Mod actif par defaut ? (si mod requis sera obligatoirement sur oui)",
                'required' => false
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
            'data_class' => Mod::class,
        ]);
    }
}

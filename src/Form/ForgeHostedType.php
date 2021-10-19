<?php

namespace App\Form;

use App\Entity\ForgeHosted;
use Artgris\Bundle\MediaBundle\Form\Type\MediaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ForgeHostedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idName', TextType::class, [
                "label" => "Identifiant ex: net.minecraftforge:forge:1.16.5-version de forge"
            ])
            ->add('name', TextType::class, [
                "label" => "Nom ex: Minecraft Forge"
            ])
            ->add('url', MediaType::class, [
                "label" => "Fichier forge",
                "conf" => "default"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ForgeHosted::class,
        ]);
    }
}

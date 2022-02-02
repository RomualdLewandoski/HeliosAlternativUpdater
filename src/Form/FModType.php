<?php

namespace App\Form;

use App\Entity\FMod;
use App\Entity\Server;
use Artgris\Bundle\MediaBundle\Form\Type\MediaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FModType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                "label" => "Nom du fichier ex Optifine 1.12.2"
            ])
            ->add('url', MediaType::class, [
                "label" => "Fichier",
                "conf" => "default"
            ])
            ->add('isEnabled', CheckboxType::class, [
                "label" => "Mod actif ? (Dois être coché pour etre téléchargable)",
                'required' => false
            ])


        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FMod::class,
        ]);
    }
}

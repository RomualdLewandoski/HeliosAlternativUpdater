<?php

namespace App\Form;

use App\Entity\DiscordConfig;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DiscordConfigType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('clientId', TextType::class, [
                "label" => "Discord application id"
            ])
            ->add('smallImageKey', TextType::class, [
                "label" => "Discord image key"
            ])
            ->add('smallImageText', TextType::class, [
                "label" => "Text affiché lorsque la souris passe sur l'image"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DiscordConfig::class,
        ]);
    }
}

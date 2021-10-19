<?php

namespace App\Form;

use App\Entity\Server;
use App\Entity\Shader;
use Artgris\Bundle\MediaBundle\Form\Type\MediaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShaderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idName', TextType::class, [
                "label" => "Identifiant ex: com.sonicether:seus-renewed:1.0.0"
            ])
            ->add('name', TextType::class, [
                "label" => "Nom ex: SEUS-Renewed"
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
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Shader::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\RessourcePack;
use App\Entity\Server;
use Artgris\Bundle\MediaBundle\Form\Type\MediaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RessourcePackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idName', TextType::class, [
                "label" => "Identifiant ex: eu.ezariel.rp.pack"
            ])
            ->add('name', TextType::class, [
                "label" => "Nom ex: Pack de ressource RP"
            ])
            ->add('url', MediaType::class, [
                "label" => "Fichier",
                "conf"=>"default"
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
            'data_class' => RessourcePack::class,
        ]);
    }
}

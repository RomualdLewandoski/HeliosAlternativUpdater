<?php

namespace App\Form;

use App\Entity\Download;
use Artgris\Bundle\MediaBundle\Form\Type\MediaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DownloadFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('windowsFile', MediaType::class, [
                "label" => "Launcher Windows",
                "conf" => "default"
            ])
            ->add('linuxFile', MediaType::class, [
                "label" => "Launcher Linux",
                "conf" => "default",
                "required" => false,
                "empty_data" => "#"
            ])
            ->add('macFile', MediaType::class, [
                "label" => "Launcher Mac",
                "conf" => "default",
                "required" => false,
                "empty_data" => "#"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Download::class,
        ]);
    }
}

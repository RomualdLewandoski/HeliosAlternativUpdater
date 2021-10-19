<?php

namespace App\Controller;

use App\Entity\DiscordConfig;
use App\Form\DiscordConfigType;
use App\Repository\DiscordConfigRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/discord/config")
 */
class DiscordConfigController extends AbstractController
{
    /**
     * @Route("/", name="discord_config_index", methods={"GET", "POST"})
     */
    public function index(DiscordConfigRepository $discordConfigRepository, Request $request): Response
    {

        $discordConfig = $discordConfigRepository->find(1);
        if ($discordConfig == null) {
            $discordConfig = new DiscordConfig();
        }

        $form = $this->createForm(DiscordConfigType::class, $discordConfig);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            if ($discordConfigRepository->find(1) == null) {
                $discordConfig->setId(1);
                $entityManager->persist($discordConfig);
            }
            $entityManager->flush();

            return $this->redirectToRoute('discord_config_index');
        }

        return $this->render('discord_config/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}

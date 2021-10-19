<?php

namespace App\Controller;

use App\Entity\LauncherConfig;
use App\Form\LauncherConfigType;
use App\Repository\LauncherConfigRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/config/launcher")
 */
class ConfigLauncherController extends AbstractController
{
    /**
     * @Route("/", name="config_launcher_index", methods={"GET", "POST"})
     */
    public function index(LauncherConfigRepository $launcherConfigRepository, Request $request): Response
    {

        $launcherConfig = $launcherConfigRepository->find(1);
        if ($launcherConfig == null) {
            $launcherConfig = new LauncherConfig();
        }
        $form = $this->createForm(LauncherConfigType::class, $launcherConfig);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            if ($launcherConfigRepository->find(1) == null) {
                $launcherConfig->setId(1);
                $entityManager->persist($launcherConfig);
            }
            $entityManager->flush();

            return $this->redirectToRoute('config_launcher_index');
        }

        return $this->render('config_launcher/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}

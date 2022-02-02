<?php

namespace App\Controller;

use App\Entity\Download;
use App\Entity\LauncherConfig;
use App\Form\DownloadFormType;
use App\Form\LauncherConfigType;
use App\Repository\DownloadRepository;
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
     * @Route("/", name="config_launcher_landing")
     */
    public function landing(){
        return $this->render('config_download/landing.html.twig', [
        ]);
    }

    /**
     * @Route("/download", name="config_download")
     */
    public function download(DownloadRepository $downloadRepository, Request $request): Response
    {
        $download = $downloadRepository->find(1);
        if ($download == null) {
            $download = new Download();
        }
        $form = $this->createForm(DownloadFormType::class, $download);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if ($downloadRepository->find(1) == null) {
                $download->setId(1);
                $em->persist($download);
            }
            $em->flush();
            return $this->redirectToRoute('config_download');
        }


        return $this->render('config_download/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/settings", name="config_launcher_index", methods={"GET", "POST"})
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

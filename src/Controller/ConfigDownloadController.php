<?php

namespace App\Controller;

use App\Entity\Download;
use App\Form\DownloadFormType;
use App\Repository\DownloadRepository;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConfigDownloadController extends AbstractController
{
    /**
     * @Route("/config/download", name="config_download")
     */
    public function index(DownloadRepository $downloadRepository, Request $request): Response
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
}

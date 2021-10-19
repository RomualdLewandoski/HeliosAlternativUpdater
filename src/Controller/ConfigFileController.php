<?php

namespace App\Controller;

use App\Entity\Files;
use App\Form\FilesType;
use App\Repository\FilesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/config/file")
 */
class ConfigFileController extends AbstractController
{
    /**
     * @Route("/", name="config_file_index", methods={"GET"})
     */
    public function index(FilesRepository $filesRepository): Response
    {
        return $this->render('config_file/index.html.twig', [
            'files' => $filesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="config_file_new", methods={"GET","POST"})
     */
    public function new(Request $request, ParameterBagInterface $params): Response
    {
        $file = new Files();
        $form = $this->createForm(FilesType::class, $file);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $file->setType("File");
            $webPath = $params->get('kernel.project_dir') . '/public/';
            $localFile = $webPath . $file->getUrl();
            $size = filesize($localFile);
            $file->setSize($size);
            if ($file->getIsMd5()) {
                $md5 = md5_file($localFile);
                $file->setMd5($md5);
            }
            $entityManager->persist($file);
            $entityManager->flush();

            return $this->redirectToRoute('config_file_index');
        }

        return $this->render('config_file/new.html.twig', [
            'file' => $file,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="config_file_show", methods={"GET"})
     */
    public function show(Files $file): Response
    {
        return $this->render('config_file/show.html.twig', [
            'file' => $file,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="config_file_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Files $file, ParameterBagInterface $params): Response
    {
        $form = $this->createForm(FilesType::class, $file);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file->setType("File");
            $webPath = $params->get('kernel.project_dir') . '/public/';
            $localFile = $webPath . $file->getUrl();
            $size = filesize($localFile);
            $file->setSize($size);
            if ($file->getIsMd5()) {
                $md5 = md5_file($localFile);
                $file->setMd5($md5);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('config_file_index');
        }

        return $this->render('config_file/edit.html.twig', [
            'file' => $file,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="config_file_delete", methods={"POST"})
     */
    public function delete(Request $request, Files $file): Response
    {
        if ($this->isCsrfTokenValid('delete' . $file->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($file);
            $entityManager->flush();
        }

        return $this->redirectToRoute('config_file_index');
    }
}

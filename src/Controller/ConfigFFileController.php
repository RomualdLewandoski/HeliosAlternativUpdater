<?php

namespace App\Controller;

use App\Entity\FFile;
use App\Form\FFileType;
use App\Repository\FFileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/config/ffile")
 */
class ConfigFFileController extends AbstractController
{
    /**
     * @Route("/", name="config_f_file_index")
     */
    public function landing(){
        return $this->render('config_f_file/landing.html.twig', [

        ]);
    }

    /**
     * @Route("/misc/list", name="config_f_file_misc_list", methods={"GET"})
     */
    public function index(FFileRepository $fFileRepository): Response
    {
        return $this->render('config_f_file/index.html.twig', [
            'f_files' => $fFileRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="config_f_file_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $fFile = new FFile();
        $form = $this->createForm(FFileType::class, $fFile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fFile);
            $entityManager->flush();

            return $this->redirectToRoute('config_f_file_index');
        }

        return $this->render('config_f_file/new.html.twig', [
            'f_file' => $fFile,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="config_f_file_show", methods={"GET"})
     */
    public function show(FFile $fFile): Response
    {
        return $this->render('config_f_file/show.html.twig', [
            'f_file' => $fFile,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="config_f_file_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, FFile $fFile): Response
    {
        $form = $this->createForm(FFileType::class, $fFile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('config_f_file_index');
        }

        return $this->render('config_f_file/edit.html.twig', [
            'f_file' => $fFile,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="config_f_file_delete", methods={"POST"})
     */
    public function delete(Request $request, FFile $fFile): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fFile->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($fFile);
            $entityManager->flush();
        }

        return $this->redirectToRoute('config_f_file_index');
    }
}

<?php

namespace App\Controller;

use App\Entity\Library;
use App\Form\LibraryType;
use App\Repository\LibraryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/config/library")
 */
class ConfigLibraryController extends AbstractController
{
    /**
     * @Route("/", name="config_library_index", methods={"GET"})
     */
    public function index(LibraryRepository $libraryRepository): Response
    {
        return $this->render('config_library/index.html.twig', [
            'libraries' => $libraryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="config_library_new", methods={"GET","POST"})
     */
    public function new(Request $request, ParameterBagInterface $params): Response
    {
        $library = new Library();
        $form = $this->createForm(LibraryType::class, $library);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $library->setType("Library");
            $webPath = $params->get('kernel.project_dir') . '/public/';
            $file = $webPath . $library->getUrl();
            $size = filesize($file);
            $library->setSize($size);
            $md5 = md5_file($file);
            $library->setMd5($md5);
            $entityManager->persist($library);
            $entityManager->flush();

            return $this->redirectToRoute('config_library_index');
        }

        return $this->render('config_library/new.html.twig', [
            'library' => $library,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="config_library_show", methods={"GET"})
     */
    public function show(Library $library): Response
    {
        return $this->render('config_library/show.html.twig', [
            'library' => $library,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="config_library_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Library $library, ParameterBagInterface $params): Response
    {
        $form = $this->createForm(LibraryType::class, $library);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $library->setType("Library");
            $webPath = $params->get('kernel.project_dir') . '/public/';
            $file = $webPath . $library->getUrl();
            $size = filesize($file);
            $library->setSize($size);
            $md5 = md5_file($file);
            $library->setMd5($md5);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('config_library_index');
        }

        return $this->render('config_library/edit.html.twig', [
            'library' => $library,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="config_library_delete", methods={"POST"})
     */
    public function delete(Request $request, Library $library): Response
    {
        if ($this->isCsrfTokenValid('delete'.$library->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($library);
            $entityManager->flush();
        }

        return $this->redirectToRoute('config_library_index');
    }
}

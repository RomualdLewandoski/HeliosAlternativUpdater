<?php

namespace App\Controller;

use App\Entity\RessourcePack;
use App\Form\RessourcePackType;
use App\Repository\RessourcePackRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/config/ressourcepack")
 */
class ConfigRessourcepackController extends AbstractController
{
    /**
     * @Route("/", name="config_ressourcepack_index", methods={"GET"})
     */
    public function index(RessourcePackRepository $ressourcePackRepository): Response
    {
        return $this->render('config_ressourcepack/index.html.twig', [
            'ressource_packs' => $ressourcePackRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="config_ressourcepack_new", methods={"GET","POST"})
     */
    public function new(Request $request, ParameterBagInterface $params): Response
    {
        $ressourcePack = new RessourcePack();
        $form = $this->createForm(RessourcePackType::class, $ressourcePack);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $ressourcePack->setType("File");
            $webPath = $params->get('kernel.project_dir') . '/public/';
            $file = $webPath . $ressourcePack->getUrl();
            $size = filesize($file);
            $ressourcePack->setSize($size);
            $md5 = md5_file($file);
            $ressourcePack->setMd5($md5);
            $ressourcePack->setPath("resourcepacks/" . str_replace(" ", "-", $ressourcePack->getName()) . ".zip");
            $entityManager->persist($ressourcePack);
            $entityManager->flush();

            return $this->redirectToRoute('config_ressourcepack_index');
        }

        return $this->render('config_ressourcepack/new.html.twig', [
            'ressource_pack' => $ressourcePack,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="config_ressourcepack_show", methods={"GET"})
     */
    public function show(RessourcePack $ressourcePack): Response
    {
        return $this->render('config_ressourcepack/show.html.twig', [
            'ressource_pack' => $ressourcePack,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="config_ressourcepack_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, RessourcePack $ressourcePack, ParameterBagInterface $params): Response
    {
        $form = $this->createForm(RessourcePackType::class, $ressourcePack);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ressourcePack->setType("File");
            $webPath = $params->get('kernel.project_dir') . '/public/';
            $file = $webPath . $ressourcePack->getUrl();
            $size = filesize($file);
            $ressourcePack->setSize($size);
            $md5 = md5_file($file);
            $ressourcePack->setMd5($md5);
            $ressourcePack->setPath("resourcepacks/" . str_replace(" ", "-", $ressourcePack->getName()) . ".zip");
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('config_ressourcepack_index');
        }

        return $this->render('config_ressourcepack/edit.html.twig', [
            'ressource_pack' => $ressourcePack,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="config_ressourcepack_delete", methods={"POST"})
     */
    public function delete(Request $request, RessourcePack $ressourcePack): Response
    {
        if ($this->isCsrfTokenValid('delete' . $ressourcePack->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ressourcePack);
            $entityManager->flush();
        }

        return $this->redirectToRoute('config_ressourcepack_index');
    }
}

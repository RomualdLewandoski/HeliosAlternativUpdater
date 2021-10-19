<?php

namespace App\Controller;

use App\Entity\ForgeHosted;
use App\Form\ForgeHostedType;
use App\Repository\ForgeHostedRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/config/forge/hosted")
 */
class ConfigForgeHostedController extends AbstractController
{
    /**
     * @Route("/", name="config_forge_hosted_index", methods={"GET"})
     */
    public function index(ForgeHostedRepository $forgeHostedRepository): Response
    {
        return $this->render('config_forge_hosted/index.html.twig', [
            'forge_hosteds' => $forgeHostedRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="config_forge_hosted_new", methods={"GET","POST"})
     */
    public function new(Request $request, ParameterBagInterface $params): Response
    {
        $forgeHosted = new ForgeHosted();
        $form = $this->createForm(ForgeHostedType::class, $forgeHosted);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $forgeHosted->setType("ForgeHosted");
            $webPath = $params->get('kernel.project_dir') . '/public/';
            $file = $webPath . $forgeHosted->getUrl();
            $size = filesize($file);
            $forgeHosted->setSize($size);
            $md5 = md5_file($file);
            $forgeHosted->setMd5($md5);


            $entityManager->persist($forgeHosted);
            $entityManager->flush();

            return $this->redirectToRoute('config_forge_hosted_index');
        }

        return $this->render('config_forge_hosted/new.html.twig', [
            'forge_hosted' => $forgeHosted,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="config_forge_hosted_show", methods={"GET"})
     */
    public function show(ForgeHosted $forgeHosted): Response
    {
        return $this->render('config_forge_hosted/show.html.twig', [
            'forge_hosted' => $forgeHosted,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="config_forge_hosted_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ForgeHosted $forgeHosted, ParameterBagInterface $params): Response
    {
        $form = $this->createForm(ForgeHostedType::class, $forgeHosted);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $forgeHosted->setType("ForgeHosted");
            $webPath = $params->get('kernel.project_dir') . '/public/';
            $file = $webPath . $forgeHosted->getUrl();
            $size = filesize($file);
            $forgeHosted->setSize($size);
            $md5 = md5_file($file);
            $forgeHosted->setMd5($md5);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('config_forge_hosted_index');
        }

        return $this->render('config_forge_hosted/edit.html.twig', [
            'forge_hosted' => $forgeHosted,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="config_forge_hosted_delete", methods={"POST"})
     */
    public function delete(Request $request, ForgeHosted $forgeHosted): Response
    {
        if ($this->isCsrfTokenValid('delete' . $forgeHosted->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($forgeHosted);
            $entityManager->flush();
        }

        return $this->redirectToRoute('config_forge_hosted_index');
    }
}

<?php

namespace App\Controller;

use App\Entity\Version;
use App\Form\VersionType;
use App\Repository\VersionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/config/version")
 */
class ConfigVersionController extends AbstractController
{
    /**
     * @Route("/", name="config_version_index", methods={"GET"})
     */
    public function index(VersionRepository $versionRepository): Response
    {
        return $this->render('config_version/index.html.twig', [
            'versions' => $versionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="config_version_new", methods={"GET","POST"})
     */
    public function new(Request $request, ParameterBagInterface $params): Response
    {
        $version = new Version();
        $form = $this->createForm(VersionType::class, $version);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $version->setType("VersionManifest");
            $webPath = $params->get('kernel.project_dir') . '/public/';
            $file = $webPath . $version->getUrl();
            $size = filesize($file);
            $version->setSize($size);
            $md5 = md5_file($file);
            $version->setMd5($md5);
            $entityManager->persist($version);
            $entityManager->flush();

            return $this->redirectToRoute('config_version_index');
        }

        return $this->render('config_version/new.html.twig', [
            'version' => $version,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="config_version_show", methods={"GET"})
     */
    public function show(Version $version): Response
    {
        return $this->render('config_version/show.html.twig', [
            'version' => $version,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="config_version_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Version $version, ParameterBagInterface $params): Response
    {
        $form = $this->createForm(VersionType::class, $version);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $version->setType("VersionManifest");
            $webPath = $params->get('kernel.project_dir') . '/public/';
            $file = $webPath . $version->getUrl();
            $size = filesize($file);
            $version->setSize($size);
            $md5 = md5_file($file);
            $version->setMd5($md5);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('config_version_index');
        }

        return $this->render('config_version/edit.html.twig', [
            'version' => $version,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="config_version_delete", methods={"POST"})
     */
    public function delete(Request $request, Version $version): Response
    {
        if ($this->isCsrfTokenValid('delete'.$version->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($version);
            $entityManager->flush();
        }

        return $this->redirectToRoute('config_version_index');
    }
}

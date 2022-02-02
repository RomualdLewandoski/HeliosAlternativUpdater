<?php

namespace App\Controller;

use App\Entity\FMod;
use App\Form\FModType;
use App\Repository\FModRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/config/fmod")
 */
class ConfigFModController extends AbstractController
{
    /**
     * @Route("/", name="config_f_mod_index", methods={"GET"})
     */
    public function index(FModRepository $fModRepository): Response
    {
        return $this->render('config_f_mod/index.html.twig', [
            'f_mods' => $fModRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="config_f_mod_new", methods={"GET","POST"})
     */
    public function new(Request $request, ParameterBagInterface $params): Response
    {
        $fMod = new FMod();
        $form = $this->createForm(FModType::class, $fMod);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $path = $params->get('kernel.project_dir').'/public/';

            $file = $path . $fMod->getUrl();
            $size = filesize($file);
            $fMod->setSize($size);
            $fMod->setSha(sha1_file($file));

            if (!str_ends_with($fMod->getName(), ".jar")){
                $fMod->setName($fMod->getName().".jar");
            }

            $entityManager->persist($fMod);
            $entityManager->flush();

            return $this->redirectToRoute('config_f_mod_index');
        }

        return $this->render('config_f_mod/new.html.twig', [
            'f_mod' => $fMod,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="config_f_mod_show", methods={"GET"})
     */
    public function show(FMod $fMod): Response
    {
        return $this->render('config_f_mod/show.html.twig', [
            'f_mod' => $fMod,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="config_f_mod_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, FMod $fMod, ParameterBagInterface $params): Response
    {
        $form = $this->createForm(FModType::class, $fMod);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $path = $params->get('kernel.project_dir').'/public/';
            $file = $path . $fMod->getUrl();
            $fMod->setSize(filesize($file));
            $fMod->setSha(sha1_file($file));
            if (!str_ends_with($fMod->getName(), ".jar")){
                $fMod->setName($fMod->getName().".jar");
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('config_f_mod_index');
        }

        return $this->render('config_f_mod/edit.html.twig', [
            'f_mod' => $fMod,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="config_f_mod_delete", methods={"POST"})
     */
    public function delete(Request $request, FMod $fMod): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fMod->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($fMod);
            $entityManager->flush();
        }

        return $this->redirectToRoute('config_f_mod_index');
    }
}

<?php

namespace App\Controller;

use App\Entity\Mod;
use App\Form\ModType;
use App\Repository\ModRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/config/mod")
 */
class ConfigModController extends AbstractController
{
    /**
     * @Route("/", name="config_mod_index", methods={"GET"})
     */
    public function index(ModRepository $modRepository): Response
    {
        return $this->render('config_mod/index.html.twig', [
            'mods' => $modRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="config_mod_new", methods={"GET","POST"})
     */
    public function new(Request $request, ParameterBagInterface $params): Response
    {
        $mod = new Mod();
        $form = $this->createForm(ModType::class, $mod);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $mod->setType("ForgeMod");
            $webPath = $params->get('kernel.project_dir') . '/public/';
            $file = $webPath . $mod->getUrl();
            $size = filesize($file);
            $mod->setSize($size);
            $md5 = sha1_file($file);
            $mod->setMd5($md5);

            if ($mod->getIsRequired()) {
                $mod->setIsEnabled(true);
            }

            $entityManager->persist($mod);
            $entityManager->flush();

            return $this->redirectToRoute('config_mod_index');
        }

        return $this->render('config_mod/new.html.twig', [
            'mod' => $mod,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="config_mod_show", methods={"GET"})
     */
    public function show(Mod $mod): Response
    {
        return $this->render('config_mod/show.html.twig', [
            'mod' => $mod,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="config_mod_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Mod $mod, ParameterBagInterface $params): Response
    {
        $form = $this->createForm(ModType::class, $mod);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mod->setType("ForgeMod");
            $webPath = $params->get('kernel.project_dir') . '/public/';
            $file = $webPath . $mod->getUrl();
            $size = filesize($file);
            $mod->setSize($size);
            $md5 = sha1_file($file);
            $mod->setMd5($md5);
            if ($mod->getIsRequired()) {
                $mod->setIsEnabled(true);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('config_mod_index');
        }

        return $this->render('config_mod/edit.html.twig', [
            'mod' => $mod,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="config_mod_delete", methods={"POST"})
     */
    public function delete(Request $request, Mod $mod): Response
    {
        if ($this->isCsrfTokenValid('delete' . $mod->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($mod);
            $entityManager->flush();
        }

        return $this->redirectToRoute('config_mod_index');
    }
}

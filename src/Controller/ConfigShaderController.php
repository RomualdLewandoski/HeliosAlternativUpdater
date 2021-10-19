<?php

namespace App\Controller;

use App\Entity\Shader;
use App\Form\ShaderType;
use App\Repository\ShaderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/config/shader")
 */
class ConfigShaderController extends AbstractController
{
    /**
     * @Route("/", name="config_shader_index", methods={"GET"})
     */
    public function index(ShaderRepository $shaderRepository): Response
    {
        return $this->render('config_shader/index.html.twig', [
            'shaders' => $shaderRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="config_shader_new", methods={"GET","POST"})
     */
    public function new(Request $request, ParameterBagInterface $params): Response
    {
        $shader = new Shader();
        $form = $this->createForm(ShaderType::class, $shader);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $shader->setType("File");
            $webPath = $params->get('kernel.project_dir') . '/public/';
            $file = $webPath . $shader->getUrl();
            $size = filesize($file);
            $shader->setSize($size);
            $md5 = md5_file($file);
            $shader->setMd5($md5);
            $shader->setPath("shaderpacks/" . str_replace(" ", "-", $shader->getName()) . ".zip");
            $entityManager->persist($shader);
            $entityManager->flush();

            return $this->redirectToRoute('config_shader_index');
        }

        return $this->render('config_shader/new.html.twig', [
            'shader' => $shader,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="config_shader_show", methods={"GET"})
     */
    public function show(Shader $shader): Response
    {
        return $this->render('config_shader/show.html.twig', [
            'shader' => $shader,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="config_shader_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Shader $shader, ParameterBagInterface $params): Response
    {
        $form = $this->createForm(ShaderType::class, $shader);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $shader->setType("File");
            $webPath = $params->get('kernel.project_dir') . '/public/';
            $file = $webPath . $shader->getUrl();
            $size = filesize($file);
            $shader->setSize($size);
            $md5 = md5_file($file);
            $shader->setMd5($md5);
            $shader->setPath("shaderpacks/" . str_replace(" ", "-", $shader->getName()) . ".zip");
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('config_shader_index');
        }

        return $this->render('config_shader/edit.html.twig', [
            'shader' => $shader,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="config_shader_delete", methods={"POST"})
     */
    public function delete(Request $request, Shader $shader): Response
    {
        if ($this->isCsrfTokenValid('delete' . $shader->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($shader);
            $entityManager->flush();
        }

        return $this->redirectToRoute('config_shader_index');
    }
}

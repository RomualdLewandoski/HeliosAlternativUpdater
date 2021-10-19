<?php

namespace App\Controller;

use App\Entity\Server;
use App\Form\ServerType;
use App\Repository\ServerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/config/servers")
 */
class ConfigServersController extends AbstractController
{
    /**
     * @Route("/", name="config_servers_index", methods={"GET"})
     */
    public function index(ServerRepository $serverRepository): Response
    {
        return $this->render('config_servers/index.html.twig', [
            'servers' => $serverRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="config_servers_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $server = new Server();
        $form = $this->createForm(ServerType::class, $server);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($server);
            $entityManager->flush();
            

            return $this->redirectToRoute('config_servers_index');
        }

        return $this->render('config_servers/new.html.twig', [
            'server' => $server,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="config_servers_show", methods={"GET"})
     */
    public function show(Server $server): Response
    {
        return $this->render('config_servers/show.html.twig', [
            'server' => $server,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="config_servers_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Server $server): Response
    {
        $form = $this->createForm(ServerType::class, $server);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();


            return $this->redirectToRoute('config_servers_index');
        }

        return $this->render('config_servers/edit.html.twig', [
            'server' => $server,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="config_servers_delete", methods={"POST"})
     */
    public function delete(Request $request, Server $server): Response
    {
        if ($this->isCsrfTokenValid('delete' . $server->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($server);
            $entityManager->flush();
        }

        return $this->redirectToRoute('config_servers_index');
    }
}

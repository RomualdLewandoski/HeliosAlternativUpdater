<?php

namespace App\Controller;

use App\Entity\Library;
use App\Entity\Server;
use App\Entity\Version;
use App\Form\JsonImportType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConfigJsonImportController extends AbstractController
{
    /**
     * @Route("/config/json/import", name="config_json_import")
     */
    public function index(Request $request, ParameterBagInterface $params): Response
    {

        $form = $this->createForm(JsonImportType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $json = $form->get('json')->getData();
            $server = $form->get('server')->getData();
            dump($server);
            $json = json_decode($json);
            $em = $this->getDoctrine()->getManager();

            foreach ($json as $obj) {
                if ($obj->type == "VersionManifest") {
                    $version = (new Version())
                        ->setIdName($obj->id)
                        ->setName($obj->name)
                        ->setType("VersionManifest")
                        ->setSize($obj->artifact->size)
                        ->setMd5($obj->artifact->MD5)
                        ->setUrl($this->getPath($obj));
                    $em->persist($version);
                    $server->setVersionManifest($version);
                    $em->flush();
                } elseif ($obj->type == "Library") {
                    $lib = (new Library())
                        ->setIdName($obj->id)
                        ->setName($obj->name)
                        ->setType("Library")
                        ->setSize($obj->artifact->size)
                        ->setMd5($obj->artifact->MD5)
                        ->setUrl($this->getPath($obj));
                    $lib->addServer($server);
                    $em->persist($lib);
                    $em->flush();
                }
            }
        }

        return $this->render('config_json_import/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    private function getPath($obj)
    {
        if ($obj->type == "VersionManifest") {
            $url = $obj->artifact->url;
            return "/uploads" . str_replace("http://localhost:8080/repo", "", $url);
        } else if ($obj->type == "Library") {
            $url = $obj->artifact->url;
            return "/uploads" . str_replace("http://localhost:8080/repo/lib", "/Librairies", $url);
        } else {
            return "";
        }
    }
}

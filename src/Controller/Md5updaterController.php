<?php

namespace App\Controller;

use App\Repository\FilesRepository;
use App\Repository\ForgeHostedRepository;
use App\Repository\LibraryRepository;
use App\Repository\ModRepository;
use App\Repository\RessourcePackRepository;
use App\Repository\ServerRepository;
use App\Repository\ShaderRepository;
use App\Repository\VersionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Md5updaterController extends AbstractController
{
    /**
     * @Route("/md5updater", name="md5updater")
     */
    public function index(ParameterBagInterface $params,
                          FilesRepository $filesRepository,
                          ForgeHostedRepository $forgeHostedRepository,
                          LibraryRepository $libraryRepository,
                          ModRepository $modRepository,
                          RessourcePackRepository $ressourcePackRepository,
                          ShaderRepository $shaderRepository,
                          VersionRepository $versionRepository): JsonResponse
    {
        $obj = new \stdClass();

        $webPath = $params->get('kernel.project_dir') . '/public/';
        $em = $this->getDoctrine()->getManager();

        $obj->filesStart = "Starting update for files";
        $files = $filesRepository->findAll();
        $fileCount = 0;
        foreach ($files as $file) {
            $localFile = $webPath . $file->getUrl();
            $size = filesize($localFile);
            $file->setSize($size);
            if ($file->getIsMd5()) {
                $md5 = md5_file($localFile);
                $file->setMd5($md5);
                $fileCount++;
            }
            $em->flush();
        }
        $obj->filesEnd = "Md5 for files ok ";
        $obj->filesCount = $fileCount;
        $obj->forgeHostedStart = "Starting update for forge hosted";
        $forgeHostedCount = 0;
        foreach ($forgeHostedRepository->findAll() as $forgeHosted) {
            $file = $webPath . $forgeHosted->getUrl();
            $size = filesize($file);
            $forgeHosted->setSize($size);
            $md5 = md5_file($file);
            $forgeHosted->setMd5($md5);
            $forgeHostedCount++;
            $em->flush();
        }
        $obj->forgeEnd = "Md5 for forgehosted ok ";
        $obj->forgeCount = $forgeHostedCount;

        $obj->libsStarts = "Starting update for libraries";
        $libsCount = 0;
        foreach ($libraryRepository->findAll() as $library) {
            $file = $webPath . $library->getUrl();
            $size = filesize($file);
            $library->setSize($size);
            $md5 = md5_file($file);
            $library->setMd5($md5);
            $libsCount++;
            $em->flush();
        }
        $obj->libsEnd = "Md5 for libs ok ";
        $obj->libsCount = $libsCount;

        $obj->modsStarts = "Starting update for mods";
        $modsCount = 0;

        foreach ($modRepository->findAll() as $mod) {
            $file = $webPath . $mod->getUrl();
            $size = filesize($file);
            $mod->setSize($size);
            $md5 = md5_file($file);
            $mod->setMd5($md5);
            $modsCount++;
            $em->flush();

        }
        $obj->modsEnd = "Md5 for mods ok ";
        $obj->modsCount = $modsCount;


        $obj->ressourcesStart = "Starting update for ressourcespack";
        $ressCount = 0;

        foreach ($ressourcePackRepository->findAll() as $ressourcePack){
            $file = $webPath . $ressourcePack->getUrl();
            $size = filesize($file);
            $ressourcePack->setSize($size);
            $md5 = md5_file($file);
            $ressourcePack->setMd5($md5);
            $ressCount++;
            $em->flush();
        }

        $obj->ressourcesEnd = "Md5 for ressources packs ok ";
        $obj->ressourcesCount = $ressCount;

        $obj->shaderStart = "Starting update for shaders";
        $shaderCount = 0;

        foreach ($shaderRepository->findAll() as $shader) {
            $file = $webPath . $shader->getUrl();
            $size = filesize($file);
            $shader->setSize($size);
            $md5 = md5_file($file);
            $shader->setMd5($md5);
            $shaderCount++;
            $em->flush();
        }

        $obj->shadersEnd = "Md5 for shader ok ";
        $obj->shadersCount = $shaderCount;

        $obj->versionsStart = "Starting update for versions";
        $versionCount = 0;

        foreach ($versionRepository->findAll() as $version){
            $file = $webPath . $version->getUrl();
            $size = filesize($file);
            $version->setSize($size);
            $md5 = md5_file($file);
            $version->setMd5($md5);
            $versionCount++;
            $em->flush();
        }

        $obj->versionsEnd = "Md5 for version ok ";
        $obj->versionCount = $versionCount;

        return new JsonResponse($obj);
    }
}

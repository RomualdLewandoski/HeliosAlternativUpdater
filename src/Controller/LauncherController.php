<?php

namespace App\Controller;

use App\Repository\LauncherConfigRepository;
use stdClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LauncherController extends AbstractController
{
    /**
     * @Route("/launcher", name="launcher")
     */
    public function index(LauncherConfigRepository $launcherConfigRepository, Request $request): JsonResponse
    {

        $url = $request->getUri();
        $url = str_replace("eu/launcher", "eu", $url);
        $launcher = $launcherConfigRepository->find(1);
        $obj = new stdClass();
        if ($launcher == null) {
            $obj->state = false;
            $obj->err = "Merci de faire la configuration du launcher";
        } else {
            $obj->fallbackVideo = $url.$launcher->getFallbackVideo();
            $obj->fallbackAudio = $launcher->getFallbackAudio() == null ? "" : $url.$launcher->getFallbackAudio();
            $obj->loginApi = $launcher->getLoginApi();
            $obj->skinApi = $launcher->getSkinApi();
            $obj->serverIp = $launcher->getServerIp();
            $obj->serverPort = $launcher->getServerPort();
            $obj->distroList = $launcher->getDistroList();
            $obj->siteName = $launcher->getSiteName();
            $obj->newsApi = $launcher->getNewsApi();
        }


        return new JsonResponse($obj);

    }
}

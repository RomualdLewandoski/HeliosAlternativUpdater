<?php

namespace App\Controller;

use App\Entity\LauncherConfig;
use App\Repository\DiscordConfigRepository;
use App\Repository\LauncherConfigRepository;
use App\Repository\ServerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DistroController extends AbstractController
{
    /**
     * @Route("/distro", name="distro")
     */
    public function index(DiscordConfigRepository $discordConfigRepository, ServerRepository $serverRepository, LauncherConfigRepository $launcherConfigRepository, Request $request): JsonResponse
    {

        $url = $request->getUri();
        $url = str_replace("/distro", "", $url);

        $obj = new \stdClass();
        $discordConf = $discordConfigRepository->find(1);
        if ($discordConf == null) {
            $obj->erreur = "Merci de faire la configuration sur le site avant de charger le json (discord conf)";
            return new JsonResponse($obj);
        } else {
            $launcherConfig = $launcherConfigRepository->find(1);

            if ($launcherConfig == null) {
                $obj->erreur = "Merci de faire la configuration sur le site avant de charger le json (launcher config)";
                return new JsonResponse($obj);
            } else {
                $servers = $serverRepository->findAll();
                $obj->version = $launcherConfig->getVersion();
                $discordObj = new \stdClass();
                $discordObj->clientId = $discordConf->getClientId();
                $discordObj->smallImageText = $discordConf->getSmallImageText();
                $discordObj->smallImageKey = $discordConf->getSmallImageKey();
                $obj->discord = $discordObj;

                $javaObj = new \stdClass();
                $javaObj->oracle = $launcherConfig->getJava();
                $obj->java = $javaObj;
                $obj->rss = "";

                //on passe aux serveurs
                $servArr = [];
                foreach ($servers as $server) {
                    $serverObj = new \stdClass();
                    $serverObj->id = $server->getNameId();
                    $serverObj->name = $server->getName();
                    $serverObj->description = $server->getDescription();
                    $serverObj->icon = $url . $server->getIcon();
                    $serverObj->version = $server->getVersion();
                    $serverObj->address = $server->getAddress();
                    $serverObj->minecraftVersion = $server->getMinecraftVersion();
                    $discordObj2 = new \stdClass();
                    $discordObj2->shortId = "Ezariel";
                    $discordObj2->largeImageText = $discordConf->getSmallImageText();
                    $discordObj2->largeImageKey = $discordConf->getSmallImageKey();
                    $serverObj->discord = $discordObj2;
                    $serverObj->mainServer = $server->getMainServer();
                    $serverObj->autoconnect = $server->getAutoConnect();

                    $moduleArr = [];
                    //ForgeHostedFile HERE
                    $forgeHosted = $server->getForgeHosted();
                    $forgeHostedObj = new \stdClass();
                    $forgeHostedObj->id = $forgeHosted->getIdName();
                    $forgeHostedObj->name = $forgeHosted->getName();
                    $forgeHostedObj->type = $forgeHosted->getType();
                    $forgeHostedArtifact = new \stdClass();
                    $forgeHostedArtifact->size = $forgeHosted->getSize();
                    $forgeHostedArtifact->MD5 = $forgeHosted->getMd5();
                    $forgeHostedArtifact->url = $url . $forgeHosted->getUrl();
                    $forgeHostedObj->artifact = $forgeHostedArtifact;
                    $subModulesArr = [];
                    $version = $server->getVersionManifest();
                    if ($version != null){
                        $versionObj = new \stdClass();
                        $versionObj->id = $version->getIdName();
                        $versionObj->name = $version->getName();
                        $versionObj->type = $version->getType();
                        $versionArtifact = new \stdClass();
                        $versionArtifact->size = $version->getSize();
                        $versionArtifact->MD5 = $version->getMd5();
                        $versionArtifact->url = $url . $version->getUrl();
                        $versionObj->artifact = $versionArtifact;
                        array_push($subModulesArr, $versionObj);
                    }

                    foreach ($server->getLibraries() as $lib) {
                        $libObj = new \stdClass();
                        $libObj->id = $lib->getIdName();
                        $libObj->name = $lib->getName();
                        $libObj->type = $lib->getType();
                        $libArtifact = new \stdClass();
                        $libArtifact->size = $lib->getSize();
                        $libArtifact->MD5 = $lib->getMd5();
                        $libArtifact->url = $url . $lib->getUrl();
                        $libObj->artifact = $libArtifact;
                        array_push($subModulesArr, $libObj);
                    }
                    $forgeHostedObj->subModules = $subModulesArr;
                    array_push($moduleArr, $forgeHostedObj);

                    //mods

                    foreach ($server->getMods() as $mod) {
                        $modObj = new \stdClass();
                        $modObj->id = $mod->getIdName();
                        $modObj->name = $mod->getName();
                        $modObj->type = $mod->getType();
                        $modReqObj = new \stdClass();
                        $modReqObj->value = $mod->getIsRequired();
                        $modReqObj->def = $mod->getIsEnabled();
                        $modObj->required = $modReqObj;

                        $modArtifact = new \stdClass();
                        $modArtifact->size = $mod->getSize();
                        $modArtifact->MD5 = $mod->getMd5();
                        $modArtifact->url = $url . $mod->getUrl();
                        $modObj->artifact = $modArtifact;
                        array_push($moduleArr, $modObj);
                    }

                    //files goes here
                    foreach ($server->getFiles() as $file) {
                        $fileObj = new \stdClass();
                        $fileObj->id = $file->getIdName();
                        $fileObj->name = $file->getName();
                        $fileObj->type = $file->getType();
                        $fileArtifact = new \stdClass();
                        $fileArtifact->size = $file->getSize();
                        if ($file->getIsMd5()) {
                            $fileArtifact->MD5 = $file->getMd5();
                        }
                        $fileArtifact->path = $file->getPath();
                        $fileArtifact->url = $url . $file->getUrl();
                        $fileObj->artifact = $fileArtifact;
                        array_push($moduleArr, $fileObj);
                    }

                    //shader goes here
                    foreach ($server->getShaders() as $shader) {
                        $shaderObj = new \stdClass();
                        $shaderObj->id = $shader->getIdName();
                        $shaderObj->name = $shader->getName();
                        $shaderObj->type = $shader->getType();
                        $shaderArtifact = new \stdClass();
                        $shaderArtifact->size = $shader->getSize();
                        $shaderArtifact->MD5 = $shader->getMd5();
                        $shaderArtifact->path = $shader->getPath();
                        $shaderArtifact->url = $url . $shader->getUrl();
                        $shaderObj->artifact = $shaderArtifact;
                        array_push($moduleArr, $shaderObj);
                    }

                    //ressourcePack goes here
                    foreach ($server->getRessourcePacks() as $ress) {
                        $ressObj = new \stdClass();
                        $ressObj->id = $ress->getIdName();
                        $ressObj->name = $ress->getName();
                        $ressObj->type = $ress->getType();
                        $ressArtifact = new \stdClass();
                        $ressArtifact->size = $ress->getSize();
                        $ressArtifact->MD5 = $ress->getMd5();
                        $ressArtifact->path = $ress->getPath();
                        $ressArtifact->url = $url . $ress->getUrl();
                        $ressObj->artifact = $ressArtifact;
                        array_push($moduleArr, $ressObj);
                    }

                    //end of modules generation
                    $serverObj->modules = $moduleArr;

                    //end of server generation
                    array_push($servArr, $serverObj);
                }
                $obj->servers = $servArr;

                return new JsonResponse($obj);
            }

        }

    }
}

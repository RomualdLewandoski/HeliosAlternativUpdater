<?php

namespace App\Controller;

use App\Entity\Download;
use App\Repository\DownloadRepository;
use App\Repository\StatsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

class DownloadController extends AbstractController
{
    /**
     * @Route("/download/windows", name="download_winddows")
     */
    public function index(DownloadRepository $downloadRepository, ParameterBagInterface $params, StatsRepository $statsRepository): Response
    {
        $download = $downloadRepository->find(1);
        $stat = $statsRepository->find(1);

        $webPath = $params->get('kernel.project_dir') . '/public/';
        $file = $webPath . urldecode($download->getWindowsFile());

        $stat->setWindowsLauncher($stat->getWindowsLauncher()+1);
        $this->getDoctrine()->getManager()->flush();

        $response = new BinaryFileResponse($file);
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            str_replace("/uploads/Launcher/", "", urldecode($download->getWindowsFile()))
        );

        return $response;
    }

    /**
     * @Route("/download/mac", name="download_mac")
     */
    public function mac(DownloadRepository $downloadRepository, ParameterBagInterface $params, StatsRepository $statsRepository): Response
    {
        $download = $downloadRepository->find(1);
        $stat = $statsRepository->find(1);

        $webPath = $params->get('kernel.project_dir') . '/public/';
        $file = $webPath . urldecode($download->getMacFile());

        $stat->setMacLauncher($stat->getMacLauncher()+1);
        $this->getDoctrine()->getManager()->flush();

        $response = new BinaryFileResponse($file);
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            str_replace("/uploads/Launcher/", "", urldecode($download->getMacFile()))
        );

        return $response;
    }

    /**
     * @Route("/download/linux", name="download_linux")
     */
    public function linux(DownloadRepository $downloadRepository, ParameterBagInterface $params, StatsRepository $statsRepository): Response
    {
        $download = $downloadRepository->find(1);
        $stat = $statsRepository->find(1);

        $webPath = $params->get('kernel.project_dir') . '/public/';
        $file = $webPath . urldecode($download->getLinuxFile());

        $stat->setLinuxLauncher($stat->getLinuxLauncher()+1);
        $this->getDoctrine()->getManager()->flush();

        $response = new BinaryFileResponse($file);
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            str_replace("/uploads/Launcher/", "", urldecode($download->getLinuxFile()))
        );

        return $response;
    }
}

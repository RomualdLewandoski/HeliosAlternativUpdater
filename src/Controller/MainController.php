<?php

namespace App\Controller;

use App\Entity\Stats;
use App\Repository\StatsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(StatsRepository $statsRepository): Response
    {

        $stat = $statsRepository->find(1);
        if ($stat == null) {
            $stat = new Stats();
            $stat->setWindowsLauncher(0);
            $stat->setLinuxLauncher(0);
            $stat->setMacLauncher(0);
            $stat->setId(1);
            $em = $this->getDoctrine()->getManager();
            $em->persist($stat);
            $em->flush();
        }

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'stat'=>$stat
        ]);
    }
}

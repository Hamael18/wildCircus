<?php

namespace App\Controller;

use App\Entity\Performances;
use App\Form\PerformancesType;
use App\Repository\PerformancesRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PerformancesController extends AbstractController
{
    /**
     * @Route("/performances", name="performances")
     */
    public function index(PerformancesRepository $repo)
    {
        return $this->render('performances/index.html.twig', [
            'performances' => $repo->findAll(),
        ]);
    }
    /**
     * @Route("/performances/{id}", name="performances_show")
     * @param Performances $performance
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Performances $performance)
    {
        return $this->render('performances/show.html.twig',[
            'performance'=>$performance
        ]);
    }
}

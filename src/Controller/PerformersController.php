<?php

namespace App\Controller;

use App\Entity\Performers;
use App\Form\PerformersType;
use App\Repository\PerformersRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PerformersController extends AbstractController
{
    /**
     * @Route("/performers", name="performers")
     * @param PerformersRepository $repo
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(PerformersRepository $repo)
    {
        return $this->render('performers/index.html.twig', [
            'performers' => $repo->findAll(),
        ]);
    }



}

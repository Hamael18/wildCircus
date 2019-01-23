<?php

namespace App\Controller;

use App\Entity\AboutUs;
use App\Form\AboutUsType;
use App\Repository\AboutUsRepository;
use App\Repository\PerformancesRepository;
use App\Repository\PerformersRepository;
use App\Repository\PeriodRepository;
use App\Repository\PriceRepository;
use App\Repository\VisitorsRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

class AboutController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(
        AboutUsRepository $repo,
        PriceRepository $priceRepository,
        VisitorsRepository $visitorsRepository,
        PeriodRepository $periodRepository,
        PerformancesRepository $performancesRepository,
        PerformersRepository $performersRepository
    )
    {
        $nextPerformances = $performancesRepository->findBy([], ['date'=>'ASC', 'time'=>'ASC'], 3);
        $idLowest = array_values($nextPerformances)[0]->getId();

        return $this->render('about/index.html.twig', [
            'aboutUs' => $repo->findOneBy(['id'=>1]),
            'visitors'=> $visitorsRepository->findAll(),
            'periods'=> $periodRepository->findAll(),
            'prices'=> $priceRepository->findAll(),
            'performers'=> $performersRepository->findBy([], ['id'=>'DESC'], 3),
            'performances'=> $nextPerformances,
            'idLowest'=>$idLowest
        ]);
    }
}

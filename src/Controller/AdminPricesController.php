<?php

namespace App\Controller;

use App\Entity\Price;
use App\Form\PriceType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminPricesController extends AbstractController
{
    /**
     * @Route("/admin/prices/{id}/edit", name="admin_prices_edit")
     * @param Price $price
     * @param Request $request
     * @param ObjectManager $manager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function edit(Price $price, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(PriceType::class, $price);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($price);
            $manager->flush();

            $this->addFlash(
                'info',
                "The price has been created");


            return $this->redirectToRoute('home');
        }
        return $this->render('admin/prices/edit.html.twig',[
            'price'=>$price,
            'form'=> $form->createView()
        ]);
    }
}

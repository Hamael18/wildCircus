<?php

namespace App\Controller;

use App\Entity\AboutUs;
use App\Form\AboutUsType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminAboutController extends AbstractController
{
    /**
     * @Route("admin/aboutUs/{id<\d+>?1}", name="about_us")
     * @param AboutUs $aboutUs
     * @param ObjectManager $manager
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function edit(AboutUs $aboutUs, ObjectManager $manager, Request $request)
    {
        $form = $this->createForm(AboutUsType::class, $aboutUs);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($aboutUs);
            $manager->flush();

            $this->addFlash(
                'info',
                "You presentation message has been updated");


            return $this->redirectToRoute('home');
        }
        return $this->render('admin/about/edit.html.twig',[
            'aboutUs'=>$aboutUs,
            'form'=> $form->createView()
        ]);
    }
}

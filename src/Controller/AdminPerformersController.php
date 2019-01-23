<?php

namespace App\Controller;

use App\Entity\Performers;
use App\Form\PerformersType;
use App\Repository\PerformersRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminPerformersController extends AbstractController
{
    /**
     * @Route("admin/performers", name="admin_performers")
     * @param PerformersRepository $repo
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(PerformersRepository $repo)
    {
        return $this->render('admin/performers/index.html.twig', [
            'performers' => $repo->findAll(),
        ]);
    }
    /**
     * @Route("admin/performers/new", name="performers_create")
     * @param Request $request
     * @param ObjectManager $manager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     */
    public function create(Request $request, ObjectManager $manager)
    {
        $performer = new Performers();
        $form = $this->createForm(PerformersType::class, $performer);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager->persist($performer);
            $manager->flush();

            $this->addFlash(
                'info',
                "The performer has been created");


            return $this->redirectToRoute('home');
        }
        return $this->render('admin/performers/new.html.twig',[
            'form'=> $form->createView()
        ]);
    }

    /**
     * @Route("admin/performers/{id}/edit", name="performers_edit")
     * @param Performers $performers
     * @param Request $request
     * @param ObjectManager $manager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function edit(Performers $performer, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(PerformersType::class, $performer);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($performer);
            $manager->flush();

            $this->addFlash(
                'info',
                "The performer has been created");


            return $this->redirectToRoute('performers');
        }
        return $this->render('admin/performers/edit.html.twig',[
            'performer'=>$performer,
            'form'=> $form->createView()
        ]);
    }

    /**
     * @Route("admin/performers/{id}/delete", name="performers_delete")
     * @param Performers $performer
     * @param Request $request
     * @param ObjectManager $manager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Performers $performer, ObjectManager $manager)
    {
        $manager->remove($performer);
        $manager->flush();

        $this->addFlash(
            'info',
            "The performer has been deleted"
        );

        return $this->redirectToRoute("performers");
    }
}

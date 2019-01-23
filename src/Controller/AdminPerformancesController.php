<?php

namespace App\Controller;

use App\Entity\Performances;
use App\Form\PerformancesType;
use App\Repository\PerformancesRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminPerformancesController extends AbstractController
{
    /**
     * @Route("admin/performances", name="admin_performances")
     */
    public function index(PerformancesRepository $repo)
    {
        return $this->render('admin/performances/index.html.twig', [
            'performances' => $repo->findAll(),
        ]);
    }
    /**
     * @Route("admin/performances/new", name="performances_create")
     * @param Performances $performance
     * @param Request $request
     * @param ObjectManager $manager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request, ObjectManager $manager)
    {
        $performance = new Performances();
        $form = $this->createForm(PerformancesType::class, $performance);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            foreach ($performance->getPerformers() as $performer) {
                $performance->addPerformer($performer);
                $manager->persist($performer);
            }
            $manager->persist($performance);
            $manager->flush();

            $this->addFlash(
                'info',
                "The performance has been created");


            return $this->redirectToRoute('performances');
        }
        return $this->render('admin/performances/new.html.twig',[
            'performance'=>$performance,
            'form'=> $form->createView()
        ]);
    }
    /**
     * @Route("admin/performances/{id}/edit", name="performances_edit")
     * @param Performances $performance
     * @param Request $request
     * @param ObjectManager $manager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function edit(Performances $performance, Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(PerformancesType::class, $performance);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($performance);
            $manager->flush();

            $this->addFlash(
                'info',
                "The performer has been created");


            return $this->redirectToRoute('performances');
        }
        return $this->render('admin/performances/edit.html.twig',[
            'performance'=>$performance,
            'form'=> $form->createView()
        ]);
    }

    /**
     * @Route("admin/performances/{id}/delete", name="performances_delete")
     * @param Performances $performance
     * @param ObjectManager $manager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Performances $performance, ObjectManager $manager)
    {
        $manager->remove($performance);
        $manager->flush();

        $this->addFlash(
            'info',
            "The performance has been deleted"
        );

        return $this->redirectToRoute("performances");
    }

}

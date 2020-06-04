<?php

namespace App\Controller;

use App\Entity\Formule;
use App\Form\FormuleType;
use App\Repository\FormuleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/formule")
 */
class FormuleController extends AbstractController
{
    /**
     * @Route("/", name="formule_index", methods={"GET"})
     * @param FormuleRepository $formuleRepository
     * @return Response
     */
    public function index(FormuleRepository $formuleRepository): Response
    {
        return $this->render('formule/index.html.twig', [
            'formules' => $formuleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="formule_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $formule = new Formule();
        $formule->setLabel('formule 1');
        $form = $this->createForm(FormuleType::class, $formule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formule);
            $entityManager->flush();

            return $this->redirectToRoute('clothe_index');
        }

        return $this->render('formule/new.html.twig', [
            'formule' => $formule,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="formule_show", methods={"GET"})
     * @param Formule $formule
     * @return Response
     */
    public function show(Formule $formule): Response
    {
        return $this->render('formule/show.html.twig', [
            'formule' => $formule,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="formule_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Formule $formule
     * @return Response
     */
    public function edit(Request $request, Formule $formule): Response
    {
        $form = $this->createForm(FormuleType::class, $formule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('formule_index');
        }

        return $this->render('formule/edit.html.twig', [
            'formule' => $formule,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="formule_delete", methods={"DELETE"})
     * @param Request $request
     * @param Formule $formule
     * @return Response
     */
    public function delete(Request $request, Formule $formule): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formule->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($formule);
            $entityManager->flush();
        }

        return $this->redirectToRoute('formule_index');
    }
}

<?php

namespace App\Controller;

use App\Entity\Clothe;
use App\Form\ClotheType;
use App\Repository\ClotheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/clothe")
 */
class ClotheController extends AbstractController
{
    /**
     * @Route("/", name="clothe_index", methods={"GET"})
     */
    public function index(ClotheRepository $clotheRepository): Response
    {
        return $this->render('clothe/index.html.twig', [
            'clothes' => $clotheRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="clothe_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $clothe = new Clothe();
        $form = $this->createForm(ClotheType::class, $clothe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($clothe);
            $entityManager->flush();

            return $this->redirectToRoute('clothe_index');
        }

        return $this->render('clothe/new.html.twig', [
            'clothe' => $clothe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="clothe_show", methods={"GET"})
     */
    public function show(Clothe $clothe): Response
    {
        return $this->render('clothe/show.html.twig', [
            'clothe' => $clothe,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="clothe_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Clothe $clothe): Response
    {
        $form = $this->createForm(ClotheType::class, $clothe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('clothe_index');
        }

        return $this->render('clothe/edit.html.twig', [
            'clothe' => $clothe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="clothe_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Clothe $clothe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$clothe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($clothe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('clothe_index');
    }
}

<?php

namespace App\Controller;

use App\Entity\Clothe;
use App\Entity\Order;
use App\Entity\OrderHasClothe;
use App\Form\OrderHasClotheType;
use App\Repository\OrderHasClotheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/order/has/clothe")
 */
class OrderHasClotheController extends AbstractController
{
    /**
     * @Route("/", name="order_has_clothe_index", methods={"GET"})
     * @param OrderHasClotheRepository $orderHasClotheRepository
     * @return Response
     */
    public function index(OrderHasClotheRepository $orderHasClotheRepository): Response
    {
        return $this->render('order_has_clothe/index.html.twig', [
            'order_has_clothes' => $orderHasClotheRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="order_has_clothe_new", methods={"GET","POST"})
     * @param Request $request
     * @param Order $order
     * @return Response
     */
    public function new(Request $request, Order $order): Response
    {

        $orderHasClothe = new OrderHasClothe();
        $orderHasClothe->setOrder($order);
        $form = $this->createForm(OrderHasClotheType::class, $orderHasClothe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($orderHasClothe);
            $entityManager->flush();

        }

        return $this->render('order_has_clothe/new.html.twig', [
            'order_has_clothe' => $orderHasClothe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="order_has_clothe_show", methods={"GET"})
     * @param OrderHasClothe $orderHasClothe
     * @return Response
     */
    public function show(OrderHasClothe $orderHasClothe): Response
    {
        return $this->render('order_has_clothe/show.html.twig', [
            'order_has_clothe' => $orderHasClothe,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="order_has_clothe_edit", methods={"GET","POST"})
     * @param Request $request
     * @param OrderHasClothe $orderHasClothe
     * @return Response
     */
    public function edit(Request $request, OrderHasClothe $orderHasClothe): Response
    {
        $form = $this->createForm(OrderHasClotheType::class, $orderHasClothe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('order_has_clothe_index');
        }

        return $this->render('order_has_clothe/edit.html.twig', [
            'order_has_clothe' => $orderHasClothe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="order_has_clothe_delete", methods={"DELETE"})
     * @param Request $request
     * @param OrderHasClothe $orderHasClothe
     * @return Response
     */
    public function delete(Request $request, OrderHasClothe $orderHasClothe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$orderHasClothe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($orderHasClothe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('order_has_clothe_index');
    }

}

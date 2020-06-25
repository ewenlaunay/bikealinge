<?php

namespace App\Controller;

use App\Entity\MeanOfPaiement;
use App\Form\MeanOfPaiementType;
use App\Repository\MeanOfPaiementRepository;
use Stripe\Charge;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mean/of/paiement")
 */
class MeanOfPaiementController extends AbstractController
{
    /**
     * @Route("/", name="mean_of_paiement_index", methods={"GET"})
     * @param MeanOfPaiementRepository $meanOfPaiementRepository
     * @return Response
     */
    public function index(MeanOfPaiementRepository $meanOfPaiementRepository): Response
    {
        return $this->render('mean_of_paiement/index.html.twig', [
            'mean_of_paiements' => $meanOfPaiementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="mean_of_paiement_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $meanOfPaiement = new MeanOfPaiement();
        $form = $this->createForm(MeanOfPaiementType::class, $meanOfPaiement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($meanOfPaiement);
            $entityManager->flush();

            return $this->redirectToRoute('mean_of_paiement_index');
        }

        return $this->render('mean_of_paiement/new.html.twig', [
            'mean_of_paiement' => $meanOfPaiement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mean_of_paiement_show", methods={"GET"})
     * @param MeanOfPaiement $meanOfPaiement
     * @return Response
     */
    public function show(MeanOfPaiement $meanOfPaiement): Response
    {
        return $this->render('mean_of_paiement/show.html.twig', [
            'mean_of_paiement' => $meanOfPaiement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="mean_of_paiement_edit", methods={"GET","POST"})
     * @param Request $request
     * @param MeanOfPaiement $meanOfPaiement
     * @return Response
     */
    public function edit(Request $request, MeanOfPaiement $meanOfPaiement): Response
    {
        $form = $this->createForm(MeanOfPaiementType::class, $meanOfPaiement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mean_of_paiement_index');
        }

        return $this->render('mean_of_paiement/edit.html.twig', [
            'mean_of_paiement' => $meanOfPaiement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mean_of_paiement_delete", methods={"DELETE"})
     * @param Request $request
     * @param MeanOfPaiement $meanOfPaiement
     * @return Response
     */
    public function delete(Request $request, MeanOfPaiement $meanOfPaiement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$meanOfPaiement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($meanOfPaiement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mean_of_paiement_index');
    }

    public function indexAction(Request $request){
        Stripe::setApiKey('sk_test_BQokikJOvBiI2HlWgH4olfQ2');

        $charge = Charge::create(

            array(
                'amount' => 2000,
                'currency' => 'eur',
                'source' => $request->request->get('StripeToken')
));
    }
}

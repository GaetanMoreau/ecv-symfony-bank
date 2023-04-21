<?php

namespace App\Controller;

use App\Entity\Recharge;
use App\Form\RechargeType;
use App\Repository\RechargeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RechargeController extends AbstractController
{
    #[Route('/recharge', name: 'app_recharge')]
    public function index(RechargeRepository $rr): Response
    {
        $user = $this->getUser();
        $recharges = $rr->findAll();

        $rechargesByAccount = [];
        foreach ($recharges as $recharge) {
            if ($recharge->getCompte()->getProprietaire() === $user) {
                $rechargesByAccount[$recharge->getCompte()->getId()][] = $recharge;
            }
        }

        return $this->render('recharge/index.html.twig', [
            'recharges' => $rechargesByAccount,
        ]);
    }
    #[Route('/recharge/add', name: 'app_recharge_add')]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $recharge = new Recharge();
        $recharge->setRechargeDate(new \DateTime('now'));
        $form = $this->createForm(RechargeType::class, $recharge);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recharge = $form->getData();

            $compte = $recharge->getCompte();
            $montant = $recharge->getMontant();

            $compte->setSolde($compte->getSolde() + $montant);

            $em->persist($recharge);
            $em->flush();
            return $this->redirectToRoute('app_account');
        }

        return $this->render('recharge/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

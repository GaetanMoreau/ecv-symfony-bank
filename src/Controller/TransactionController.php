<?php

namespace App\Controller;

use App\Entity\Transaction;
use App\Repository\AccountRepository;
use App\Repository\TransactionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\TransactionType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class TransactionController extends AbstractController
{
    #[Route('/transaction', name: 'app_transaction')]
    public function index(TransactionRepository $tr): Response
    {
        $user = $this->getUser();
        $transactions = $tr->findAll();

        $transactionsByAccount = [];
        foreach ($transactions as $transaction) {
            if ($transaction->getCompteOrigine()->getProprietaire() === $user) {
                $transactionsByAccount[$transaction->getCompteOrigine()->getId()][] = $transaction;
            }
        }


        return $this->render('transaction/index.html.twig', [
            'transactions' => $transactionsByAccount,
        ]);
    }
    #[Route('/transaction/add', name: 'app_transaction_add')]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $transaction = new Transaction();
        $transaction->setTransactionDate(new \DateTime('now'));
        $form = $this->createForm(TransactionType::class, $transaction);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $transaction = $form->getData();

            $compteOrigine = $transaction->getCompteOrigine();
            $compteDestination = $transaction->getCompteDestination();
            $montant = $transaction->getMontant();

            $compteOrigine->setSolde($compteOrigine->getSolde() - $montant);
            $compteDestination->setSolde($compteDestination->getSolde() + $montant);

            $em->persist($transaction);
            $em->flush();
            return $this->redirectToRoute('app_account');
        }

        return $this->render('transaction/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

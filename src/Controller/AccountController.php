<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AccountRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Account;
use App\Form\AccountType;

class AccountController extends AbstractController
{
    #[Route('/account', name: 'app_account')]
    public function index(AccountRepository $ar): Response
    {
        return $this->render('account/index.html.twig', [
            'accounts' => $ar->findBy(['proprietaire' => $this->getUser()])
        ]);
    }
    #[Route('/account/add', name: 'app_account_add')]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $account = new Account();
        $account->setSolde(0);
        $account->setStatus(true);
        $account->setProprietaire($this->getUser());
        $form = $this->createForm(AccountType::class, $account);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $account = $form->getData();
            $em->persist($account);
            $em->flush();
            return $this->redirectToRoute('app_account');
        }

        return $this->render('account/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

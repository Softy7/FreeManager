<?php

namespace App\Controller;

use App\Repository\ClientRepository;
use App\Repository\QuoteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DashboardController extends AbstractController
{
    #[Route('', name: 'app_dashboard')]
    public function index(ClientRepository $clientRepository, QuoteRepository $quoteRepository): Response
    {
        $countClient = $clientRepository->count([]);
        $waitingQuote = count($quoteRepository->findBy(['status' => 1], ['id' => "DESC"]));
        $CATotal = $quoteRepository->findCATotal();
        $acceptedQuote = $quoteRepository->findAcceptedQuote();

        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            'count_client' => $countClient,
            'waiting_quote' => $waitingQuote,
            'ca_total' => $CATotal,
            'accepted_quote' => ($acceptedQuote) 
        ]);
    }
}

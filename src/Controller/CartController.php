<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        $panier = $session->get('panier', []);
        $panierData = [];
        foreach ($panier as $id => $quantity) {
            $panierData[] = [
                'id' => $id,
                'quantity' => $quantity
            ];
        }
        return $this->render('cart/index.html.twig', ['items' => $panierData]);
    }
    public function add($id, Request $request)
    {
        $session = $request->getSession();
        $panier = $session->get('panier', []);
        if (!empty($panier[$id]))
            $panier[$id]++;
        else
            $panier[$id] = 1;

        $session->set('panier', $panier);
        return $this->redirectToRoute('cart');
    }
    
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ProduitRepository;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(Request $request,ProduitRepository $produitRepository): Response
    {
        $session = $request->getSession();
        $panier = $session->get('panier', []);
        $panierData = [];
        $total = 0;

        foreach ($panier as $id => $quantity) {
            $product = $produitRepository->find($id);
            $price = $product->getPrice();
            $total += $price * $quantity;
            if ($product) {
                $panierData[] = [
                    'id' => $product->getId(),
                    'name' => $product->getName(),
                    'price' => $price,
                    'quantity' => $quantity,
                   
                ];
                
            }
        }
    
        return $this->render('cart/index.html.twig', [
            'items' => $panierData,
            'total' => $total, 
        ]);
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
    public function remove($id, Request $request)
    {
        $session = $request->getSession();
        $panier = $session->get('panier', []);
        if (!empty($panier[$id]))
            $panier[$id]--;
        if ($panier[$id] <= 0)
            unset($panier[$id]);
        
        $session->set('panier', $panier);
        return $this->redirectToRoute('cart');
    }

    
}

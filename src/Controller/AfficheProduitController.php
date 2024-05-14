<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Produit;
use Doctrine\Persistence\ManagerRegistry;

class AfficheProduitController extends AbstractController
{
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
    #[Route('/affiche/produit', name: 'app_affiche_produit')]
public function index(): Response
{
$articles = $this->doctrine->getRepository(Produit::class)->findBy([/*'id'=>'1'*/]);
return $this->render('affiche_produit/index.html.twig', ['articles' => $articles,]);
}
}


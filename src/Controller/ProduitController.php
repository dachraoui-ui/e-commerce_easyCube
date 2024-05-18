<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;
use App\Form\ProduitType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;

class ProduitController extends AbstractController
{
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    #[Route('/produit', name: 'app_produit')]
    public function index(): Response
    {
        $products = $this->doctrine->getRepository(Produit::class)->findAll();

        return $this->render('produit/index.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/produit/add', name: 'app_produit_add')]
    public function add(Request $request): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $photo_prod = $form->get('photo')->getData();
            $originalFilename = pathinfo($photo_prod->getClientOriginalName(), PATHINFO_FILENAME);
            $newFilename = $originalFilename . '-' . uniqid() . '.' . $photo_prod->guessExtension();
            $photo_prod->move($this->getParameter('images_directory'), $newFilename);
            $produit->setPhoto($newFilename);

            $entityManager = $this->doctrine->getManager();
            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('app_produit');
        }

        return $this->render('produit/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/produit/edit/{id}', name: 'app_produit_edit')]
    public function edit(int $id, Request $request): Response
    {
        $produit = $this->doctrine->getRepository(Produit::class)->find($id);
        if (!$produit) {
            throw $this->createNotFoundException('No product found for id '.$id);
        }

        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $photo_prod = $form->get('photo')->getData();
            if ($photo_prod) {
                $originalFilename = pathinfo($photo_prod->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename . '-' . uniqid() . '.' . $photo_prod->guessExtension();
                $photo_prod->move($this->getParameter('images_directory'), $newFilename);
                $produit->setPhoto($newFilename);
            }

            $this->doctrine->getManager()->flush();

            return $this->redirectToRoute('app_produit');
        }

        return $this->render('produit/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/produit/delete/{id}', name: 'app_produit_delete')]
    public function delete(int $id): Response
    {
        $produit = $this->doctrine->getRepository(Produit::class)->find($id);
        if ($produit) {
            $entityManager = $this->doctrine->getManager();
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_produit');
    }
}

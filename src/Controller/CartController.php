<?php

namespace App\Controller;

use App\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CartController extends AbstractController
{
    #[Route('/produit/add/{id}', name: 'add_to_cart')]
public function add($id, Request $request)
{
    // Récupérer l'article à partir de son ID
    $produit = $this->getDoctrine()
        ->getRepository(Produit::class)
        ->find($id);

    // Vérifier si l'article existe
    if (!$produit) {
        throw $this->createNotFoundException('Ce produit n\'existe pas.');
    }

    // Récupérer la quantité à partir des données de formulaire
    $quantite = $request->request->get('quantity', 1);

    // Ajouter l'article au panier ou mettre à jour la quantité si l'article est déjà présent
    $cart = $this->get('session')->get('cart', []);
    if (array_key_exists($id, $cart)) {
        $cart[$id]['quantite'] += $quantite;
    } else {
        $cart[$id] = [
            'id' => $produit->getId(),
            'nom_produit' => $produit->getNomProduit(),
            'prix_produit' => $produit->getPrixProduit(),
            'marque_produit' => $produit->getMarqueProduit(),
            'quantite' => $quantite
        ];
    }
    $this->get('session')->set('cart', $cart);

    // Rediriger l'utilisateur vers la page du panier
    return $this->redirectToRoute('cart');
}

    #[Route('/panier', name: 'cart')]
    public function cart()
    {
        // Récupérer le contenu du panier depuis la session
        $cart = $this->get('session')->get('cart', []);

        // Afficher le contenu du panier
        return $this->render('cart/index.html.twig', [
            'cart' => $cart
        ]);
    }







    

    #[Route('/produit/remove/{id}', name: 'remove_from_cart')]
public function remove($id)
{
    // Récupérer le panier depuis la session
    $cart = $this->get('session')->get('cart', []);

    // Vérifier si le produit est présent dans le panier
    if (array_key_exists($id, $cart)) {
        // Supprimer le produit du panier
        unset($cart[$id]);
        $this->get('session')->set('cart', $cart);
    }

    // Rediriger l'utilisateur vers la page du panier
    return $this->redirectToRoute('cart');
}
}
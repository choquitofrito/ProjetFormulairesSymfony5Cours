<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormulairesController extends AbstractController
{
    /**
     * @Route("/formulaires/afficher/formulaire")
     */
    public function afficherFormulaire()
    {
        return $this->render('formulaires/afficher_formulaire.html.twig');
    }

    /**
     * @Route("/formulaires/traitement/formulaire", name="traitement_formulaire")
     */
    public function traitementFormulaire(Request $req)
    {
        //dd ($req);  
        //dd ($req->request)
        // à choisir!!

        // on obtient les données du formulaire
        $nom = $req->request->get('nom'); // $nom = $_POST['nom'] 
        $age = $req->request->get('age');

        // s'il s'agit d'un GET: 
        // $nom = $req->query->get('nom');  // $nom = $_GET['nom']

        return $this->render(
            'formulaires/traitement_formulaire.html.twig',
            [
                'nom' => $nom,
                'age' => $age
            ]
        );
    }
}

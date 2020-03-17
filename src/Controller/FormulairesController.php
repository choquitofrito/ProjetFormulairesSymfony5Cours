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
        
        //dd($req);
        //dd ($req->request->get('nom'));
        dd ($req->query->get('nom'));

        return $this->render('formulaires/traitement_formulaire.html.twig');
    }
}

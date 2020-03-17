<?php

namespace App\Controller;

use App\Entity\Aeroport;
use App\Form\AeroportType;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
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

    /**
     * @Route ("/formulaires/afficher/formulaire/aeroport")
     */
    public function afficherFormulaireAeroport()
    {
        // créer le formulaire        
        $formAeroport = $this->createForm(
            AeroportType::class,
            null,
            [
                'method' => 'POST',
                'action' => $this->generateUrl("traitement_formulaire_aeroport")

            ]
        );
        return $this->render(
            '/formulaires/afficher_formulaire_aeroport.html.twig',
            ['leFormulaire' => $formAeroport->createView()]
        );
    }

    /**
     * @Route ("/formulaires/traitement/formulaire/aeroport", name="traitement_formulaire_aeroport")
     */
    public function traitementFormulaireAeroport(){

        return new Response ("traitement");
    }


    /**
     * @Route ("/formulaires/aeroport/afficher/traiter", name="aeroport_afficher_traiter")
     */
    public function aeroportAfficherTraiter (Request $request){

        // 1. Créer et afficher le formulaire
        // créer le formulaire    
        $aeroport = new Aeroport();
        //$aeroport->setNom ("SVQ");
        //$aeroport->setCode ("435345345");
        
        $formAeroport = $this->createForm(
            AeroportType::class,
            $aeroport,
            [
                'method' => 'POST',
                'action' => $this->generateUrl("aeroport_afficher_traiter")

            ]
        );
        $formAeroport->handleRequest($request);

        // si submit on doit traiter le formulaire
        if ($formAeroport->isSubmitted() && $formAeroport->isValid()){
            dd ($request->request);
        }


        return $this->render(
            '/formulaires/aeroport_afficher_formulaire.html.twig',
            ['leFormulaire' => $formAeroport->createView()]
        );


        // 2. Traiter le formulaire

    }




    
}

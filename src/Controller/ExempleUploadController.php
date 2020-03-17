<?php

namespace App\Controller;

use App\Entity\Pays;
use App\Form\PaysType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExempleUploadController extends AbstractController
{
    /**
     * @Route("/exemple/upload/exemple", name="exemple_upload")
     */
    public function exemple(Request $request)
    {
        $pays = new Pays();

        $formulairePays = $this->createForm(
            PaysType::class,
            $pays,
            [
                'method' => 'POST',
                'action' => $this->generateUrl("exemple_upload")
            ]
        );

        $formulairePays->handleRequest($request);
        
        if ($formulairePays->isSubmitted() && $formulairePays->isValid()){
        

            dump ($pays);
        $pays = $formulairePays->getData();
        dump ($pays);
        die();
        
            // manque getData???

            // traiter le formulaire

            // obtenir le fichier (objet)
            $fichier = $pays->getLien();

            // générer un nom unique de fichier
            // ex: 4342KL345K.txt
            $nomFichierServeur = md5(uniqid()) . "." . $fichier->guessExtension();
            $fichier->move ('dossierFichiers', $nomFichierServeur);
            
            // stocker dans la BD
            $em = $this->getDoctrine()->getManager();
            $pays->setLien ($nomFichierServeur);
            $em->persist($pays);
            $em->flush();

            return new Response ("Fichier enregistré");
            


        }
        else {
            // afficher le formulaire
            return $this->render('exemple_upload/exemple.html.twig', ['formulaire'=>$formulairePays->createView()]);
        }


        
    }
}

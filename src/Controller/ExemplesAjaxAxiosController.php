<?php

namespace App\Controller;

use App\Entity\Aeroport;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExemplesAjaxAxiosController extends AbstractController
{
    /**
     * @Route("/exemples/ajax/axios/exemple1/affichage")
     */
    public function exemple1Affichage()
    {
        return $this->render('exemples_ajax_axios/exemple1_affichage.html.twig');
    }

    /**
     * @Route("/exemples/ajax/axios/exemple1/traiment", name = "exemple1_traitement")
     */
    public function exemple1Traitement (Request $request){
        $nom = $request->get ("nom");
        // $_POST['nom']
        return new JsonResponse(['nom'=> $nom]);
    }

    // afficher tous les aeroports


    // action pour afficher une vue. 

    /**
     * @Route("/exemples/ajax/axios/exemple/affichage/objets")
     */
    public function exempleAffichageObjets (){
        return $this->render ('/exemples_ajax_axios/exemple_affichage_objets.html.twig');
    }

    // 1. action de traitement du AJAX, on utilise les méthodes du repository (findBy, findAll, etc...)
    // nous devons serialiser (transformer en json dans ce cas) le résultat et envoyer une Reponse normale

    /**
     * @Route("/exemples/ajax/axios/exemple/affichage/objets/traitement", name="exemple_objets_traitement")
     */
    public function exempleAffichageObjetsTraitement (Request $req){
       
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Aeroport::class);
        $code = $req->get ('code');
        $aeroports = $rep->findBy(['code'=> $code]); // renvoie un array même s'il y a un seul objet
        // Si on utilise les méthodes de base du Repository (find, findBy, findAll...)
        // nous devons serializer à la main en utilisant la méthode "serialize", puis 
        // envoyer une réponse normale. En DQL on peut utiliser getArrayResult, mais pas ici  
        $aeroports = $this->get('serializer')->serialize($aeroports, 'json');
        return new Response ($aeroports);
    }


    // 2. action de traitement du AJAX, on utilise DQL
    // La méthode getArrayResult fera le travail pour nous

    // /**
    //  * @Route("/exemples/ajax/axios/exemple/affichage/objets/traitement", name="exemple_objets_traitement")
    //  */
    // public function exempleAffichageObjetsTraitement (Request $req){
       
    //     $em = $this->getDoctrine()->getManager();
    //     $query = $em->createQuery ("SELECT aeroport FROM App\Entity\Aeroport aeroport WHERE aeroport.code LIKE :code");
    //     $code = $req->get ('code');
    //     $query->setParameter ("code",'%'.$code.'%');
    //     $aeroports = $query->getArrayResult();
    //     return new JsonResponse ($aeroports);
    
    //     // SELECT aeroport FROM App\Entity\Aeroport aeroport WHERE aeroport.code = 'CLR'
    //     // SELECT aeroport FROM App\Entity\Aeroport aeroport WHERE aeroport.code LIKE 'CLR%'
    //     // SELECT aeroport FROM App\Entity\Aeroport aeroport WHERE aeroport.code LIKE '%CLR%'
    //     // SELECT aeroport FROM App\Entity\Aeroport aeroport WHERE aeroport.code LIKE :code
    //     // SELECT aeroport FROM App\Entity\Aeroport aeroport WHERE aeroport.code LIKE %:code% // non!!!
    //     // SELECT aeroport FROM App\Entity\Aeroport aeroport WHERE aeroport.code LIKE %'CLR'% // non!!! le % ne vas pas avant les ""
    //     // SELECT aeroport FROM App\Entity\Aeroport aeroport WHERE aeroport.code LIKE '%CLR%' // non!!!
        
    // }






}

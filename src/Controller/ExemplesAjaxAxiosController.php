<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ExemplesAjaxAxiosController extends AbstractController
{
    /**
     * @Route("/exemples/ajax/axios/exemple1/affichage")
     */
    public function exemple1Affichage()
    {
        return $this->render('exemples_ajax_axios/exemple1_affichage.html.twig');
    }
}

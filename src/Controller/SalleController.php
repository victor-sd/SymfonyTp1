<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class SalleController extends AbstractController{
 public function accueil() {

    $nombre = rand(1,84);
    return $this->render('salle/accueil.html.twig',
        array('numero' => $nombre)); // ou ['numero'=>$nombre]);
 //return new Response("ici l'accueil !");
 /*return new Response("<html><body><h1>Salles :</h1> <p>Voici quelques
informations concernant les salles<br \>blablabla blablabla blablabla blablabla
blablabla blablabla blablabla blablabla ....</p></body></html>"); */
}

public function afficher($numero) {
    return $this->render('salle/afficher.html.twig',
    array( 'numero' => $numero ));
    }
}

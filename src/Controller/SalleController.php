<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Salle;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class SalleController extends AbstractController{
public function accueil() {
    $nombre = rand(1,84);
    return $this->render('salle/accueil.html.twig',
    array('numero' => $nombre)); // ou ['numero'=>$nombre]);
}

public function afficher($numero) {
    if ($numero > 50)
    throw $this->createNotFoundException('C\'est trop !');
    else
    return $this->render('salle/afficher.html.twig',
    array('numero' => $numero)); 
    }

public function dix() {
    return $this->redirectToRoute('salle_tp_afficher', array('numero' => 10));
} 

public function testXml(Request $request) {
    $remoteAddr = $request->server->get('REMOTE_ADDR');
    $rep = new Response;
    $rep->setContent('<?xml version="1.0" encoding="UTF-8"?><remoteAddr>'
    .$remoteAddr.'</remoteAddr>');
    $rep->headers->set('Content-Type', 'text/xml');
    return $rep;
    }

public function testJson(Request $request) {
    $remoteAddr = $request->server->get('REMOTE_ADDR'); 
    $data = array('remoteAddr' => $remoteAddr);
    return new JsonResponse($data);
} 

public function treize() {
    $salle = new Salle;
    $salle->setBatiment('D');
    $salle->setEtage(1);
    $salle->setNumero(13);
    return $this->render('salle/treize.html.twig',
    array('salle' => $salle));
    }

public function quatorze() {
    $salle = new Salle;
    $salle->setBatiment('D');
    $salle->setEtage(1);
    $salle->setNumero(13);
    return $this->render('salle/quatorze.html.twig',
    array('designation' => $salle->__toString()));
    //ou seulement $salle
}

public function voir($id) {
    $salle = $this->getDoctrine()->getRepository(Salle::class)->find($id);
    if(!$salle)
    throw $this->createNotFoundException('Salle[id='.$id.'] inexistante');
    return $this->render('salle/voir.html.twig', 
    array('salle' => $salle));
}

public function ajouter2(Request $request) {
    $salle = new Salle;
    $form = $this->createFormBuilder($salle)
        ->add('batiment', TextType::class)
        ->add('etage', IntegerType::class)
        ->add('numero', IntegerType::class)
        ->add('envoyer', SubmitType::class)
        ->getForm();
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($salle);
        $entityManager->flush();
        return $this->redirectToRoute('salle_tp_voir',
            array('id' => $salle->getId()));
    }
    return $this->render('salle/ajouter2.html.twig',
        array('monFormulaire' => $form->createView()));
}
   
}

<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Topics;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Entity\Subtopics;



class MainController extends Controller
{
    /**
     * @Route("/main", name="main")
     */
    public function index()
    {

      $userSession = $this->get('session');


       $entityManager = $this->getDoctrine()->getEntityManager();

       $query = $entityManager->createQuery(
         'SELECT p
         FROM App\Entity\Subtopics p
         ORDER BY p.date_creation DESC  '
     )->setMaxResults(17);

      $objects= $query->execute();

        $topics = $this->getDoctrine()->getRepository(Topics::class)->findAll();

        if (!$topics) {
          throw $this->createNotFoundException(
        'No product found for id '
        );
      }





        return $this->render('main/main.html.twig',array("topics"=>$topics,'lastSubtopics'=>$objects) );
    }
}

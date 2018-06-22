<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Topics;
use App\Entity\Subtopics;



class ForumController extends Controller
{
    /**
     * @Route("/forum", name="ForumPageAll")
     */

     public function showAll($page)
     {

         $subtopicsRep = $this->getDoctrine()->getRepository(Subtopics::class)->findBy(array(), ['date_creation' => 'DESC']);

         $subtopics = array();
         $count=0;
         foreach ($subtopicsRep as $sub) {

           $count++;

           if(10*$page>$count && (10*$page-10)<$count)
           {
           $subtopics[]= array(
           "id"=>$sub->getId(),
           "name"=>$sub->getName(),
           "date"=>Tools::getStringDate($sub->getDateCreation()),
           "visits"=>$sub->getVisits(),
           "answers"=>$sub->getAnswers());
           }

         }
         $count= ceil($count/10);

             return $this->render('forum/forum.html.twig',array("subtopics"=> $subtopics,"topic"=>null,"count"=>$count,"page"=>$page));
     }

    /**
    * @Route("/forum/{$topic}", name="ForumPage")
    */

    public function show($topicSelected, $page)
    {

      $topic = $this->getDoctrine()->getRepository(Topics::class)->find($topicSelected);

      $subtopicsRep = $this->getDoctrine()->getRepository(Subtopics::class)->findBy(['topics_id_topic'=>$topic],['date_creation' => 'DESC']);


      $subtopics = array();
      $count=0;
      foreach ($subtopicsRep as $sub) {

        $count++;

        if(10*$page>$count && (10*$page-10)<$count)
        {
        $subtopics[]= array(
        "id"=>$sub->getId(),
        "name"=>$sub->getName(),
        "date"=>Tools::getStringDate($sub->getDateCreation()),
        "visits"=>$sub->getVisits(),
        "answers"=>$sub->getAnswers());
        }

      }
      $count= ceil($count/10);



        return $this->render('forum/forum.html.twig',array("subtopics"=> $subtopics,"topic"=>$topic,"count"=>$count,"page"=>$page));
    }





}

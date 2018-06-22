<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Topics;
use App\Entity\Subtopics;
use App\Entity\Answers;

class CreatorController extends Controller
{
    /**
     * @Route("/createAnswer/{subTopic}", name="creator")
     */
    public function answer($subTopic)
    {

      $session=$this->get("session");
      if($session->get("isLogin")==false)
      {
        return $this->redirect("/login");
      }

      if( isset($_POST['text-field']))
      {
        $textSubtopic=$_POST['text-field'];

        $entityManager=$this->getDoctrine()->getManager();
        $DateTime= new \DateTime();

        $newAnswer= new Answers();
        $newAnswer->setDateCreation($DateTime);
        $newAnswer->setText($textSubtopic);
        $newAnswer->setSubtopicsIdSubpost($subTopic);
        $newAnswer->setUsersId($session->get("id"));

        $entityManager->persist($newAnswer);
        $entityManager->flush();
        $CountOfAnswers=count($this->getDoctrine()->getRepository(Answers::class)->findBy(["subtopics_id_subpost"=>$subTopic]));
        $object= $this->getDoctrine()->getRepository(Subtopics::class)->find($subTopic);
        $object->setAnswers($CountOfAnswers);

        $entityManager->flush();

          return $this->redirect("/subforum/".$subTopic);
      }
      else
      {
        $object=$this->getDoctrine()->getRepository(Subtopics::class)->find($subTopic);
        $subtopicName= $object->getName();

      }


        return $this->render('extends/create-answer.html.twig',array("subtopicName"=>$subtopicName,"subtopicId"=>$subTopic));
    }

// createSubForum
    public function subforum($topic)
    {

      $session=$this->get("session");
      if($session->get("isLogin")==false)
      {
        return $this->redirect("/login");
      }



      if(isset($_POST['name-field']) && isset($_POST['text-field']))
      {
          $nameSubtopic=$_POST['name-field'];
          $textSubtopic=$_POST['text-field'];

          $entityManager=$this->getDoctrine()->getManager();
          $DateTime= new \DateTime();

          $newSubtopic= new Subtopics();
          $newSubtopic->setName($nameSubtopic);
          $newSubtopic->setDateCreation($DateTime);
          $newSubtopic->setVisits(0);
          $newSubtopic->setAnswers(1);
          $newSubtopic->setUsersId($session->get("id"));
          $newSubtopic->setTopicsIdTopic($topic);

          $entityManager->persist($newSubtopic);
          $entityManager->flush();

          $object=$this->getDoctrine()->getRepository(Subtopics::class)->findBy(
            ["users_id"=>$session->get("id")],
            ['date_creation'=>"DESC"]
          );


          $newAnswer= new Answers();
          $newAnswer->setDateCreation($DateTime);
          $newAnswer->setText($textSubtopic);
          $newAnswer->setSubtopicsIdSubpost($object[0]->getId());
          $newAnswer->setUsersId($session->get("id"));


          $entityManager->persist($newAnswer);
          $entityManager->flush();


          return $this->redirect("/subforum/".$object[0]->getId());
      }
      else
      {
        $object=$this->getDoctrine()->getRepository(Topics::class)->find($topic);
        $topicName= $object->getName();

      }


        return $this->render('extends/create-subtopic.html.twig',array("topicId"=>$topic,"topicName"=>$topicName));
    }
}

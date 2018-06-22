<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Answers;
use App\Entity\Subtopics;
use App\Entity\Users;

class AnswersController extends Controller
{
    /**
     * @Route("/subforum", name="subforum")
     */
    public function show($subforum)
    {




      $answersRep = $this->getDoctrine()->getRepository(Answers::class)->findBy(['subtopics_id_subpost'=>$subforum]);
      $subTopicObject = $this->getDoctrine()->getRepository(Subtopics::class)->find($subforum);

      if($subTopicObject !=null)
      {
        $entityManager=$this->getDoctrine()->getManager();

        $subTopicObject->setVisits($subTopicObject->getVisits()+1);
        $entityManager->flush();
      $answersTab = array();
      $count=0;
      $subtopic=  $subTopicObject->getName();
        foreach ($answersRep as $answer) {

          $count++;


          $userObject= $this->getDoctrine()->getRepository(Users::class)->find($answer->getUsersId());


          $answersTab[]= array(
          "id-answer"=>$answer->getId(),
          "user-nick"=>$userObject->getNick(),
          "sup-topic-name"=>$subTopicObject->getName(),
          "answer-date"=> Tools::getStringDate($answer->getDateCreation()),
          "text"=>$answer->getText()
        );

        }

        return $this->render('answers/answers.html.twig', array("answers"=>$answersTab,"count"=>$count,"subtopic"=>$subtopic,"subtopicId"=>  $subTopicObject->getId() ));

      }
      else
      {
          return $this->redirect("/main");
      }






      }
}

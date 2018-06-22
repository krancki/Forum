<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Serializer;
use App\Entity\Users;
use App\Entity\SessionTab;
use Symfony\Component\HttpFoundation\Session\Session;

class Tools extends Controller
  {




    public static function getStringDate($date)
    {
      $serializer = new Serializer(array(new DateTimeNormalizer("d M Y H:i:s ")));
      $dateAsString = $serializer->normalize($date);
      return $dateAsString;
    }


    public static function isCorect($user,$userDoctrine,$error)
    {



      if( $userDoctrine->findBy(["nick"=>$user->getNick()])!=null )
      {
        $error["NickError"]= true;
        $error['isError']=true;
      }
      if( $userDoctrine->findBy(["email"=>$user->getEmail()])!=null  )
      {
        $error["EmailError"]= true ;
        $error['isError']=true;
      }
      if($error["NameError"]==true)
      {

        $error['isError']=true;
      }
      if($error["SecoundnameError"]==true)
      {

        $error['isError']=true;
      }
      if($error["PasswordError"]==true)
      {

        $error['isError']=true;
      }

      return $error;
    }


    public static function setSession($user,$controller)
    {
          $session = new Session();


        $SessionRep = $controller->getDoctrine()->getRepository(SessionTab::class);         //Connection to database
        $entityManager = $controller->getDoctrine()->getManager();

        $UserSession= $SessionRep->findBy(["users_id"=>$user->getId()]);

        if($UserSession==null)
        {         //new Session Entity
           $UserNewSession= new SessionTab();

           $UserNewSession->setUsersId($user->getId());        //Create new Session in database
           $UserNewSession->setLastactivity(new \datetime);
           $UserNewSession->setIslogin(true);

           $entityManager->persist($UserNewSession);   //Send to database
           $entityManager->flush();

        }
        else
        {       //Update Session in database
          $UserUpdateSession= $entityManager->getRepository(SessionTab::class)->find($UserSession[0]->getId());
          $UserUpdateSession->setLastactivity(new \datetime);
          $UserUpdateSession->setIslogin(true);
          $entityManager->flush();
        }

        $UserSession= $SessionRep->findBy(["users_id"=>$user->getId()]); //ReFind session key
        $session->set("id",$user->getId());
        $session->set("nick",$user->getNick());
        $session->set("name",$user->getName());
        $session->set("secoundname",$user->getSecoundname());
        $session->set("address",$user->getAddress());
        $session->set("email",$user->getEmail());
        $session->set("lastActivity",$UserSession[0]->getLastactivity());
        $session->set("isLogin",$UserSession[0]->getIslogin());
        $session->set("sessionId",$UserSession[0]->getId());

    }

    public static function logout($entityManager)
    {
        $session=new Session();
        $UserSession= $entityManager->getRepository(SessionTab::class)->find($session->get("sessionId"));

        $UserSession->setLastactivity(new \datetime);
        $UserSession->setIslogin(false);

        $entityManager->flush();

        $session->invalidate();
    }





}






 ?>

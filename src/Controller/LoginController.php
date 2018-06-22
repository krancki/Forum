<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Users;
use App\Entity\SessionTab;
use Symfony\Component\HttpFoundation\Session\Session;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function index()
    {

      $session = $this->get('session');

      if($session->get("isLogin")!=null)
      {
      return $this->redirect('/main');
      }




        if(isset($_POST["username"]) && isset($_POST["password"]))
        {

          $username=$_POST["username"];
          $password=$_POST["password"];

          $userRep= $this->getDoctrine()->getRepository(Users::class);

          $user= $userRep->findBy(["nick"=>$username]);
          if($user!=null && $user[0]->getPassword()==$password)
          {


            Tools::setSession($user[0],$this);
            return $this->redirect('/main');

          }
          else
          {
              echo "nei ma typa";
          }


        }

        return $this->render('login/login.html.twig',array("session"=>$session));
    }
}

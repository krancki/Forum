<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Entity\SessionTab;

class LogoutController extends Controller
{
    /**
     * @Route("/logout", name="logout")
     */
    public function index()
    {
      $session= $this->get('session');

      if($session->get("isLogin"))
      {
      $entityManager= $this->getDoctrine()->getManager();
      Tools::Logout($entityManager);
      }
      return $this->redirect("/main");
    }
}

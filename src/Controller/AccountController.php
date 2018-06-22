<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AccountController extends Controller
{
    /**
     * @Route("/account", name="account")
     */
    public function index()
    {
      $session = $this->get("session");

      if($session->get("isLogin")==false)
      {
      return $this->redirect('/main');
      }

        return $this->render('account/account.html.twig');
    }
}

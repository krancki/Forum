<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Users;
use App\Entity\SessionTab;
use Symfony\Component\HttpFoundation\Session\Session;


class RegistryController extends Controller
{
    /**
     * @Route("/registry", name="registry")
     */
    public function index()
    {

      $session = $this->get('session');

      if($session->get("isLogin")!=null)
      {
      return $this->redirect('/main');
      }


      if(isset($_POST["nick"]))
        {
        $nick = $_POST["nick"];
        $name = $_POST["name"];
        $secoundname = $_POST["secoundname"];
        $address = $_POST["address"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $rep_password = $_POST["rep-password"];

          if($password==$rep_password)
          {
            $entityManager = $this->getDoctrine()->getManager();

          $user = new Users();
          $user->setNick($nick);
          $user->setName($name);
          $user->setSecoundname($secoundname);
          $user->setAddress($address);
          $user->setEmail($email);
          $user->setPassword($password);

          $user->setIsmode("0");
          $user->setDateCreation(new \datetime());

            $userDoctrine = $this->getDoctrine()->getRepository(Users::class);

              $error= array(
                'isError'=>false,
                'NickError' => false,
                'EmailError'=> false,
                'NameError'=> empty($name),
                'SecoundnameError'=> empty($secoundname),
                'PasswordError'=> empty($password)

              );



              $error=Tools::isCorect($user,$userDoctrine,$error);
            if($error['isError']==true)
            {
              return $this->render('registry/registryErr.html.twig',array("error"=>$error));
            }
              $entityManager->persist($user);

              $entityManager->flush();




              return $this->redirect('/login');
          }
          }

        return $this->render('registry/registry.html.twig');
    }
}

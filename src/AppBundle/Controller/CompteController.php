<?php

namespace AppBundle\Controller;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/MonCompte")
 *
 */
class CompteController extends Controller
{
    /**
     * @Route("/Compte/{id}", name="MonComtpe")
     */
    public function MoncompteAction($id){

        $user = $this->getDoctrine()->getRepository("AppBundle:User")->findBy(
            array('id' => $id));


        return $this->render(':Compte/MonCompte.html:MonCompte.html.twig',
            [
                'user'=>$user,
            ]);
    }

    public function SetCompteAction($id){



    }
}

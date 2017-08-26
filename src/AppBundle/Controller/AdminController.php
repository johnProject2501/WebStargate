<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\RegistrationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends Controller
{
    /**
     * @Route("/", name="connection.index")
     *
     */
    public function indexAction()
    {

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/GereCompteUser/", name="GererCompteUser")
     */
    public function GererUserAction(){
        $user=$this->getDoctrine()->getRepository('AppBundle:User')->findAll();

        return $this->render('Compte/MonCompte.html/GererCompte.html.twig',[
            'user'=>$user
        ]);
    }

    /**
     *@Route("/GereCompteUser/enable{id}", name="enable")
     */
    public function enableAction($id){

        $user=$this->getDoctrine()->getRepository('AppBundle:User')->find($id);

        $em=$this->getDoctrine()->getManager();

        $user->setEnabled('1');



        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('GererCompteUser');

    }

    /**
     *@Route("/GereCompteUser/notEnable{id}", name="notEnable")
     */
    public function notEnableAction($id){

        $user=$this->getDoctrine()->getRepository('AppBundle:User')->find($id);

        $em=$this->getDoctrine()->getManager();

        $user->setEnabled('0');

        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('GererCompteUser');

    }

}

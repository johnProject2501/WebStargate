<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\RegistrationType;
use AppBundle\Form\UpdateCompte;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
    /**
     * @Route("/CompteUpdate/{id}", name="Update")
     */
    public function SetCompteAction($id, Request $request){

        $user=$this->getDoctrine()->getRepository('AppBundle:User')->find($id);



        $form=$this->createForm(UpdateCompte::class,$user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            //Persister l'objet
            $em=$this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();


            //rediriger vers la page home
            return $this->redirectToRoute("homepage");
        }


        return $this->render(":Compte/MonCompte.html:UpdateCompte.html.twig",
            [
                "form"=>$form->createView()
            ]
        );
    }





    /**
     * @Route("/CompteDelete/{id}", name="Delete")
     */
    public function DeleteUserAction($id){
        $user=$this->getDoctrine()->getRepository('AppBundle:User')->find($id);

        $em=$this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        return $this->redirect($this->generateUrl('homepage'));

    }




}

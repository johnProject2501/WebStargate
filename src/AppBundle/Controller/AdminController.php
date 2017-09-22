<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Concours;
use AppBundle\Entity\User;
use AppBundle\Form\ConcoursType;
use AppBundle\Form\NewsType;
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
     * @Route("/GereCompteUser/", name="GererCompteUser")
     */
    public function GererUserAction()//cherche la liste des utilisateur inscrit
    {
        $user=$this->getDoctrine()->getRepository('AppBundle:User')->findAll();

        return $this->render('Compte/MonCompte.html/GererCompte.html.twig',[
            'user'=>$user
        ]);
    }

    /**
     *@Route("/GereCompteUser/enable{id}", name="enable")
     */
    public function enableAction($id)//Permet d'activier un compte
    {

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
    public function notEnableAction($id)//Permet de desactiver un compte
    {

        $user=$this->getDoctrine()->getRepository('AppBundle:User')->find($id);

        $em=$this->getDoctrine()->getManager();

        $user->setEnabled('0');

        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('GererCompteUser');

    }

    /**
     * @Route("/GererConcours", name="GererConcours")
     */
    public function ConcoursAction()//Affiche la liste des concours
    {

        $concours=$this->getDoctrine()->getRepository('AppBundle:Concours')->findAll();



        return $this->render('Concours/GereConcour.html.twig',[
            'concour'=>$concours
        ]);


    }

    /**
     * @Route("/ConcoursDelete/{id}", name="concoursDelete")
     */
    public function DeleteConcoursAction($id)//supprimer un concours
    {
        $user=$this->getDoctrine()->getRepository('AppBundle:Concours')->find($id);

        $em=$this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        return $this->redirect($this->generateUrl('GererConcours'));

    }

    /**
     * @Route("/ConcoursDetail/{id}", name="concoursDetail")
     */
    public function DetailConcourAction(Concours $concours)//permet de regarder le detail d'un concours
    {
        $concours=$this->getDoctrine()->getRepository('AppBundle:Concours')->find($concours);

        $users=$concours->getUser();

        return $this->render(':Concours:Detail.html.twig',[
            'concour'=>$concours,
            'users'=>$users

        ]);

    }

    /**
     * @Route("/CreeUnConcour", name="CreateConcours")
     */
    public  function CreateConcoursAction(Request $request)//permet de crée un concours
    {
        $concours=new Concours();
        //crétation du formulaire
        $form=$this->createForm(ConcoursType::class,$concours);
        $form->handleRequest($request);

        $file = $concours->getFile();
        //test et persistance du formulaire
        if ($form->isSubmitted() && $form->isValid() && $file!=null){
            //Persister l'objet
            $em=$this->getDoctrine()->getManager();



            $file = $concours->getFile();


            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('imageconcours_directory'),
                $fileName
            );

            $concours->setFile($fileName);

            $em->persist($concours);
            $em->flush();




                return $this->redirectToRoute("GererConcours");



        }
        return $this->render("Concours/CreateConcours.html.twig",
            [
                "form"=>$form->createView()
            ]
        );
    }


    /**
     * @Route("/ConcourUpdate/{id}", name="UpdateConcour")
     * @Method(methods={"GET","POST"})
     */
    public function SetCompteAction(Concours $concours, Request $request){

        $form=$this->createForm(ConcoursType::class,$concours);

        $form->handleRequest($request);


        $file = $concours->getFile();

        if ($form->isSubmitted() && $form->isValid() && $file!=null){
            //Persister l'objet
            $em=$this->getDoctrine()->getManager();



            $file = $concours->getFile();



            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('imageconcours_directory'),
                $fileName
            );

            $concours->setFile($fileName);

            $em->persist($concours);
            $em->flush();





            //rediriger vers la page GererNews

            return $this->redirectToRoute("GererConcours");



        }

        elseif($form->isSubmitted() && $form->isValid() && $file == null){
            //Persister l'objet
            $em=$this->getDoctrine()->getManager();


            $em->persist($concours);
            $em->flush();



            return $this->redirectToRoute("GererConcours");




        }

        return $this->render("Concours/UpdateConcour.html.twig",
            [
                "concours"=>$concours,
                "form"=>$form->createView()
            ]
        );
    }
}

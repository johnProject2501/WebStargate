<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\RegistrationType;
use AppBundle\Form\UpdateCompte;
use Doctrine\ORM\Mapping as ORM;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
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
     * @Method(methods={"GET","POST"})
     */
    public function SetCompteAction(User $user, Request $request){

        $image=$user->getImage();

        $form=$this->createForm(UpdateCompte::class,$user);


        $form->handleRequest($request);




        $file = $user->getImage();

        if ($form->isSubmitted() && $form->isValid() && $file!=null){
            //Persister l'objet
            $em=$this->getDoctrine()->getManager();



            $file = $user->getImage();


            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('imageuser_directory'),
                $fileName
            );

            $user->setImage($fileName);

            $em->persist($user);
            $em->flush();


            $userTest=$this->getUser()->getRoles();


            //rediriger vers la page MonCompte
            if ($userTest=="ROLE_USER"){
                return $this->redirectToRoute("MonComtpe",array(
                    'id' => $user->getId()));
            }
            elseif ($userTest=="ROLE_ADMIN"){
                return $this->redirectToRoute("GererCompteUser");
            }


        }

        elseif($form->isSubmitted() && $form->isValid() && $file == null){
            //Persister l'objet
            $em=$this->getDoctrine()->getManager();


            $em->persist($user);
            $em->flush();


            $userTest=$this->getUser()->getRoles();


            //rediriger vers la page MonCompte
            if ($userTest=="ROLE_ADMIN"){
                return $this->redirectToRoute("GererCompteUser");
            }
            elseif ($userTest=="ROLE_USER"){
                return $this->redirectToRoute("MonComtpe",array(
                    'id' => $user->getId()));
            }



        }

        return $this->render(":Compte/MonCompte.html:UpdateCompte.html.twig",
            [
                "user"=>$user,
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

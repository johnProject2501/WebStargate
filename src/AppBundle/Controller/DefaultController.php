<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\RegistrationType;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        // replace this example code with whatever you need
        return $this->render('Index/index.html.twig',[

        ]);
    }


    /**
     * @Route("/SG1", name="SaisonSG1")
     */
    public function SG1Action(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('Saison/StargateSG1.html.twig');
    }

    /**
     * @Route("/SGA", name="SaisonSGA")
     */
    public function SGAAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('Saison/StargateSGA.html.twig');
    }


    /**
     * @Route("/SGU", name="SaisonSGU")
     */
    public function SGUAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('Saison/StargateSGU.html.twig');
    }

    /**
     * @Route("/Film", name="Film")
     */
    public function FilmAction(Request $request)
    {

        // replace this example code with whatever you need
        return $this->render('film/listeFilm.html.twig');
    }



    /**
     * @Route("/inscription", name="inscription.index")
     * @Method(methods={"GET","POST"})
     */
    public function inscription(Request $request){
        $user=new User();
        $form=$this->createForm(RegistrationType::class,$user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            //Persister l'objet
            $em=$this->getDoctrine()->getManager();

            $user->setEnabled('1');

            $em->persist($user);
            $em->flush();


            //rediriger vers la page home
            return $this->redirectToRoute("homepage");
        }


        return $this->render("inscription.html.twig",
            [
                "form"=>$form->createView()
            ]
        );
    }
}

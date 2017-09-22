<?php

namespace AppBundle\Controller;

use AppBundle\Entity\News;
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

        $concours=$this->getDoctrine()->getRepository('AppBundle:Concours')->findAll();

        $news=$this->getDoctrine()->getRepository('AppBundle:News')->findAll();



        // replace this example code with whatever you need
        return $this->render(':Index:Index.html.twig',[
            'concour'=>$concours,
            'news'=>$news
        ]);
    }


    /**
     * @Route("/NewsDetail/{id}", name="NewsDetail")
     */
    public function DetailConcourAction(News $news){
        $news=$this->getDoctrine()->getRepository('AppBundle:News')->find($news);

        return $this->render('News/Detail.html.twig',[
            'news'=>$news

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

            $Alluserpseudo=$this->getDoctrine()->getRepository('AppBundle:User')->findBy(
                array('username' => $user->getUsernameCanonical()));
            $Alluseremail=$this->getDoctrine()->getRepository('AppBundle:User')->findBy(
                array('email' => $user->getEmail()));

            if (!empty($Alluserpseudo || $Alluseremail )){



                return $this->redirectToRoute("inscriptionError.index",[

                ]);
            }
            else{

                $em=$this->getDoctrine()->getManager();




                $file = $user->getImage();
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move(
                    $this->getParameter('imageuser_directory'),
                    $fileName
                );

                $user->setImage($fileName);
                $user->setEnabled('1');

                $em->persist($user);
                $em->flush();

                $request->getSession()
                    ->getFlashBag()
                    ->add('success', 'Inscription réussie');


                //rediriger vers la page home
                return $this->redirectToRoute("homepage");
            }
        }




        return $this->render(":Inscription:inscription.html.twig",
            [
                "form"=>$form->createView(),

            ]
        );
    }




    /**
     * @Route("/inscriptions", name="inscriptionError.index")
     * @Method(methods={"GET","POST"})
     */
    public function inscriptionError(Request $request){
        $user=new User();
        $form=$this->createForm(RegistrationType::class,$user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            //Persister l'objet

            $Alluser=$this->getDoctrine()->getRepository('AppBundle:User')->findBy(
                array('username' => $user->getUsernameCanonical()));
            $Alluseremail=$this->getDoctrine()->getRepository('AppBundle:User')->findBy(
                array('email' => $user->getEmail()));

            if (!empty($Alluser || $Alluseremail)){

                return $this->redirectToRoute("inscriptionError.index",[

                ]);
            }
            else{

                $em=$this->getDoctrine()->getManager();

                $file = $user->getImage();
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move(
                    $this->getParameter('imageuser_directory'),
                    $fileName
                );

                $user->setImage($fileName);
                $user->setEnabled('1');

                $em->persist($user);
                $em->flush();

                $request->getSession()
                    ->getFlashBag()
                    ->add('success', 'Inscription réussie');

                //rediriger vers la page home
                return $this->redirectToRoute("homepage");
            }
        }

        return $this->render(":Inscription:inscriptionError.html.twig",
            [
                "form"=>$form->createView(),

            ]
        );
    }

}

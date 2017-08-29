<?php

namespace AppBundle\Controller;

use AppBundle\Entity\News;
use AppBundle\Form\NewsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class NewsController extends Controller
{
    /**
     * @Route("/GereNews", name="GererNews")
     */
    public function GererUserAction(){
        $News=$this->getDoctrine()->getRepository('AppBundle:News')->findAll();

        return $this->render('News/GererNews.html.twig',[
            'news'=>$News
        ]);
    }


    /**
     * @Route("/CreeUneNews", name="CreateNews")
     */
    public  function CreateConcoursAction(Request $request){
        $News=new News();
        $form=$this->createForm(NewsType::class,$News);


        $form->handleRequest($request);




        $file = $News->getFile();

        if ($form->isSubmitted() && $form->isValid() && $file!=null){
            //Persister l'objet
            $em=$this->getDoctrine()->getManager();



            $file = $News->getFile();


            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('imagenews_directory'),
                $fileName
            );

            $News->setFile($fileName);

            $em->persist($News);
            $em->flush();




            return $this->redirectToRoute("GererNews");



        }
        return $this->render("News/CreateNews.html.twig",
            [
                "form"=>$form->createView()
            ]
        );
    }




    /**
     * @Route("/NewsDelete/{id}", name="newsDelete")
     */
    public function DeleteConcoursAction($id){
        $news=$this->getDoctrine()->getRepository('AppBundle:News')->find($id);

        $em=$this->getDoctrine()->getManager();
        $em->remove($news);
        $em->flush();

        return $this->redirect($this->generateUrl('GererNews'));

    }

    /**
     * @Route("/NewsUpdate/{id}", name="UpdateNews")
     * @Method(methods={"GET","POST"})
     */
    public function SetCompteAction(News $news, Request $request){



        $form=$this->createForm(NewsType::class,$news);


        $form->handleRequest($request);




        $file = $news->getFile();

        if ($form->isSubmitted() && $form->isValid() && $file!=null){
            //Persister l'objet
            $em=$this->getDoctrine()->getManager();



            $file = $news->getFile();



            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('imagenews_directory'),
                $fileName
            );

            $news->setFile($fileName);

            $em->persist($news);
            $em->flush();





            //rediriger vers la page GererNews

                return $this->redirectToRoute("GererNews");



        }

        elseif($form->isSubmitted() && $form->isValid() && $file == null){
            //Persister l'objet
            $em=$this->getDoctrine()->getManager();


            $em->persist($news);
            $em->flush();



                return $this->redirectToRoute("GererNews");




        }

        return $this->render(":News:UpdateNews.html.twig",
            [
                "news"=>$news,
                "form"=>$form->createView()
            ]
        );
    }
}

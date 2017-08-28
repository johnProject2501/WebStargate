<?php
/**
 * Created by PhpStorm.
 * User: john2501
 * Date: 28/08/2017
 * Time: 10:42
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Concours;
use AppBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
/**
 * @Route("/connect")
 */
class ConnectUser extends Controller
{
    /**
     * @Route("/", name="Login")
     */
    public function loginAction(Request $request)
    {
        $concours=$this->getDoctrine()->getRepository('AppBundle:Concours')->findAll();


        // replace this example code with whatever you need
        return $this->render(':Index:Index.html.twig',[
            'concour'=>$concours,
        ]);
    }

    /**
     * @Route("/InscriptionConcour/{id}/{idConcour}", name="InscriptionUserConcours")
     */
    public function inscriptionConcoursAction(User $user,$idConcour)
    {
        $concours=$this->getDoctrine()->getRepository('AppBundle:Concours')->find($idConcour);

        $em=$this->getDoctrine()->getManager();



        $user=$user->addConcour($concours);



        $em->persist($user);
        $em->flush();


        return $this->redirectToRoute('homepage');


    }

    /**
     * @Route("/concours/{id}", name="InscriptionConcours")
     */
    public function concoursAction(Concours $concours){

        /**
         * @var User $user
         */
        $user=$this->getUser();

        if ($user->getConcour()->contains($concours)){
            $variable=true;
        }
        else{
            $variable=false;
        }





        return $this->render('Concours/InscriptionConcours.html.twig',[
            'concour'=>$concours,
            'users'=>$user,
            'variable'=>$variable
        ]);
    }
}
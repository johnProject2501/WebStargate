<?php

namespace AppBundle\Controller;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;


class SaisonsController extends Controller
{
    /**
     * @Route("/ListeEpisode/{idOfSaison}", name="ListeEpisode")
     */
    public function indexAction($idOfSaison)
    {
        $episode = $this->getDoctrine()->getRepository("AppBundle:Episodes")->findBy(
            array('idOfSaison' => $idOfSaison));

        return $this->render('Saison/ListeEpisode.html.twig',[
            "episode"=>$episode,

            ]);
    }


    /**
     * @Route("/Episode/{id}", name="Episode")
     */
    public function EpisodeAction($id)
    {
        $episode = $this->getDoctrine()->getRepository("AppBundle:Episodes")->findBy(
            array('id' => $id));

        return $this->render('Saison/Episode.html.twig',[
            "episode"=>$episode,

        ]);
    }
}

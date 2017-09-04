<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/json")
 */
class JsonController extends Controller
{
    /**
     * /**
     * @Route("/Episode/Json/{id}", name="episode.json")
     * @Method("GET")
     */
    public function jsonEpisodeAction($id)
    {
        $categorias = $this->getDoctrine()
            ->getRepository('AppBundle:Episodes')
            ->findBy(array('idOfSaison' => $id));

        $categorias = $this->get('serializer')->serialize($categorias, 'json');

        $response = new Response($categorias);

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }


    /**
     * @Route("/News/Json", name="news.json")
     * @Method("GET")
     */
    public function jsonNewsAction()
    {
        $categorias = $this->getDoctrine()
            ->getRepository('AppBundle:News')
            ->findAll();

        $categorias = $this->get('serializer')->serialize($categorias, 'json');

        $response = new Response($categorias);

        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }



    /**
     * @Route("/Film/Json/{id}", name="Film.json")
     * @Method("GET")
     */
    public function jsonFilmAction($id)
    {
        $categorias = $this->getDoctrine()
            ->getRepository('AppBundle:Episodes')
            ->findBy(array('id' => $id));


        $data = null ;


        foreach($categorias as $categoria)
        {
            $sring = str_replace ('<br>',' ',$categoria->getResumerLong());
            $data = [
                'id' => $categoria->getId(),
                'idOfSaison' =>$categoria->getIdOfSaison(),
                'titre'=>$categoria->getTitre(),
                'resumerCourt'=>$categoria->getResumerCourt(),
                'resumerLong'=>$sring,
                'photo'=>$categoria->getPhoto()
            ];
        }

        return new JsonResponse($data);
    }






}

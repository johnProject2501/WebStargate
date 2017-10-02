<?php

namespace AppBundle\Controller;


use AppBundle\Form\EpisodeSearchType;
use AppBundle\Model\EpisodeSearch;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends Controller
{
    /**
     * @Route("/search/",name="search")
     */
    public function listAction(Request $request)
    {

        $episode=new EpisodeSearch();

        $form=$this->createForm(EpisodeSearchType::class,$episode);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $articleSearch  = $form->getData();

            $finder = $this->container->get('fos_elastica.finder.app.episodes');

            $results = $finder->find($articleSearch->getTitle());



            return $this->render("Recherche/ResultatRecherche.html.twig",array('results' => $results));



        }
        return $this->render("Recherche/FormRecherche.html.twig",
            [
                "form"=>$form->createView()
            ]
        );
    }
}

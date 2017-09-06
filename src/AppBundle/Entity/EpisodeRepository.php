<?php
/**
 * Created by PhpStorm.
 * User: john2501
 * Date: 06/09/2017
 * Time: 12:21
 */

namespace AppBundle\Entity;

use AppBundle\Model\EpisodeSearch;
use FOS\ElasticaBundle\Repository;

class EpisodeRepository extends Repository
{
    public function search(EpisodeSearch $articleSearch)
    {
        // we create a query to return all the articles
        // but if the criteria title is specified, we use it
        if ($articleSearch->getTitle() != null && $articleSearch != '') {
            $query = new \Elastica\Query\Match();
            $query->setFieldQuery('article.title', $articleSearch->getTitle());
            $query->setFieldFuzziness('article.title', 0.7);
            $query->setFieldMinimumShouldMatch('article.title', '80%');
            //
        } else {
            $query = new \Elastica\Query\MatchAll();
        }
        return $this->find($query);
    }
}
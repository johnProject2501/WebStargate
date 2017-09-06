<?php
/**
 * Created by PhpStorm.
 * User: john2501
 * Date: 06/09/2017
 * Time: 12:07
 */

namespace AppBundle\Model;


class EpisodeSearch
{
    protected $title;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

}
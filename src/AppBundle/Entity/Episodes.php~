<?php
/**
 * Created by PhpStorm.
 * User: john2501
 * Date: 22/08/2017
 * Time: 15:19
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="episodes")
 */
class Episodes
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $idOfSaison;

    /**
     * @ORM\Column(type="string")
     */
    protected $titre;

    /**
     * @ORM\Column(type="string")
     */
    protected $resumerCourt;

    /**
     * @ORM\Column(type="text")
     */
    protected $resumerLong;

    /**
     * @ORM\Column(type="string")
     */
    protected $photo;
//////////Getter and SETTER
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdOfSaison()
    {
        return $this->idOfSaison;
    }

    /**
     * @param mixed $idOfSaison
     */
    public function setIdOfSaison($idOfSaison)
    {
        $this->idOfSaison = $idOfSaison;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getResumerCourt()
    {
        return $this->resumerCourt;
    }

    /**
     * @param mixed $resumerCourt
     */
    public function setResumerCourt($resumerCourt)
    {
        $this->resumerCourt = $resumerCourt;
    }

    /**
     * @return mixed
     */
    public function getResumerLong()
    {
        return $this->resumerLong;
    }

    /**
     * @param mixed $resumerLong
     */
    public function setResumerLong($resumerLong)
    {
        $this->resumerLong = $resumerLong;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }


}

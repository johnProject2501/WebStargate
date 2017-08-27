<?php
/**
 * Created by PhpStorm.
 * User: john2501
 * Date: 21/08/2017
 * Time: 17:03
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping\JoinColumn;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @ORM\HasLifecycleCallbacks()
 */
class User extends BaseUser
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer",nullable=true)
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Concours")
     * @JoinColumn(name="id_concours", referencedColumnName="id")
     */
    private $id_concours;

    /**
     * @ORM\Column(type="string")
     * @Assert\File(mimeTypes={ "image/jpeg", "image/jpg","image/png"})
     */
    private $Image;

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->Image;
    }

    /**
     * @param mixed $Image
     */
    public function setImage($Image)
    {
        $this->Image = $Image;
    }


}
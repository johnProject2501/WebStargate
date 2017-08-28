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
     * @ORM\Column(type="string")
     * @Assert\File(mimeTypes={ "image/jpeg", "image/jpg","image/png"})
     * @Assert\NotBlank(message="Update image obligatoire")
     */
    private $Image;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Concours",inversedBy="user")
     */
    private $concour;

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



    /**
     * Add concour
     *
     * @param \AppBundle\Entity\Concours $concour
     *
     * @return User
     */
    public function addConcour(\AppBundle\Entity\Concours $concour)
    {
        $this->concour[] = $concour;

        return $this;
    }

    /**
     * Remove concour
     *
     * @param \AppBundle\Entity\Concours $concour
     */
    public function removeConcour(\AppBundle\Entity\Concours $concour)
    {
        $this->concour->removeElement($concour);
    }

    /**
     * Get concour
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConcour()
    {
        return $this->concour;
    }
}

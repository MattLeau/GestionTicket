<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;


/**
 * user
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\userRepository")
 */
class user extends BaseUser
{
    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="projets", inversedBy="user")
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="metier", type="string", unique=false)
     */
    protected $metier;

    /**
     * @return string
     */
    public function getMetier()
    {
        return $this->metier;
    }

    /**
     * @param string $metier
     */
    public function setMetier($metier)
    {
        $this->metier = $metier;
    }



    public function __construct()
    {
        parent::__construct();
    }
}


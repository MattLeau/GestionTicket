<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * taches
 *
 * @ORM\Table(name="taches")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\tachesRepository")
 */
class taches
{
    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="projets", inversedBy="taches")
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="projet", type="string", length=255)
     */
    private $projet;

    /**
     * @var string
     *
     * @ORM\Column(name="evolution", type="string", length=255)
     */
    private $evolution;

    /**
     * @var string
     *
     * @ORM\Column(name="affectation", type="string", unique=false)
     */
    private $affectation;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set projet
     *
     * @param string $projet
     *
     * @return taches
     */
    public function setProjet($projet)
    {
        $this->projet = $projet;

        return $this;
    }

    /**
     * Get projet
     *
     * @return string
     */
    public function getProjet()
    {
        return $this->projet;
    }

    /**
     * Set evolution
     *
     * @param string $evolution
     *
     * @return taches
     */
    public function setEvolution($evolution)
    {
        $this->evolution = $evolution;

        return $this;
    }

    /**
     * Get evolution
     *
     * @return string
     */
    public function getEvolution()
    {
        return $this->evolution;
    }

    /**
     * Set affectation
     *
     * @param integer $affectation
     *
     * @return taches
     */
    public function setAffectation($affectation)
    {
        $this->affectation = $affectation;

        return $this;
    }

    /**
     * Get affectation
     *
     * @return int
     */
    public function getAffectation()
    {
        return $this->affectation;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return taches
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}


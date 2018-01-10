<?php

namespace MiloBudzetBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="imie")
 */
class dodajImie {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Assert\NotBlank
     */
    private $imie;
    
     /**
     * @ORM\OneToMany(targetEntity="dodajWydatek", mappedBy="dodajImiona")
     * @ORM\OneToMany(targetEntity="dodajPrzychod", mappedBy="dodajImiona")
     */
    private $imiona;
    

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set imie
     *
     * @param string $imie
     *
     * @return dodajImie
     */
    public function setImie($imie)
    {
        $this->imie = $imie;

        return $this;
    }

    /**
     * Get imie
     *
     * @return string
     */
    public function getImie()
    {
        return $this->imie;
    }
    
    public function __toString() {
        return $this->imie;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->imiona = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add imiona
     *
     * @param \MiloBudzetBundle\Entity\dodajWydatek $imiona
     *
     * @return dodajImie
     */
    public function addImiona(\MiloBudzetBundle\Entity\dodajWydatek $imiona)
    {
        $this->imiona[] = $imiona;

        return $this;
    }

    /**
     * Remove imiona
     *
     * @param \MiloBudzetBundle\Entity\dodajWydatek $imiona
     */
    public function removeImiona(\MiloBudzetBundle\Entity\dodajWydatek $imiona)
    {
        $this->imiona->removeElement($imiona);
    }

    /**
     * Get imiona
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImiona()
    {
        return $this->imiona;
    }
}

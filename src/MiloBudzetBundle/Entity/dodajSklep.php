<?php

namespace MiloBudzetBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="sklep")
 */
class dodajSklep {
    
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
    private $sklep;
    
     /**
     * @ORM\OneToMany(targetEntity="dodajWydatek", mappedBy="dodajSklepy")
     */
    private $sklepy;
    

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
     * Set sklep
     *
     * @param string $sklep
     *
     * @return dodajSklep
     */
    public function setSklep($sklep)
    {
        $this->sklep = $sklep;

        return $this;
    }

    /**
     * Get sklep
     *
     * @return string
     */
    public function getSklep()
    {
        return $this->sklep;
    }
    
    public function __toString() {
        return $this->sklep;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sklepy = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add sklepy
     *
     * @param \MiloBudzetBundle\Entity\dodajWydatek $sklepy
     *
     * @return dodajSklep
     */
    public function addSklepy(\MiloBudzetBundle\Entity\dodajWydatek $sklepy)
    {
        $this->sklepy[] = $sklepy;

        return $this;
    }

    /**
     * Remove sklepy
     *
     * @param \MiloBudzetBundle\Entity\dodajWydatek $sklepy
     */
    public function removeSklepy(\MiloBudzetBundle\Entity\dodajWydatek $sklepy)
    {
        $this->sklepy->removeElement($sklepy);
    }

    /**
     * Get sklepy
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSklepy()
    {
        return $this->sklepy;
    }
}

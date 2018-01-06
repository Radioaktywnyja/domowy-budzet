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
}

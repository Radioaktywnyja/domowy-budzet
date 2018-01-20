<?php

namespace MiloBudzetBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="MiloBudzetBundle\Repository\dodajTypPrzychoduRepository")
 * @ORM\Table(name="typPrzychodu")
 */
class dodajTypPrzychodu {
    
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
    private $grupa;
    
    /**
     * @ORM\OneToMany(targetEntity="dodajPrzychod", mappedBy="dodajTypy")
     */
    private $typy;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->typy = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set grupa
     *
     * @param string $grupa
     *
     * @return dodajTypPrzychodu
     */
    public function setGrupa($grupa)
    {
        $this->grupa = $grupa;

        return $this;
    }

    /**
     * Get grupa
     *
     * @return string
     */
    public function getGrupa()
    {
        return $this->grupa;
    }

    /**
     * Add typy
     *
     * @param \MiloBudzetBundle\Entity\dodajPrzychod $typy
     *
     * @return dodajTypPrzychodu
     */
    public function addTypy(\MiloBudzetBundle\Entity\dodajPrzychod $typy)
    {
        $this->typy[] = $typy;

        return $this;
    }

    /**
     * Remove typy
     *
     * @param \MiloBudzetBundle\Entity\dodajPrzychod $typy
     */
    public function removeTypy(\MiloBudzetBundle\Entity\dodajPrzychod $typy)
    {
        $this->typy->removeElement($typy);
    }

    /**
     * Get typy
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTypy()
    {
        return $this->typy;
    }
}

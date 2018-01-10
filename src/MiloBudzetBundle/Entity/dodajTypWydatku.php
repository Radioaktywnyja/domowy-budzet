<?php

namespace MiloBudzetBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use MiloBudzetBundle\Entity\dodajKatWydatku;

/**
 * @ORM\Entity
 * @ORM\Table(name="typWydatku")
 */
class dodajTypWydatku {
    
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
     * @ORM\ManyToOne(targetEntity="dodajKatWydatku", inversedBy="grupy")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dodajKategorie;
    
    /**
     * @ORM\OneToMany(targetEntity="dodajWydatek", mappedBy="dodajTypy")
     */
    private $typy;

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
     * @return dodajTypWydatku
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
     * Set dodajKategorie
     *
     * @param dodajKatWydatku $dodajKategorie
     *
     * @return dodajTypWydatku
     */
    public function setDodajKategorie(dodajKatWydatku $dodajKategorie)
    {
        $this->dodajKategorie = $dodajKategorie;

        return $this;
    }

    /**
     * Get dodajKategorie
     *
     * @return dodajKatWydatku
     */
    public function getDodajKategorie()
    {
        return $this->dodajKategorie;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->typy = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add typy
     *
     * @param \MiloBudzetBundle\Entity\dodajWydatek $typy
     *
     * @return dodajTypWydatku
     */
    public function addTypy(\MiloBudzetBundle\Entity\dodajWydatek $typy)
    {
        $this->typy[] = $typy;

        return $this;
    }

    /**
     * Remove typy
     *
     * @param \MiloBudzetBundle\Entity\dodajWydatek $typy
     */
    public function removeTypy(\MiloBudzetBundle\Entity\dodajWydatek $typy)
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

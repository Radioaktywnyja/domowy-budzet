<?php

namespace MiloBudzetBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="MiloBudzetBundle\Repository\dodajKatWydatkuRepository")
 * @ORM\Table(name="katWydatku")
 */
class dodajKatWydatku {
    
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
    private $kategoria;
    
    /**
     * @ORM\OneToMany(targetEntity="dodajTypWydatku", mappedBy="dodajKategorie")
     */
    private $grupy;
    

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
     * Set kategoria
     *
     * @param string $kategoria
     *
     * @return dodajKatWydatku
     */
    public function setKategoria($kategoria)
    {
        $this->kategoria = $kategoria;

        return $this;
    }

    /**
     * Get kategoria
     *
     * @return string
     */
    public function getKategoria()
    {
        return $this->kategoria;
    }
    
    
    public function __toString() {
        return $this->kategoria;
    }
    
    public function __construct() {
        $this->grupy = new ArrayCollection();
    }
    
    public function getGrupy() {
        return $this->grupy;
    }

    /**
     * Add grupy
     *
     * @param \MiloBudzetBundle\Entity\dodajTypWydatku $grupy
     *
     * @return dodajKatWydatku
     */
    public function addGrupy(\MiloBudzetBundle\Entity\dodajTypWydatku $grupy)
    {
        $this->grupy[] = $grupy;

        return $this;
    }

    /**
     * Remove grupy
     *
     * @param \MiloBudzetBundle\Entity\dodajTypWydatku $grupy
     */
    public function removeGrupy(\MiloBudzetBundle\Entity\dodajTypWydatku $grupy)
    {
        $this->grupy->removeElement($grupy);
    }
}

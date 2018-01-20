<?php

namespace MiloBudzetBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="MiloBudzetBundle\Repository\dodajWydatekRepository")
 * @ORM\Table(name="wydatki")
 */
class dodajWydatek {
    
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(type="date")
     * 
     * @Assert\NotBlank
     */
    private $data;
    
     /**
     * @ORM\Column(type="decimal", precision=9, scale=2)
     * 
     * @Assert\NotBlank
     * @Assert\Range(max=9999999)
     */
    private $kwota;
    
     /**
     * @ORM\ManyToOne(targetEntity="dodajTypWydatku", inversedBy="typy")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dodajTypy;
    
      /**
     * @ORM\ManyToOne(targetEntity="dodajImie", inversedBy="imiona")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dodajImiona;
    
      /**
     * @ORM\ManyToOne(targetEntity="dodajSklep", inversedBy="sklepy")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dodajSklepy;

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
     * Set data
     *
     * @param \DateTime $data
     *
     * @return dodajWydatek
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return \DateTime
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set kwota
     *
     * @param string $kwota
     *
     * @return dodajWydatek
     */
    public function setKwota($kwota)
    {
        $this->kwota = $kwota;

        return $this;
    }

    /**
     * Get kwota
     *
     * @return string
     */
    public function getKwota()
    {
        return $this->kwota;
    }

    /**
     * Set dodajTypy
     *
     * @param \MiloBudzetBundle\Entity\dodajTypWydatku $dodajTypy
     *
     * @return dodajWydatek
     */
    public function setDodajTypy(\MiloBudzetBundle\Entity\dodajTypWydatku $dodajTypy)
    {
        $this->dodajTypy = $dodajTypy;

        return $this;
    }

    /**
     * Get dodajTypy
     *
     * @return \MiloBudzetBundle\Entity\dodajTypWydatku
     */
    public function getDodajTypy()
    {
        return $this->dodajTypy;
    }

    /**
     * Set dodajImiona
     *
     * @param \MiloBudzetBundle\Entity\dodajImie $dodajImiona
     *
     * @return dodajWydatek
     */
    public function setDodajImiona(\MiloBudzetBundle\Entity\dodajImie $dodajImiona)
    {
        $this->dodajImiona = $dodajImiona;

        return $this;
    }

    /**
     * Get dodajImiona
     *
     * @return \MiloBudzetBundle\Entity\dodajImie
     */
    public function getDodajImiona()
    {
        return $this->dodajImiona;
    }

    /**
     * Set dodajSklepy
     *
     * @param \MiloBudzetBundle\Entity\dodajSklep $dodajSklepy
     *
     * @return dodajWydatek
     */
    public function setDodajSklepy(\MiloBudzetBundle\Entity\dodajSklep $dodajSklepy)
    {
        $this->dodajSklepy = $dodajSklepy;

        return $this;
    }

    /**
     * Get dodajSklepy
     *
     * @return \MiloBudzetBundle\Entity\dodajSklep
     */
    public function getDodajSklepy()
    {
        return $this->dodajSklepy;
    }
}

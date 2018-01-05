<?php

namespace MiloBudzetBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
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
     * @ORM\Column(type="string", length=255)
     * 
     * @Assert\NotBlank
     */
    private $typ;
    
    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Assert\NotBlank
     */
    private $imie;
    
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
     * Set typ
     *
     * @param string $typ
     *
     * @return dodajWydatek
     */
    public function setTyp($typ)
    {
        $this->typ = $typ;

        return $this;
    }

    /**
     * Get typ
     *
     * @return string
     */
    public function getTyp()
    {
        return $this->typ;
    }

    /**
     * Set imie
     *
     * @param string $imie
     *
     * @return dodajWydatek
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

    /**
     * Set sklep
     *
     * @param string $sklep
     *
     * @return dodajWydatek
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

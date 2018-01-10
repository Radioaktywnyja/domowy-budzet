<?php

namespace MiloBudzetBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="przychody")
 */
class dodajPrzychod {
    
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
     * @ORM\ManyToOne(targetEntity="dodajTypPrzychodu", inversedBy="typy")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dodajTypy;
    
      /**
     * @ORM\ManyToOne(targetEntity="dodajImie", inversedBy="imiona")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dodajImiona;

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
     * @return dodajPrzychod
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
     * @return dodajPrzychod
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
     * @param \MiloBudzetBundle\Entity\dodajTypPrzychodu $dodajTypy
     *
     * @return dodajPrzychod
     */
    public function setDodajTypy(\MiloBudzetBundle\Entity\dodajTypPrzychodu $dodajTypy)
    {
        $this->dodajTypy = $dodajTypy;

        return $this;
    }

    /**
     * Get dodajTypy
     *
     * @return \MiloBudzetBundle\Entity\dodajTypPrzychodu
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
     * @return dodajPrzychod
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
}

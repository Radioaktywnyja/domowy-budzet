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
    private $przychWyd;
    
    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Assert\NotBlank
     */
    private $kategoria;
    
    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Assert\NotBlank
     */
    private $grupa;
    
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
    

    public function save($savePath) {
        
        $paramsNames = array('data', 'kwota', 'przychWyd', 'kategoria', 'grupa', 'imie', 'sklep'); 
        $formData = array();
        foreach ($paramsNames as $name) {
            $formData[$name] = $this->{$name};
        }
        
        $randVal = rand(1000, 9999);
        $dataFileName = sprintf('data_%d.txt', $randVal);
            
        file_put_contents($savePath.$dataFileName, print_r($formData, TRUE));
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
     * Set przychWyd
     *
     * @param string $przychWyd
     *
     * @return dodajWydatek
     */
    public function setPrzychWyd($przychWyd)
    {
        $this->przychWyd = $przychWyd;

        return $this;
    }

    /**
     * Get przychWyd
     *
     * @return string
     */
    public function getPrzychWyd()
    {
        return $this->przychWyd;
    }

    /**
     * Set kategoria
     *
     * @param string $kategoria
     *
     * @return dodajWydatek
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

    /**
     * Set grupa
     *
     * @param string $grupa
     *
     * @return dodajWydatek
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

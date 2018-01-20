<?php

namespace MiloBudzetBundle\Repository;

use Doctrine\ORM\EntityRepository;

class dodajTypWydatkuRepository extends EntityRepository {
    
    public function findBydodajKategorie($kat){
        
        $query = $this->getEntityManager()->createQuery(
            'SELECT dT.grupa, dT.id
            FROM MiloBudzetBundle:dodajTypWydatku dT
            WHERE dT.dodajKategorie = :kat'
        );
        $query->setParameter('kat', $kat);
        
        $result = $query->getResult();
        
        return $result;
        
    }
    
}

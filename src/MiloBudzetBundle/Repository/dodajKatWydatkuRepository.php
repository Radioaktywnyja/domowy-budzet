<?php

namespace MiloBudzetBundle\Repository;

use Doctrine\ORM\EntityRepository;

class dodajKatWydatkuRepository extends EntityRepository {
    
    public function findAllkategorie(){
        
        $query = $this->getEntityManager()->createQuery(
            'SELECT dK.kategoria, dK.id
            FROM MiloBudzetBundle:dodajKatWydatku dK'
        );
        
        $result = $query->getResult();
        
        return $result;
        
    }
    
}

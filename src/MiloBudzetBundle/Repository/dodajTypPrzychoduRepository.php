<?php

namespace MiloBudzetBundle\Repository;

use Doctrine\ORM\EntityRepository;

class dodajTypPrzychoduRepository extends EntityRepository {
    
    public function findAlltypPrzychodu(){
        
        $query = $this->getEntityManager()->createQuery(
            'SELECT dT.grupa, dT.id
            FROM MiloBudzetBundle:dodajTypPrzychodu dT'
        );
        
        $result = $query->getResult();
        
        return $result;
        
    }
    
}
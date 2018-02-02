<?php

namespace MiloBudzetBundle\Repository;

use Doctrine\ORM\EntityRepository;

class dodajWydatekRepository extends EntityRepository {
    
    public function findBydodajTypyAndData($typ, $data) {
        
        $month = $data->format('F');
        $year = $data->format('Y');
        $fromDate = new \DateTime('first day of '.$month.' '.$year); 
        $toDate = new \DateTime('last day of '.$month.' '.$year);
        
        $query = $this->getEntityManager()->createQuery(
            'SELECT dW.kwota, dW.data
            FROM MiloBudzetBundle:dodajWydatek dW
            JOIN dW.dodajTypy a
            WHERE dW.dodajTypy = :typ AND dW.data BETWEEN :fromDate AND :toDate'
        );
        $query->setParameters(array(
            'typ' => $typ,
            'fromDate' => $fromDate,
            'toDate' => $toDate
        ));
        
        $result = $query->getResult();
        
        return $result;
        
    }
    
}

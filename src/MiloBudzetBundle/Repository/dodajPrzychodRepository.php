<?php

namespace MiloBudzetBundle\Repository;

use Doctrine\ORM\EntityRepository;

class dodajPrzychodRepository extends EntityRepository {
    
    public function findBydodajTypy($typ, $data) {
        
        $month = $data->format('F');
        $year = $data->format('Y');
        $fromDate = new \DateTime('first day of '.$month.' '.$year); 
        $toDate = new \DateTime('last day of '.$month.' '.$year);
        
        $query = $this->getEntityManager()->createQuery(
            'SELECT dP.kwota, dP.data
            FROM MiloBudzetBundle:dodajPrzychod dP
            JOIN dP.dodajTypy a
            WHERE dP.dodajTypy = :typ AND dP.data BETWEEN :fromDate AND :toDate'
        );
        $query->setParameters(array(
            'typ' => $typ,
            'fromDate' => $fromDate,
            'toDate' => $toDate
        ));
        
        $result = $query->getResult();
        
        return $result;
        
    }
    
    public function findBydodajTypyAndData($typ, $data) {
        
        $day = $data->format('Y-m-d');
        
        $query = $this->getEntityManager()->createQuery(
            'SELECT dP
            FROM MiloBudzetBundle:dodajPrzychod dP
            JOIN dP.dodajTypy a
            WHERE dP.dodajTypy = :typ AND dP.data = :day'
        );
        $query->setParameters(array(
            'typ' => $typ,
            'day' => $day
        ));
        
        $result = $query->getResult();
        
        return $result;
        
    }
    
}

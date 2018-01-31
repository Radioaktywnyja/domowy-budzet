<?php

namespace MiloBudzetBundle\Repository;

use Doctrine\ORM\EntityRepository;

class dodajPrzychodRepository extends EntityRepository {
    
    public function findBydodajTypyByData($typ, $data) {
        
        $query = $this->getEntityManager()->createQuery(
            'SELECT SUM(dP.kwota)
            FROM MiloBudzetBundle:dodajPrzychod dP
            JOIN dP.dodajTypy a
            WHERE dP.dodajTypy = :typ AND dP.data = :data'
        );
        $query->setParameters(array(
            'typ' => $typ,
            'data' => $data
        ));
        
        $result = $query->getResult();
        
        return $result;
        
    }
    
    public function findByData($data) {
        
        $query = $this->getEntityManager()->createQuery(
            'SELECT SUM(dP.kwota)
            FROM MiloBudzetBundle:dodajPrzychod dP
            JOIN dP.dodajTypy a
            WHERE dP.data = :data'
        );
        $query->setParameters(array(
            'data' => $data
        ));
        
        $result = $query->getResult();
        
        return $result;
        
    }
    
    public function findBydodajTypyAndSum($typ, $data) {
        
        $month = $data->format('F');
        $year = $data->format('Y');
        $fromDate = new \DateTime('first day of '.$month.' '.$year); 
        $toDate = new \DateTime('last day of '.$month.' '.$year);
        
        $query = $this->getEntityManager()->createQuery(
            'SELECT SUM(dP.kwota)
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
    
}

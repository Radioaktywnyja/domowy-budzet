<?php

namespace MiloBudzetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use MiloBudzetBundle\Controller\BudzetController;
use MiloBudzetBundle\Entity as Entity;

/**
 * @Route("/budzet")
 */
class BudzetController extends Controller {

    /**
     * @Route(
     *      "/{okres}",
     *      defaults={"okres"="today"}
     * )
     * 
     * @Template
     */
    public function indexAction($okres) {
        
        $tabelaSumWydatkow = $this->wyswietlSumeWydatkowAction($okres);
        $tabelaSumPrzychodow = $this->wyswietlSumePrzychodowAction($okres);

        return array(
            'data' => $tabelaSumWydatkow['data'],
            'wydatki_sumy' => $tabelaSumWydatkow['wydatki_sumy'],
            'sumaWydatkow' => $tabelaSumWydatkow['sumaWydatkow'],
            'przychody_sumy' => $tabelaSumPrzychodow['przychody_sumy']
        );
    }
        
        
    public function wyswietlSumeWydatkowAction($okres) {
        
        $em = $this->getDoctrine()->getManager();
        
        $repoKwota = $em->getRepository('MiloBudzetBundle:dodajWydatek');
        $repoTyp = $em->getRepository('MiloBudzetBundle:dodajTypWydatku');
        $repoKat = $em->getRepository('MiloBudzetBundle:dodajKatWydatku');
        
        $data = new \DateTime($okres);        
        $kategorie = $repoKat->findAllkategorie();
        $sumaWydatkow = 0;
        
        foreach($kategorie as $k => $category){
            $typy = $repoTyp->findByDodajKategorie($category['id']);
            foreach($typy as $t => $type) {;
                $kwoty = $repoKwota->findBydodajTypyAndSum($type['id'], $data);
                $wydatki_sumy[$category['kategoria']][$type['grupa']] = $kwoty[0][1];
            }
            $wydatki_sumy[$category['kategoria']]['Suma'] = sprintf('%0.2f', array_sum($wydatki_sumy[$category['kategoria']]));
            $sumaWydatkow = $sumaWydatkow + $wydatki_sumy[$category['kategoria']]['Suma'];
        }
                
        return array(
            'data' => $data,
            'wydatki_sumy' => $wydatki_sumy,
            'sumaWydatkow' => sprintf('%0.2f', $sumaWydatkow)
        );
    }
    
     public function wyswietlWydatkiAction($okres) {
        
        $em = $this->getDoctrine()->getManager();
        
        $repoKwota = $em->getRepository('MiloBudzetBundle:dodajWydatek');
        $repoTyp = $em->getRepository('MiloBudzetBundle:dodajTypWydatku');
        $repoKat = $em->getRepository('MiloBudzetBundle:dodajKatWydatku');
        
        $data = new \DateTime($okres);        
        $kategorie = $repoKat->findAllkategorie();
        
        foreach($kategorie as $k => $category){
            $typy = $repoTyp->findByDodajKategorie($category['id']);
            foreach($typy as $t => $type) {
                $wydatki[$category['kategoria']][] = $type['grupa'];
                $kwoty = $repoKwota->findBydodajTypy($type['id'], $data);
                foreach($kwoty as $k => $amount){
                    $wydatki[$category['kategoria']][$type['grupa']][] = $amount['kwota'];
                }
            }
        }
           
        return array(
            'data' => $data,
            'wydatki' => $wydatki,
        );
    }
    
    public function wyswietlSumePrzychodowAction($okres) {
        
        $em = $this->getDoctrine()->getManager();
        
        $repoKwota = $em->getRepository('MiloBudzetBundle:dodajPrzychod');
        $repoTyp = $em->getRepository('MiloBudzetBundle:dodajTypPrzychodu');
        
        $data = new \DateTime($okres);        
        $typy = $repoTyp->findAlltypPrzychodu();
        $sumaPrzychodow = 0;
        
        foreach($typy as $t => $type){
            $kwoty = $repoKwota->findBydodajTypyAndSum($type['id'], $data);
            $przychody_sumy[$type['grupa']] = $kwoty[0][1];
        }
        
        $przychody_sumy['Suma'] = sprintf('%0.2f', array_sum($przychody_sumy));
                
        return array(
            'data' => $data,
            'przychody_sumy' => $przychody_sumy,
        );
    }
    
    public function wyswietlPrzychodyAction($okres) {
        
        $em = $this->getDoctrine()->getManager();
        
        $repoKwota = $em->getRepository('MiloBudzetBundle:dodajPrzychod');
        $repoTyp = $em->getRepository('MiloBudzetBundle:dodajTypPrzychodu');
        
        $data = new \DateTime($okres);        
        $typy = $repoTyp->findAlltypPrzychodu();
        
        foreach($typy as $t => $type){
            $kwoty = $repoKwota->findBydodajTypy($type['id'], $data);
            foreach($kwoty as $k => $amount){
                $przychody[$type['grupa']][] = $amount['kwota'];
            }
        }
        
                
        return array(
            'data' => $data,
            'przychody' => $przychody
        );
    }
    
}

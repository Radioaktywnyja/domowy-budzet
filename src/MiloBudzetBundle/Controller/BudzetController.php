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
     *      defaults={"okres"="today"},
     *      name="milo_budzet_index"
     * )
     * 
     * @Template
     */
    public function indexAction($okres) {
        
        $tabelaSumWydatkow = $this->wyswietlSumeWydatkowAction($okres);
        $tabelaSumPrzychodow = $this->wyswietlSumePrzychodowAction($okres);
        $tabelaWydatkow = $this->wyswietlWydatkiAction($okres);
        $tabelaPrzychodow = $this->wyswietlPrzychodyAction($okres);

        return array(
            'data' => $tabelaSumWydatkow['data'],
            'wydatki_sumy' => $tabelaSumWydatkow['wydatki_sumy'],
            'sumaWydatkow' => $tabelaSumWydatkow['sumaWydatkow'],
            'przychody_sumy' => $tabelaSumPrzychodow['przychody_sumy'],
            'wydatki' => $tabelaWydatkow['wydatki'],
            'wydatki_dzien' => $tabelaWydatkow['wydatki_dzien'],
            'ileDni' => $tabelaWydatkow['ileDni'],
            'przychody' => $tabelaPrzychodow['przychody'],
            'przychody_dzien' => $tabelaPrzychodow['przychody_dzien'],
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
        $rok = $data->format('Y');
        $mies = $data->format('m');
        $ileDni = cal_days_in_month(CAL_GREGORIAN, $mies, $rok);
        
        foreach($kategorie as $k => $category){
            $typy = $repoTyp->findByDodajKategorie($category['id']);
            foreach($typy as $t => $type) {
                for($i = 1; $i <= $ileDni; $i++) {
                    $dzien = $rok.'-'.$mies.'-'.str_pad($i, 2, '0', STR_PAD_LEFT);
                    $kwota = $repoKwota->findBydodajTypyByData($type['id'], $dzien);
                    $suma_dzien = $repoKwota->findByData($dzien);
                    $wydatki[$category['kategoria']][$type['grupa']][$i] = $kwota[0][1];
                    if(!is_null($suma_dzien[0][1])) {
                        $wydatki_dzien[$i] = $suma_dzien[0][1];
                    } else {
                        $wydatki_dzien[$i] = '0.00';
                    }
                }
            }
        }
           
        return array(
            'data' => $data,
            'wydatki' => $wydatki,
            'wydatki_dzien' => $wydatki_dzien,
            'ileDni' => $ileDni
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
        $rok = $data->format('Y');
        $mies = $data->format('m');
        $ileDni = cal_days_in_month(CAL_GREGORIAN, $mies, $rok);
        
        foreach($typy as $t => $type){
            for($i = 1; $i <= $ileDni; $i++){
                $dzien = $rok.'-'.$mies.'-'.str_pad($i, 2, '0', STR_PAD_LEFT);
                $kwota = $repoKwota->findBydodajTypyByData($type['id'], $dzien);
                $suma_dzien = $repoKwota->findByData($dzien);
                $przychody[$type['grupa']][$i] = $kwota[0][1];
                if(!is_null($suma_dzien[0][1])) {
                    $przychody_dzien[$i] = $suma_dzien[0][1];
                } else {
                    $przychody_dzien[$i] = '0.00';
                }
            }
        }
                
        return array(
            'data' => $data,
            'przychody' => $przychody,
            'przychody_dzien' => $przychody_dzien,
            'ileDni' => $ileDni
        );
    }
    
}

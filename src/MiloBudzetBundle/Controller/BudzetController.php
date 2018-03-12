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
        
        $tabelaWydatkow = $this->wyswietlWydatkiAction($okres);
        $tabelaPrzychodow = $this->wyswietlPrzychodyAction($okres);
        $tabelaSumWydatkow = $this->wyswietlSumeWydatkowAction($tabelaWydatkow['wydatki']);
        $tabelaSumPrzychodow = $this->wyswietlSumePrzychodowAction($tabelaPrzychodow['przychody']);

        return array(
            'tabelaWydatkow' => $tabelaWydatkow,
            'tabelaPrzychodow' => $tabelaPrzychodow,
            'tabelaSumWydatkow' => $tabelaSumWydatkow,
            'tabelaSumPrzychodow' => $tabelaSumPrzychodow,
        );
    }
    
    /**
     * @Route(
     *      "/{rodzaj}-dzienny/{typ}/{okres}",
     *      name="milo_budzet_pokazDzienne",
     *      requirements={"rodzaj"="Wydatek|Przychod", "typ"="\d+"}
     * )
     * 
     * @Template
     */
    public function pokazDzienneAction($rodzaj, $typ, $okres) {
        
        $em = $this->getDoctrine()->getManager();
        
        $repo = $em->getRepository('MiloBudzetBundle:dodaj'.$rodzaj);
        $data = new \DateTime($okres);
        
        $dzienne = $repo->findBydodajTypyAndData($typ, $data);


        return array(
            'dzienne' => $dzienne,
            'rodzaj' => $rodzaj
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
        $ileDni = cal_days_in_month(CAL_GREGORIAN, $data->format('m'), $data->format('Y'));
        
        for($i = 1; $i <= $ileDni; $i++) {
            $dzien = $rok.'-'.$mies.'-'.str_pad($i, 2, '0', STR_PAD_LEFT);
            $wydatki_dzien[$i] = 0;
        }
        
        foreach($kategorie as $k => $category){
            $typy = $repoTyp->findByDodajKategorie($category['id']);
            foreach($typy as $t => $type) {
                $wydatki[$category['kategoria']][$type['grupa']]['id'] = $type['id'];
                for($i = 1; $i <= $ileDni; $i++) {
                    $dzien = $rok.'-'.$mies.'-'.str_pad($i, 2, '0', STR_PAD_LEFT);
                    $wydatki[$category['kategoria']][$type['grupa']][$i] = null;
                }
                $kwota = $repoKwota->findBydodajTypy($type['id'], $data);
                foreach($kwota as $k => $amount){
                    $wydatki[$category['kategoria']][$type['grupa']][$amount['data']->format('j')] += $amount['kwota'];
                    $wydatki_dzien[$amount['data']->format('j')] += $amount['kwota'];
                }
                
            }
        }
         
           
        return array(
            'data' => $data,
            'wydatki' => $wydatki,
            'wydatki_dzien' => $wydatki_dzien,
            'ileDni' => $ileDni,
        );
    }
    
    public function wyswietlSumeWydatkowAction($wydatki) {
        
        $sumaWydatkow = 0;
        
        foreach($wydatki as $k => $category){
            foreach($category as $t => $type) {
                $wydatki_sumy[$k][$t] = array_sum(array_slice($type, 1));
            }
            $wydatki_sumy[$k]['Suma'] = array_sum($wydatki_sumy[$k]);
            $sumaWydatkow += $wydatki_sumy[$k]['Suma'];
        }
                
        return array(
            'wydatki_sumy' => $wydatki_sumy,
            'sumaWydatkow' => $sumaWydatkow
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
        
        for($i = 1; $i <= $ileDni; $i++) {
            $dzien = $rok.'-'.$mies.'-'.str_pad($i, 2, '0', STR_PAD_LEFT);
            $przychody_dzien[$i] = 0;
        }
        
        foreach($typy as $t => $type){
            $przychody[$type['grupa']]['id'] = $type['id'];
            for($i = 1; $i <= $ileDni; $i++){
                $dzien = $rok.'-'.$mies.'-'.str_pad($i, 2, '0', STR_PAD_LEFT);
                $przychody[$type['grupa']][$i] = null;
            }
            $kwota = $repoKwota->findBydodajTypy($type['id'], $data);
            foreach($kwota as $k => $amount){
                $przychody[$type['grupa']][$amount['data']->format('j')] += $amount['kwota'];
                $przychody_dzien[$amount['data']->format('j')] += $amount['kwota'];
            }
        }
                
        return array(
            'data' => $data,
            'przychody' => $przychody,
            'przychody_dzien' => $przychody_dzien,
            'ileDni' => $ileDni
        );
    }
    
    public function wyswietlSumePrzychodowAction($przychody) {
        
        foreach($przychody as $t => $type){
            $przychody_sumy[$t] = array_sum(array_slice($type, 1));
        }
        
        $przychody_sumy['Suma'] = array_sum($przychody_sumy);
                
        return array(
            'przychody_sumy' => $przychody_sumy,
        );
    }
    
    
}

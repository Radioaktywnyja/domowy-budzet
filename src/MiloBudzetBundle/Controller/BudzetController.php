<?php

namespace MiloBudzetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use MiloBudzetBundle\Form\Type as Type;
use MiloBudzetBundle\Entity as Entity;

/**
 * @Route("/budzet")
 */
class BudzetController extends Controller {

    /**
     * @Route("/")
     * 
     * @Template
     */
    public function indexAction() {
        return array();
    }
    
    /**
     * @Route(
     *      "/dodajWydatek",
     *      name="milo_budzet_dodajWydatek"
     * )
     * 
     * @Template
     */    
    public function dodajWydatekAction(Request $Request) {
        
        $dodajWydatek = new Entity\dodajWydatek();
        $dodajWydatek->setData(new \DateTime());
        
        $form = $this->createForm(Type\dodajWydatekType::class, $dodajWydatek);
        
        $form->handleRequest($Request);
        
        $Session = $this->get('session');
        
        if($Request->isMethod('POST')) {
            if($form->isSubmitted() && $form->isValid()) {
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($dodajWydatek);
                $em->flush();

                $Session->getFlashBag()->add('success', 'Zgłoszenie zostało zapisane');

                return $this->redirect($this->generateUrl('milo_budzet_dodajWydatek'));

            }else{
                $Session->getFlashBag()->add('danger', 'Popraw błędy formularza');
            }
        }
        
        return array(
            'form' => $form->createView(),
        );
    }
    
    /**
     * @Route(
     *      "/dodajTypWydatku",
     *      name="milo_budzet_dodajTypWydatku"
     * )
     * 
     * @Template
     */
    public function dodajTypWydatku(Request $Request) {
        
        $dodajTypWydatku = new Entity\dodajTypWydatku();
        
        $form = $this->createForm(Type\dodajTypWydatkuType::class, $dodajTypWydatku);
        
        $form->handleRequest($Request);
        
        $Session = $this->get('session');
        
        if($Request->isMethod('POST')) {
            if($form->isSubmitted() && $form->isValid()){
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($dodajTypWydatku);
                $em->flush();
                
                $Session->getFlashBag()->add('success', 'Zgłoszenie zostało zapisane');
                
                return $this->redirect($this->generateUrl('milo_budzet_dodajTypWydatku'));
                
            } else {
                $Session->getFlashBag()->add('danger', 'Popraw błędy formularza');
            }
        }
        
        return array(
            'form' => $form->createView(),
        );
    }
    
    
    /**
     * @Route(
     *      "/dodajKatWydatku",
     *      name="milo_budzet_dodajKatWydatku"
     * )
     * 
     * @Template
     */
    public function dodajKatWydatku(Request $Request) {
        
        $dodajKatWydatku = new Entity\dodajKatWydatku();
        
        $form = $this->createForm(Type\dodajKatWydatkuType::class, $dodajKatWydatku);
        
        $form->handleRequest($Request);
        
        $Session = $this->get('session');
        
        if($Request->isMethod('POST')){
            if($form->isSubmitted() && $form->isValid()) {
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($dodajKatWydatku);
                $em->flush();
                
                $Session->getFlashBag()->add('success', 'Zgłoszenie zostało zapisane');
                
                return $this->redirect($this->generateUrl('milo_budzet_dodajKatWydatku'));
                
            } else {
                $Session->getFlashBag()->add('danger', 'Popraw dane formularza');
            }
        }
        
        return array(
            'form' => $form->createView()
        );
        
    }
    
    /**
     * @Route(
     *      "/dodajImie",
     *      name="milo_budzet_dodajImie"
     * )
     * 
     * @Template
     */
    public function dodajImie(Request $Request) {
        
        $dodajImie = new Entity\dodajImie();
        
        $form = $this->createForm(Type\dodajImieType::class, $dodajImie);
        
        $form->handleRequest($Request);
        
        $Session = $this->get('session');
        
        if($Request->isMethod('POST')) {
            if($form->isSubmitted() && $form->isValid()) {
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($dodajImie);
                $em->flush();
                
                $Session->getFlashBag()->add('success', "Zgłoszenie zostało zapisane");
                
                return $this->redirect($this->generateUrl('milo_budzet_dodajImie'));
                
            } else {
                $Session->getFlashBag()->add('danger', 'Popraw dane formularza');
            }
        }
        
        return array(
            'form' => $form->createView()
        );
        
    }
    
    /**
     * @Route(
     *      "/dodajSklep",
     *      name="milo_budzet_dodajSklep"
     * )
     * 
     * @Template
     */
    public function dodajSklep(Request $Request) {
        
        $dodajSklep = new Entity\dodajSklep();
        
        $form = $this->createForm(Type\dodajSklepType::class, $dodajSklep);
        
        $form->handleRequest($Request);
        
        $Session = $this->get('session');
        
        if($Request->isMethod('POST')) {
            if($form->isSubmitted() && $form->isValid()) {
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($dodajSklep);
                $em->flush();
                
                $Session->getFlashBag()->add('success', 'Zgłoszenie zostało zapisane');
                
                return $this->redirect($this->generateUrl('milo_budzet_dodajSklep'));
                
            } else {
                $Session->getFlashBag()->add('danger', 'Popraw dane formularza');
            }
        }
        
        return array(
            'form' => $form->createView()
        );
        
    }
    
    /**
     * @Route(
     *      "/dodajPrzychod",
     *      name="milo_budzet_dodajPrzychod"
     * )
     * 
     * @Template
     */    
    public function dodajPrzychodAction(Request $Request) {
        
        $dodajPrzychod = new Entity\dodajPrzychod();
        $dodajPrzychod->setData(new \DateTime());
        
        $form = $this->createForm(Type\dodajPrzychodType::class, $dodajPrzychod);
        
        $form->handleRequest($Request);
        
        $Session = $this->get('session');
        
        if($Request->isMethod('POST')) {
            if($form->isSubmitted() && $form->isValid()) {
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($dodajPrzychod);
                $em->flush();

                $Session->getFlashBag()->add('success', 'Zgłoszenie zostało zapisane');

                return $this->redirect($this->generateUrl('milo_budzet_dodajPrzychod'));

            }else{
                $Session->getFlashBag()->add('danger', 'Popraw błędy formularza');
            }
        }
        
        return array(
            'form' => $form->createView(),
        );
    }
    
    /**
     * @Route(
     *      "/dodajTypPrzychodu",
     *      name="milo_budzet_dodajTypPrzychodu"
     * )
     * 
     * @Template
     */
    public function dodajTypPrzychodu(Request $Request) {
        
        $dodajTypPrzychodu = new Entity\dodajTypPrzychodu();
        
        $form = $this->createForm(Type\dodajTypPrzychoduType::class, $dodajTypPrzychodu);
        
        $form->handleRequest($Request);
        
        $Session = $this->get('session');
        
        if($Request->isMethod('POST')) {
            if($form->isSubmitted() && $form->isValid()){
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($dodajTypPrzychodu);
                $em->flush();
                
                $Session->getFlashBag()->add('success', 'Zgłoszenie zostało zapisane');
                
                return $this->redirect($this->generateUrl('milo_budzet_dodajTypPrzychodu'));
                
            } else {
                $Session->getFlashBag()->add('danger', 'Popraw błędy formularza');
            }
        }
        
        return array(
            'form' => $form->createView(),
        );
    }
    
}

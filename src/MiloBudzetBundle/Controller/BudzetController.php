<?php

namespace MiloBudzetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use MiloBudzetBundle\Form\Type\dodajWydatekType;
use MiloBudzetBundle\Entity\dodajWydatek;

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
        
        $dodajWydatek = new dodajWydatek();
        $dodajWydatek->setData(new \DateTime());
        
        $form = $this->createForm(dodajWydatekType::class, $dodajWydatek);
        
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
    
}

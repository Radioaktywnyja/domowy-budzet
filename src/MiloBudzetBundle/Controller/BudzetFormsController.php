<?php

namespace MiloBudzetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type as formType;
use MiloBudzetBundle\Form\Type as Type;
use MiloBudzetBundle\Entity as Entity;

/**
 * @Route("/budzet/forms")
 */
class BudzetFormsController extends Controller {
    
    /**
     * @Route(
     *      "/dodajWydatek",
     *      name="milo_budzet_forms_dodajWydatek"
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

                return $this->redirect($this->generateUrl('milo_budzet_forms_dodajWydatek'));

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
     *      name="milo_budzet_forms_dodajTypWydatku"
     * )
     * 
     * @Template
     */
    public function dodajTypWydatkuAction(Request $Request) {
        
        $em = $this->getDoctrine()->getManager();
        
        $repoTyp = $em->getRepository('MiloBudzetBundle:dodajTypWydatku');
        $repoKat = $em->getRepository('MiloBudzetBundle:dodajKatWydatku');
        
        $kategorie = $repoKat->findAllkategorie();
        
        foreach($kategorie as $k => $category){
            $types = $repoTyp->findByDodajKategorie($category['id']);
            foreach($types as $t => $type) {
                $typy[$category['kategoria']][$type['grupa']] = $type['id'];
            }
        }
        
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
                
                return $this->redirect($this->generateUrl('milo_budzet_forms_dodajTypWydatku'));
                
            } else {
                $Session->getFlashBag()->add('danger', 'Popraw błędy formularza');
            }
        }
        
        return array(
            'form' => $form->createView(),
            'typy' => $typy
        );
    }
    
    
    /**
     * @Route(
     *      "/dodajKatWydatku",
     *      name="milo_budzet_forms_dodajKatWydatku"
     * )
     * 
     * @Template
     */
    public function dodajKatWydatkuAction(Request $Request) {
        
        $query = $this->getDoctrine()->getManager()->createQuery(
                'SELECT dK.kategoria, dK.id
                FROM MiloBudzetBundle:dodajKatWydatku dK'
                );
        $kategorie = $query->getResult();
        
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
                
                return $this->redirect($this->generateUrl('milo_budzet_forms_dodajKatWydatku'));
                
            } else {
                $Session->getFlashBag()->add('danger', 'Popraw dane formularza');
            }
        }
        
        return array(
            'form' => $form->createView(),
            'kategorie' => $kategorie
        );
        
    }
    
    /**
     * @Route(
     *      "/dodajImie",
     *      name="milo_budzet_forms_dodajImie"
     * )
     * 
     * @Template
     */
    public function dodajImieAction(Request $Request) {
        
        $query = $this->getDoctrine()->getManager()->createQuery(
                'SELECT dI.imie, dI.id
                FROM MiloBudzetBundle:dodajImie dI'
                );
        $imiona = $query->getResult();
        
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
                
                return $this->redirect($this->generateUrl('milo_budzet_forms_dodajImie'));
                
            } else {
                $Session->getFlashBag()->add('danger', 'Popraw dane formularza');
            }
        }
        
        return array(
            'form' => $form->createView(),
            'imiona' => $imiona
        );
        
    }
    
    /**
     * @Route(
     *      "/dodajSklep",
     *      name="milo_budzet_forms_dodajSklep"
     * )
     * 
     * @Template
     */
    public function dodajSklepAction(Request $Request) {
        
        $query = $this->getDoctrine()->getManager()->createQuery(
                'SELECT dS.sklep, dS.id
                FROM MiloBudzetBundle:dodajSklep dS'
                );
        $sklepy = $query->getResult();
        
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
                
                return $this->redirect($this->generateUrl('milo_budzet_forms_dodajSklep'));
                
            } else {
                $Session->getFlashBag()->add('danger', 'Popraw dane formularza');
            }
        }
        
        return array(
            'form' => $form->createView(),
            'sklepy' => $sklepy
        );
        
    }
    
    /**
     * @Route(
     *      "/dodajPrzychod",
     *      name="milo_budzet_forms_dodajPrzychod"
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

                return $this->redirect($this->generateUrl('milo_budzet_forms_dodajPrzychod'));

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
     *      name="milo_budzet_forms_dodajTypPrzychodu"
     * )
     * 
     * @Template
     */
    public function dodajTypPrzychoduAction(Request $Request) {
        
        $em = $this->getDoctrine()->getManager();
        $repoTyp = $em->getRepository('MiloBudzetBundle:dodajTypPrzychodu');
        $typy = $repoTyp->findAlltypPrzychodu();
        
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
                
                return $this->redirect($this->generateUrl('milo_budzet_forms_dodajTypPrzychodu'));
                
            } else {
                $Session->getFlashBag()->add('danger', 'Popraw błędy formularza');
            }
        }
        
        return array(
            'form' => $form->createView(),
            'typy' => $typy
        );
    }
    
    /**
     * @Route(
     *      "/zmienMiesiac",
     *      name="milo_budzet_forms_zmienMiesiac"
     * )
     * 
     * @Template
     */
    public function zmienMiesiacAction(Request $Request) {
        
        $form = $this->createFormBuilder()
                ->add('miesiac', formType\DateType::class, array(
                    'data' => new \DateTime('first day of this month')
                ))
                ->add('Ustaw', formType\SubmitType::class)
                ->getForm();
        
        $form->handleRequest($Request);
        
        if($Request->isMethod('POST')) {
            if($form->isSubmitted() && $form->isValid()){
                
                $formData = $form->getData();
                $formData = $formData['miesiac']->format('Y-m');
                
                return $this->redirect($this->generateUrl('milo_budzet_index', array(
                    'okres' => $formData
                )));
                
            }
        }
        
        return array(
            'form' => $form->createView(),
        );
    }
    
    /**
     * @Route(
     *      "/aktualizuj/{rodzaj}/{id}",
     *      name="milo_budzet_forms_aktualizuj",
     *      requirements={"rodzaj"="Wydatek|Przychod|TypPrzychodu|TypWydatku|KatWydatku|Imie|Sklep"}
     * )
     * 
     * @Template
     */
    public function aktualizujAction(Request $Request, $rodzaj, $id) {
        
        $repo = $this->getDoctrine()->getRepository('MiloBudzetBundle:dodaj'.$rodzaj);
        $rekord = $repo->find($id);
        
        $form = $this->createForm("MiloBudzetBundle\Form\Type\dodaj".$rodzaj."Type", $rekord);

        if($Request->isMethod('POST')) {
            
            $form->handleRequest($Request);
            $Session = $this->get('session');
            
            if($form->isSubmitted() && $form->isValid()) {
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($rekord);
                $em->flush();
                
                $Session->getFlashBag()->add('success', "Wpis został zaktualizowany");
                
                if($rodzaj == 'Wydatek' || $rodzaj == 'Przychod') {
                    return $this->redirect($this->generateUrl('milo_budzet_pokazDzienne', array(
                        'rodzaj' => $rodzaj,
                        'typ' => $rekord->getDodajTypy()->getId(),
                        'okres' => $rekord->getData()->format('Y-m-d')
                    )));
                } else {
                    return $this->redirect($this->generateUrl('milo_budzet_forms_dodaj'.$rodzaj));
                }
                
                
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
     *      "/usun/{rodzaj}/{id}",
     *      name="milo_budzet_forms_usun",
     *      requirements={"rodzaj"="Wydatek|Przychod|TypPrzychodu|TypWydatku|KatWydatku|Imie|Sklep"}
     * )
     */
    public function usunAction($rodzaj, $id) {
        
        $repo = $this->getDoctrine()->getRepository('MiloBudzetBundle:dodaj'.$rodzaj);
        $rekord = $repo->find($id);
                
        $em = $this->getDoctrine()->getManager();
        $em->remove($rekord);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success', "Wpis został usunięty");
        
        if($rodzaj == 'Wydatek' || $rodzaj == 'Przychod') {
            return $this->redirect($this->generateUrl('milo_budzet_pokazDzienne', array(
                'rodzaj' => $rodzaj,
                'typ' => $rekord->getDodajTypy()->getId(),
                'okres' => $rekord->getData()->format('Y-m-d')
            )));
        } else {
            return $this->redirect($this->generateUrl('milo_budzet_forms_dodaj'.$rodzaj));
        }
        
    }
    
}

<?php

namespace App\Controller;

use App\Entity\Scm;
use App\Entity\Charges;
use App\Form\ChargesType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChargesController extends AbstractController
{
    /**
     * @Route("/charges/{id}", name="charges")
     */
    public function index(Request $request, Scm $scm)
    {
        // dd($scm);
        $hasAccess = $this->isGranted('ROLE_ADMIN');
        $isConnected = $this->isGranted('ROLE_USER');
       
        if (!$hasAccess) {
            // dd($hasAccess);
            return $this->redirectToRoute('home');
        }
        elseif($isConnected){
            
                $charges = new Charges();
            $formCharges = $this->createForm(ChargesType::class, $charges);
            $formCharges->handleRequest($request);
            $charges->setScm($scm);
            $charges->setPayedAt(null);
            if($formCharges->isSubmitted() && $formCharges->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($charges);
                $em->flush();
                return $this->redirectToRoute('dash');
            }
           
            return $this->render('charges/index.html.twig', [
                'formCharges' => $formCharges->createView()
            ]);
        }
    }
}

<?php

namespace App\Controller;

use App\Entity\Scm;
use App\Entity\User;
use App\Form\ScmType;
use App\Form\RegistrationFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ScmController extends AbstractController
{
    /**
     * @Route("/create/scm", name="create_scm")
     */
    public function creaStag(Request $request,Scm $scm = null, User $user = null,UserPasswordEncoderInterface $passwordEncoder)
    {   
        if(!$scm){
            $scm = new Scm();
        }
        if(!$user){
            $user = new User();
        }

        $formUser = $this->createForm(RegistrationFormType::class, $user);
        $formUser->handleRequest($request);
        $formScm = $this->createForm(ScmType::class, $scm);
        $formScm->handleRequest($request);
        if($formScm->isSubmitted() && $formScm->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($scm);
            $em->flush();
            // dd($request->request);
            // return $this->redirectToRoute('session');
        }
        if($formUser->isSubmitted() && $formUser->isValid()){
            // dd($request->request);
            $user->setPassword($passwordEncoder->encodePassword($user,$formUser->get('plainPassword')->getData()));
            $user->setRoles(["ROLE_ADMIN"]);
            $user->addScm($scm);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            // return $this->redirectToRoute('session');
        }
        return $this->render('scm/index.html.twig', [
            'formUser' => $formUser->createView(),
            'formScm' => $formScm->createView(),
        ]);
    }
      /**
     * @Route("/dash", name="dash")
     */
    public function dash(Request $request, User $userNew = null)
    {
        // $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $hasAccess = $this->isGranted('ROLE_ADMIN');
        $isConnected = $this->isGranted('ROLE_USER');
        if (!$hasAccess) {
            $curl = curl_init();
            return $this->redirectToRoute('dash_user');
        }
        elseif($isConnected){
            // if(!$userNew){
            //     $userNew = new User();
            // }
            $user = $this->getUser();
            $scm = $user->getScms();
            $users = $scm[0]->getUser();
            $formUser = $this->createForm(RegistrationFormType::class, $user);
            $formUser->handleRequest($request);
            $nbPart = 0;
            foreach ($users as $value) {
                $nbPart += $value->getNbPart();
            }
            // dd($nbPart);
            // if($formUser->isSubmitted() && $formUser->isValid()){
            //     $userNew->addScm($scm[0]);
            //     $em = $this->getDoctrine()->getManager();
            //     $em->persist($userNew);
            //     $em->flush();
            //     return $this->redirectToRoute('dash');
            // }
            $charges = $scm[0]->getCharges();

            return $this->render('scm/dash.html.twig', [
                "scms" => $scm,
                "user" => $user,
                "users" => $users,
                "formUser" => $formUser->createView(),
                "charges" => $charges,
                "nbPart" => $nbPart
            ]);
        }
    }
     /**
     * @Route("/dash_user", name="dash_user")
     */
    public function dashUser(Request $request, User $userNew = null)
    {
        $user = $this->getUser();
        $scm = $user->getScms()[0];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://testscm-sandbox.biapi.pro/2.0/auth/register",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n  \"email\": \"myemail@mydomain.com\",\n  \"password\": \"testtest\",\n \"application\": \"scmtest\,\n }",
            CURLOPT_HTTPHEADER => array(
              "authorization: Bearer rlQh1Dp_DX5kUjZDpxkAfl8puGH8LJoraWCD81qm3eT5BmWeERPocbYfn4sqjNb_OBaOL4OjapRauCFG20Q2xa8nue_oO1NPt84vizgcniaovT6sT67zyec1XCNniUcz",
              "content-type: application/json"
            ),
          ));
          
          $response = curl_exec($curl);
          dump($response);
        // dd($scm);
        return $this->render('scm/dash_user.html.twig', [
            "scms" => $scm,
            "user" => $user,
            "nom" => $scm->getNom(),
            "charges" => $scm->getCharges()
            // "users" => $users,
            // "formUser" => $formUser->createView(),
            // "charges" => $charges
        ]);
    }
}

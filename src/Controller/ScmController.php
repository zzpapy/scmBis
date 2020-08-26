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
            // dd($hasAccess);
            return $this->redirectToRoute('home');
        }
        elseif($isConnected){
            if(!$userNew){
                $userNew = new User();
            }
            $user = $this->getUser();
            $scm = $user->getScms();
            $users = $scm[0]->getUser();
            $formUser = $this->createForm(RegistrationFormType::class, $user);
            $formUser->handleRequest($request);
            $userNew->addScm($scm[0]);
            if($formUser->isSubmitted() && $formUser->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($userNew);
                // dd($formUser->get('username')->getData());
                $em->flush();
                // return $this->redirectToRoute('session');
            }
            $charges = $scm[0]->getCharges();
            // dd($charges);

            return $this->render('home/dash.html.twig', [
                "scms" => $scm,
                "user" => $user,
                "users" => $users,
                "formUser" => $formUser->createView(),
                "charges" => $charges
            ]);
        }

    }
}

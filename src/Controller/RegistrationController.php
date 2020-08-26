<?php

namespace App\Controller;

use App\Entity\Scm;
use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        
        $scmRepo = $this->getDoctrine()->getRepository(Scm::class);
        $scm = $scmRepo->findOneBy(["id" => $request->get("id")]);
        // dd($request->get("id"));
        $users = $scm->getUser();
        $nbPart = 0;
        foreach ($users as $value) {
            $nbPart += $value->getNbPart();
        }
        // dd($nbPart);
        $user = new User();
        $user->addScm($scm);
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('dash');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'nbPart' => $nbPart
        ]);
    }
}

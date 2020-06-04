<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ResetPassType;
use App\Repository\UserRepository;
use Exception;
use Swift_Mailer;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;



class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();


        /*if($this->isGranted("IS_AUTHENTICATED_FULLY"))
        {
            return $this->redirectToRoute("main");
        }*/

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error]);
    }


    /**
     * @Route("/oubli-pass", name="app_forgotten_password")
     * @param Request $request
     * @param UserRepository $users
     * @param Swift_Mailer $mailer
     * @param TokenGeneratorInterface $tokenGenerator
     * @return Response
     */
    public function oubliPass(Request $request,
                              UserRepository $users,
                              Swift_Mailer $mailer,
                              TokenGeneratorInterface $tokenGenerator): Response
    {
        // On initialise le formulaire
        $form = $this->createForm(ResetPassType::class);

        // On traite le formulaire
        $form->handleRequest($request);

        // Si le formulaire est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère les données
            $donnees = $form->getData();

            // On cherche un utilisateur ayant cet e-mail
            $user = $users->findOneByEmail($donnees['email']);

            // Si l'utilisateur n'existe pas
            if ($user === null) {
                // On envoie une alerte disant que l'adresse e-mail est inconnue
                $this->addFlash('danger', 'Cette adresse e-mail est inconnue');

                // On retourne sur la page de connexion
                return $this->redirectToRoute('app_login');
            }

            // On génère un token
            $token = $tokenGenerator->generateToken();

            // On essaie d'écrire le token en base de données
            try{
                $user->$this->setResetToken();
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
            } catch (Exception $e) {
                $this->addFlash('warning', $e->getMessage());
                return $this->redirectToRoute('app_login');
            }

            // On génère l'URL de réinitialisation de mot de passe
            $url = $this->generateUrl('app_reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);

            // On génère l'e-mail
            $message = (new Swift_Message('Mot de passe oublié'))
                ->setFrom('ewen.launay889@gmail.com')
                ->setTo($user->$this->getEmail())
                ->setBody(
                    "Bonjour,<br><br>Une demande de réinitialisation de mot de passe a été effectuée pour le site Bikealinge.com . Veuillez cliquer sur le lien suivant : " . $url,
                    'text/html'
                )
            ;

            // On envoie l'e-mail
            $mailer->send($message);

            // On crée le message flash de confirmation
            $this->addFlash('message', 'E-mail de réinitialisation du mot de passe envoyé !');

            // On redirige vers la page de login
            return $this->redirectToRoute('app_login');
        }

        // On envoie le formulaire à la vue
        return $this->render('security/forgotten_password.html.twig',['emailForm' => $form->createView()]);


    }



    /**
     * @Route("/reset_pass/{token}", name="app_reset_password")
     * @param Request $request
     * @param string $token
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return RedirectResponse|Response
     */
    public function resetPassword(Request $request,
                                  string $token,
                                  UserPasswordEncoderInterface $passwordEncoder)
    {
        // require the user to log in during *this* session
        // if they were only logged in via a remember me cookie, they
        // will be redirected to the login page
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // On cherche un utilisateur avec le token donné
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['resetToken' => $token]);

        // Si l'utilisateur n'existe pas
        if ($user === null) {
            // On affiche une erreur
            $this->addFlash('danger', 'Token Inconnu');
            return $this->redirectToRoute('app_login');
        }

        // Si le formulaire est envoyé en méthode post
        if ($request->isMethod('POST')) {
            // On supprime le token
            $user->setResetToken(null);

            // On chiffre le mot de passe
            $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));

            // On stocke
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // On crée le message flash
            $this->addFlash('message', 'Mot de passe mis à jour');

            // On redirige vers la page de connexion
            return $this->redirectToRoute('app_login');
        }else {
            // Si on n'a pas reçu les données, on affiche le formulaire
            return $this->render('security/reset_password.html.twig', ['token' => $token]);
        }


    }
    /**
     * @Route("/logout", name="app_logout", methods={"GET"})
     * @throws Exception
     */
    public function logout()
    {
        // controller can be blank: it will never be executed!
        throw new Exception('Don\'t forget to activate logout in security.yaml');
    }




    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        // TODO: Implement getRoles() method.
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        // TODO: Implement getPassword() method.
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

//    /*/**
//     * @inheritDoc
//     */
//    public function buildForm(FormBuilderInterface $builder, array $options)
//    {
//        // TODO: Implement buildForm() method.
//    }
//
//    /**
//     * @inheritDoc
//     */
//    public function buildView(FormView $view, FormInterface $form, array $options)
//    {
//        // TODO: Implement buildView() method.
//    }*/

    /**
     * @inheritDoc
     */
    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        // TODO: Implement finishView() method.
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        // TODO: Implement configureOptions() method.
    }

    /**
     * @inheritDoc
     */
    public function getBlockPrefix()
    {
        // TODO: Implement getBlockPrefix() method.
    }

    /**
     * @inheritDoc
     */
    public function getParent()
    {
        // TODO: Implement getParent() method.
    }

    public function accountInfo()
    {
        // allow any authenticated user - we don't care if they just
        // logged in, or are logged in via a remember me cookie
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_REMEMBERED');

        // ...
    }




}

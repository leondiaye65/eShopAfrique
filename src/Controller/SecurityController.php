<?php

namespace App\Controller;
use App\Form\UserRegistrationFormType;
use App\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfoy\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class SecurityController
 * @package App\Controller
 * @Route("/", name="app_")
 */
class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils)

    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'titre_page' => 'Login',
            'titre_section' => $titre = "Page de login",
            'error'=> $error,
            'last_username'=>$lastUsername
        ]);

    }



   /**
    * @param Request $request
    * @param UserPasswordEncoderInterface $encoder
    * @param GuardAuthenticatorHandler $handler
    * @param LoginFormAuthenticator $authenticator)
    * @return Response|void
    * @Route("/register", name="register")
    */
    public function register(
        Request $request,
        UserPasswordEncoderInterface $encoder,
        GuardAuthenticatorHandler $handler,
        LoginFormAuthenticator $authenticator)
    {
        $form = $this->createForm(UserRegistrationFormType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
            dd($user);
            $user->setPassword($encoder->encodePassword(
                $user,
                $form['plainPassword']->getData()
           ));
            //dd($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $handler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main'
            );
       }

        return $this->render("security/register.html.twig",[
            'titre_page' => $titrePage = "Register",
            'titre_section' => $titreSection = "page d'inscription",
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/logout", name="logout", methods={"GET"})
     */
    public function logout()
    {
        // controller can be blank: it will never be executed!
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
}

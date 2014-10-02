<?php

namespace Blog\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\HttpFoundation\Request;
use Blog\UserBundle\Form\UserType;
use Blog\UserBundle\Form\LoginType;
use Blog\UserBundle\Entity\User;
use Blog\UserBundle\Entity\Role;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/{_locale}", requirements={"_locale" = "bg|en"})
 */
class UserController extends Controller
{
    // /**
    //  * @Template()
    //  */
    // public function loginAction(Request $request)
    // {
    //     $user = new User();
    //     $form = $this->createForm(new LoginType(), $user);
    //     $form->handleRequest($request);

    //     $session = $request->getSession();

    //     if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
    //         $error = $request->attributes->get(
    //             SecurityContextInterface::AUTHENTICATION_ERROR
    //         );
    //     } elseif (null !== $session && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
    //         $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
    //         $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
    //     } else {
    //         $error = '';
    //     }

    //     $lastUsername = (null === $session) ? '' : $session->get(SecurityContextInterface::LAST_USERNAME);

    //     return array('form' => $form->createView(), 'last_username' => $lastUsername, 'error' => $error);
    // }

    // /**
    //  * @Route("/register", name="register")
    //  * @Method({"GET", "POST"})
    //  * @Template()
    //  */
    // public function registerAction(Request $request)
    // {
    //     $factory = $this->get('security.encoder_factory');
    //     $user = new User();
    //     $form = $this->createForm(new UserType(), $user);
    //     $form->handleRequest($request);

    //     $role = $this->getDoctrine()
    //         ->getRepository('BlogUserBundle:Role')
    //         ->findOneByName('user');

    //     if ($form->isValid()) {

    //         $encoder = $factory->getEncoder($user);
    //         $password = $encoder->encodePassword(
    //             $user->getPassword(),
    //             $user->getSalt()
    //         );
    //         $user->setPassword($password);
    //         $user->addRole($role);
    //         $user->setImageName($user->getUsername());

    //         $em = $this->getDoctrine()->getManager();
    //         $em->persist($user);
    //         $em->flush();

    //         return $this->redirect($this->generateUrl('login'));

    //     }

    //     return array('form' => $form->createView());
    // }

    // /**
    //  * @Route("/edit", name="edit")
    //  * @Method({"GET", "POST"})
    //  * @Template()
    //  */
    // public function editAction(Request $request)
    // {
    //     $factory = $this->get('security.encoder_factory');
    //     $user = $this->getDoctrine()
    //         ->getRepository('BlogUserBundle:User')
    //         ->find($this->getUser()->getId());

    //     $form = $this->createForm(new UserType(), $user);
    //     $form->handleRequest($request);

    //     if ($form->isValid()) {

    //         $encoder = $factory->getEncoder($user);
    //         $password = $encoder->encodePassword(
    //             $user->getPassword(),
    //             $user->getSalt()
    //         );
    //         $user->setImageName($user->getUsername());
    //         $user->setPassword($password);
    //         $this->getDoctrine()->getManager()->flush($user);

    //         return $this->redirect($this->generateUrl('show_posts'));
    //     }

    //     return array('form' => $form->createView());
    // }
}

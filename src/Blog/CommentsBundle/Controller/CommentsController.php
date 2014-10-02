<?php

namespace Blog\CommentsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Blog\CommentsBundle\Entity\Comment;
use Symfony\Component\HttpFoundation\Request;
use Blog\CommentsBundle\Form\CommentsType;

/**
 * @Route("/{_locale}/comments", requirements={"_locale" = "bg|en"})
 */
class CommentsController extends Controller
{
    /**
     * @Route("/{id}", name="create_comment")
     * @Method({"POST"})
     */
    public function createAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $comment = new Comment();
        $post = $this->getDoctrine()
            ->getRepository('BlogPostBundle:Post')
            ->find($id);

        if (!$post) {
            throw $this->createNotFoundException('No post found');
        }

        $form = $this->createForm(new CommentsType(), $comment);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $comment->setUser($this->getUser());
            $comment->setPost($post);
            $em->persist($comment);
            $em->flush();

        } else {

            $this->get('session')->getFlashBag()->add(
                'error',
                'Error posting comment!'
            );
        }

        return $this->redirect($this->generateUrl(
            'show_post',
            array('id' => $id)
        ));
    }
}

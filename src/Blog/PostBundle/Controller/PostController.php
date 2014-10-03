<?php

namespace Blog\PostBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Blog\PostBundle\Entity\Post;
use Blog\CommentsBundle\Entity\Comment;
use Blog\PostBundle\Form\PostType;
use Blog\PostBundle\Entity\PostRepository;
use Blog\CommentsBundle\Entity\CommentRepository;
use Blog\CommentsBundle\Form\CommentsType;

/**
 * @Route("/{_locale}/posts", requirements={"_locale" = "bg|en"})
 */
class PostController extends Controller
{
    /**
     * @Route("/list/{page}", name="show_posts", defaults={"page" = 1})
     * @Method({"GET"})
     * @Template()
     */
    public function listAction($page)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $posts = $em->getRepository('BlogPostBundle:Post')->findAllOrderedByDate();
        
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $posts,
            $this->get('request')->query->get(
                'page',
                $page
            )
        );

        return array('pagination' => $pagination);
    }

    /**
     * @Route("/post/{id}", name="show_post")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function showAction(Request $request, $id)
    {
        $post = $this->getDoctrine()
            ->getRepository('BlogPostBundle:Post')
            ->find($id);

        if (!$post) {
            throw $this->createNotFoundException('No post found');
        }
        
        $comments = $this->getDoctrine()
            ->getRepository('BlogCommentsBundle:Comment')
            ->findByPost($id);
    
        $comment = new Comment();
        $formComment = $this->createForm(new CommentsType(), $comment);
        return array(
            'post' => $post,
            'comments' => $comments,
            'formComment' => $formComment->createView()
            );
    }

    /**
     * @Route("/create", name="create_post")
     * @Method({"POST", "GET"})
     * @Template()
     */
    public function createAction(Request $request)
    {
        $post = new Post();

        $form = $this->createForm(
            new PostType(),
            $post,
            array(
                'em' => $this->getDoctrine()->getManager()
            )
        );
        
        $form->handleRequest($request);

           // var_dump($post);
           // exit;
        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $post->setUser($this->getUser());
            $em->persist($post);
            $em->flush();

            return $this->redirect($this->generateUrl('show_posts'));
        }

        return array('form' => $form->createView());
    }

    /**
     * @Route("/list/tag/{page}/{tagId}", name="tag_post", defaults={"page" = 1})
     * @Method({"GET"})
     * @Template()
     */
    public function tagListAction($page, $tagId)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $posts = $em
            ->getRepository('BlogPostBundle:Post')
            ->findAllByTag($tagId);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $posts,
            $this->get('request')->query->get(
                'page',
                $page
            )
        );

        return array('pagination' => $pagination);
    }

    /**
     * @Route("/user/list/{page}", name="user_posts", defaults={"page" = 1})
     * @Method({"GET"})
     * @Template()
     */
    public function userPostListAction($page)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $posts = $em
            ->getRepository('BlogPostBundle:Post')
            ->findByUser($this->getUser()->getId());

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $posts,
            $this->get('request')->query->get(
                'page',
                $page
            )
        );

        return array('pagination' => $pagination);
    }

    /**
     * @Route("/user/comments/list/{page}", name="user_comments", defaults={"page" = 1})
     * @Method({"GET"})
     * @Template()
     */
    public function userCommentsListAction($page)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $posts = $em
            ->getRepository('BlogPostBundle:Post')
            ->findAll();

        $comments = $em
            ->getRepository('BlogCommentsBundle:Comment')
            ->findByUser($this->getUser()->getId());

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $comments,
            $this->get('request')->query->get(
                'page',
                $page
            ),
            10
        );

        return array('pagination' => $pagination);
    }
}

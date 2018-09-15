<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Comment;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/test", name="test")
     */
    public function test(Request $request)
    {
        $comment = new Comment();
        $comment->setAuthor('Allan');
        $comment->setText('This is my first comment! Yay!');

        $em = $this->getDoctrine()->getManager();

        $em->persist($comment);

        $em->flush();

        return $this->render('default/test.html.twig', [
            "id" => $comment->getId()
        ]);
    }
}

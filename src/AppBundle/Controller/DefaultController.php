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
    public function home(Request $request)
    {
        /*
        // Création d'un commentaire
        $comment = new Comment();
        $comment->setAuthor('Allan');
        $comment->setText('This is my first comment! Yay!');
        
        $em = $this->getDoctrine()->getManager();

        $em->persist($comment);

        $em->flush();
        */

        return $this->render('default/home.html.twig');
    }
}

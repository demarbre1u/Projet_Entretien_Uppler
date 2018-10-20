<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\News;

class ProfileController extends Controller
{
    /**
     * @Route("/profile", name="profile")
     */
    public function test(Request $request)
    {
        /*
        $currentUser = $this->getUser();

        $news = new News();
        $news->setAuthor($currentUser->getUsername());
        $news->setText('This is my first news, leggooo');
        $news->setUser($currentUser); 

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($news);
        $entityManager->flush();
        */
        
        return $this->render('default/profile.html.twig', [
        ]);
    }
}

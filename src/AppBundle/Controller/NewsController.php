<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Form\NewsType;
use AppBundle\Entity\News;

class NewsController extends Controller
{
    /**
     * @Route("/news/create", name="create-news")
     */
    public function createNews(Request $request)
    {
        $currentUser = $this->getUser();
        if(empty($currentUser))
            return $this->redirectToRoute('homepage');

        $news = new News();
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $news->setAuthor($currentUser->getUsername());
            $news->setUser($currentUser);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($news);
            $entityManager->flush();

            return $this->redirectToRoute('profile'); 
        }


        return $this->render('default/news.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

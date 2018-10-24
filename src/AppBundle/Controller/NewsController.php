<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Form\NewsType;
use AppBundle\Form\CommentType;
use AppBundle\Entity\News;
use AppBundle\Entity\Comment;

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

    /**
     * @Route("/news/delete/{id}", name="delete-news")
     */
    public function deleteNews(Request $request, $id) 
    {  
        // Checks if user is authentified
        $currentUser = $this->getUser();
        if(empty($currentUser))
            return $this->redirectToRoute('homepage');

        $news = $this->getDoctrine()
            ->getRepository(News::class)
            ->find($id);

        // Checks if the targeted news is valid
        if(empty($news))
            return $this->redirectToRoute('homepage');

        // Checks if current user owns the news
        if($news->getUser()->getId() !== $currentUser->getId())
            return $this->redirectToRoute('homepage');

        // Deletes the news
        $em = $this->getDoctrine()->getManager();
        $em->remove($news);
        $em->flush();

        return $this->redirectToRoute('profile');
    }

    /**
     * @Route("/news/detail/{id}", name="detail-news")
     */
    public function detailNews(Request $request, $id) 
    {
        // Get the targeted news
        $news = $this->getDoctrine()
            ->getRepository(News::class)
            ->find($id);

        // Checks if the targeted news is valid
        if(empty($news))
            return $this->redirectToRoute('homepage');
            
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

         // Check if a user is logged in
         $currentUser = $this->getUser();

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $comment->setNews($news);

            if( !empty($currentUser) )
                $comment->setUser($currentUser);
    
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();
        }

        $comments = $news->getComments();

        $data = [
            "currentUser" => empty($currentUser) ? null : $currentUser->getId(),
            "news" => $news, 
            "comments" => $comments,
            "form" => $form->createView()
        ];

        // Render shit
        return $this->render('default/news_detail.html.twig', $data);
    }

}

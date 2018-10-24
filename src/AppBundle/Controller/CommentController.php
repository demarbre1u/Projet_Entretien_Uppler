<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Form\NewsType;
use AppBundle\Form\CommentType;
use AppBundle\Entity\News;
use AppBundle\Entity\Comment;

class CommentController extends Controller
{
    /**
     * @Route("/comment/delete/{id}", name="delete-comment")
     */
    public function deleteNews(Request $request, $id) 
    {  
        $referer = $request->headers->get('referer');

        // Checks if user is authentified
        $currentUser = $this->getUser();
        if(empty($currentUser))
            return $this->redirect($referer);

        $comment = $this->getDoctrine()
            ->getRepository(Comment::class)
            ->find($id);

        // Checks if the targeted comment is valid
        if(empty($comment))
            return $this->redirect($referer);

        // Checks if current user owns the news
        if($comment->getUser()->getId() !== $currentUser->getId())
            return $this->redirect($referer);

        // Deletes the news
        $em = $this->getDoctrine()->getManager();
        $em->remove($comment);
        $em->flush();

        return $this->redirect($referer);
    }
}

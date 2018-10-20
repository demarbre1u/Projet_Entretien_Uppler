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
    public function profile(Request $request)
    {
        $currentUser = $this->getUser();
        if(empty($currentUser))
            return $this->redirectToRoute('homepage');
        
        $news = $currentUser->getNews();

        return $this->render('default/profile.html.twig', [
            "news" => $news
        ]);
    }
}

<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\News;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function home(Request $request)
    {        
        $em = $this->getDoctrine()->getManager();
        $qb = $em->createQueryBuilder();

        $qb->select('n')
            ->from(News::class, 'n')
            ->orderBy('n.createdAt', 'DESC')
            ->setMaxResults(3);
        $query = $qb->getQuery();
        $news = $query->getResult();

        //$news = $em->getRepository(News::class)
        //    ->findAll();

        return $this->render('default/home.html.twig', [
            "mostPopular" => empty($news) ? null : $news[0],
            "news" => $news
        ]);
    }
}

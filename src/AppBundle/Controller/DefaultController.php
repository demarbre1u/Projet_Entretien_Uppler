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

        // The most popular news
        $query = $em->createQuery('
            SELECT n.id,
                (
                    SELECT count(c)
                    FROM AppBundle\Entity\Comment c
                    WHERE c.news = n.id
                ) as nb
            FROM AppBundle\Entity\News n
            ORDER BY nb DESC
        ');
        $result = $query->getResult();

        if(count($result) > 0)
        {
            $mostPopular = $em->getRepository(News::class)->find($result[0]['id']);
            dump($mostPopular);
        }   

        // The 3 most recent news
        $qb->select('n')
            ->from(News::class, 'n')
            ->orderBy('n.createdAt', 'DESC')
            ->setMaxResults(3);
        $query = $qb->getQuery();
        $news = $query->getResult();

        //$news = $em->getRepository(News::class)
        //    ->findAll();

        return $this->render('default/home.html.twig', [
            "mostPopular" => empty($mostPopular) ? null : $mostPopular,
            "news" => $news
        ]);
    }
}

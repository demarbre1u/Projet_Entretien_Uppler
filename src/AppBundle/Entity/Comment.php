<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="comment")
 */
class Comment 
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $author;
    
    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\News", inversedBy="comments")
     */
    private $news;
    
    function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->createdAt->setTimezone(new \DateTimeZone('Europe/Paris'));
    }

    function getNews()
    {
        return $this->news;
    }

    function setNews($news)
    {
        $this->news = $news;
    }

    function getId() 
    {
        return $this->id;
    }

    function setId(int $id)
    {
        $this->id = $id;
    }

    function getAuthor() 
    {
        return $this->author;
    }

    function setAuthor(string $author)
    {
        $this->author = $author;
    }

    function getText()
    {
        return $this->text;
    }

    function setText(string $text)
    {
        $this->text = $text;
    }

    function getCreatedAt()
    {
        return $this->createdAt->format('Y-m-d H:i:s');
    }
}
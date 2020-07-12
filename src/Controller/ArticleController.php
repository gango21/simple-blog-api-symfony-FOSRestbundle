<?php

namespace App\Controller;

use App\Entity\Article;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    /**
     * @Get(
     *     path = "/articles/{id}",
     *     name = "app_article_show",
     *     requirements = {"id"="\d+"}
     * )
     * @View
     */
    public function showAction()
    {
        $article = new Article();
        $article->SetTitle('Le titre de mon article');
        $article->setContent('Le contenu de mon article');
        
        return $article;
    }
}
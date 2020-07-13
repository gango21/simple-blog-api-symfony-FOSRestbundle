<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ArticleController extends AbstractFOSRestController
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

    /**
     * @Post(
     *      path = "/articles",
     *      name = "app_article_show"
     * )
     * @View(StatusCode=201)
     * @ParamConverter("article", converter="fos_rest.request_body")
     */
    public function createAction(Article $article, EntityManagerInterface $manager)
    {
        $manager->persist($article);
        $manager->flush();

        return $this->view(
            $article, 
            Response::HTTP_CREATED, 
            ['Location' => $this->generateUrl('app_article_show', ['id' => $article->getId(), UrlGeneratorInterface::ABSOLUTE_URL])]);
    }
}
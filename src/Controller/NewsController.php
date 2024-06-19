<?php

namespace App\Controller;

use App\Repository\NewsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NewsController extends AbstractController
{
    private $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    #[Route('/', name: 'news_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('news/index.html.twig', [
            'collection' => $this->newsRepository->findAll(),
        ]);
    }

    #[Route('/news/{slug}', name: 'news_item', methods: ['GET'])]
    public function item(string $slug): Response
    {
        if (null === $news = $this->newsRepository->findOneBySlug($slug)) {
            throw $this->createNotFoundException();
        }

        return $this->render('news/item.html.twig', ['item' => $news]);
    }
}

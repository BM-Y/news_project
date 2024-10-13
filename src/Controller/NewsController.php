<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{
    #[Route('/news', name: 'news')]
    public function index(): Response
    {
        $client = HttpClient::create();
        
        $response = $client->request('GET', 'https://api.currentsapi.services/v1/latest-news', [
            'query' => [
                'language' => 'fr',  
                'apiKey' => 'your_api_key_here', // Free chez Currents API
            ],
        ]);

        $data = $response->toArray();
        $articles = $data['news']; // Les articles sont dans la clé 'news' de la réponse

        return $this->render('news/index.html.twig', [
            'articles' => $articles,
        ]);
    }
}

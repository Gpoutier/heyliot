<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class TestController extends AbstractController

{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getApi() : array {
        $response = $this->client->request(
            'GET',
            'https://api.thecatapi.com/v1/images/search?limit=10&size=small',
            [
                'headers'=> [
                    'x-api-key'=> '97f2205b-7fd1-4493-b1f2-b8a3f0d2e9cc'
                ]
            ]

        );

        return $response ->toArray();
    }

    /**
     * @Route("/test", name="api_test")
     */
    public function html(): Response
    {
        return $this->render('test.html.twig');
    }

    /**
     * @Route("/", name="api_test")
     */
    public function apiTest(Request $request): Response
    {
        $cat = $this->getApi();

        return $this->render('cat.html.twig', [
            'cat' => $cat
        ]);
    }
}

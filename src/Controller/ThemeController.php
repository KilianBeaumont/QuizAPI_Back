<?php

namespace App\Controller;

use App\Repository\ThemeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ThemeController extends AbstractController
{
    #[Route('/api/themes', name: 'app_theme')]
    public function themes(ThemeRepository $repository, SerializerInterface $serializer): Response
    {
        $themes = $repository->findAll();
        $themeJson = $serializer->serialize($themes,"json",["groups"=>["theme"]]);

        $response = new Response();
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set("content-type","application/json");
        $response->setContent($themeJson);
        return $response;
    }
}

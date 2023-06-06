<?php

namespace App\Controller;

use App\Repository\QuestionRepository;
use App\Repository\ThemeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class QuestionController extends AbstractController
{
    #[Route('/api/{theme}/{nombreQuestions}', name: 'app_api_theme_questions')]
    public function questionsParThemes(QuestionRepository $repository, ThemeRepository $themeRepository, SerializerInterface $serializer, $theme,$nombreQuestions ): Response
    {
        $theme = $themeRepository->findOneBy(["theme"=>$theme]);

            $questions = $repository->findBy(["theme"=>$theme]);
            shuffle($questions);
            $tableauQuestions = array_slice($questions,0,$nombreQuestions); // offset => commence au début du tableau

        if (count($tableauQuestions) < $nombreQuestions || count($tableauQuestions) > $nombreQuestions ) {
            $questionjson = $serializer->serialize("Nombre de questions invalide !","json");
        }elseif ($nombreQuestions == 0) {
            $questionjson = $serializer->serialize("Choisir un nombre de questions au dessus de 0 !","json");
        }
        else{
            $questionjson = $serializer->serialize($tableauQuestions, "json", ["groups" => ["theme", "questions"]]);
        }

            $response = new Response();
            $response->setStatusCode(Response::HTTP_OK);
            $response->headers->set("content-type","application/json");
            $response->setContent($questionjson);


        return $response;
    }
}

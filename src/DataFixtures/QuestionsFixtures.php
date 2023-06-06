<?php

namespace App\DataFixtures;

use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class QuestionsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        $quiz = [
            [
                'question' => 'Quel acteur incarne le personnage de Iron Man dans les films de Marvel ?',
                'choix' => ['Robert Downey Jr', 'Chris Evans', 'Chris Hemsworth', 'Robert Pattinson'],
                'reponse' => 'Robert Downey Jr',
                'theme' => 'Cinéma'
            ],
            [
                'question' => 'Quel est le réalisateur du film "Inception" sorti en 2010 ?',
                'choix' => ['Christopher Nolan', 'Martin Scorsese', 'Quentin Tarantino', 'Steven Spielberg'],
                'reponse' => 'Christopher Nolan',
                'theme' => 'Cinéma'
            ],
            [
                'question' => 'Quel acteur joue le rôle de James Bond dans le film "Casino Royale" sorti en 2006 ?',
                'choix' => ['Daniel Craig', 'Pierce Brosnan', 'Sean Connery', 'Roger Moore'],
                'reponse' => 'Daniel Craig',
                'theme' => 'Cinéma'
            ],
            [
                'question' => 'Quelle est la marque de voiture la plus vendue au monde en 2021 ?',
                'choix' => ['Toyota', 'Volkswagen', 'Ford', 'Honda'],
                'reponse' => 'Toyota',
                'theme' => 'Automobile'
            ],
            [
                'question' => 'Quel constructeur automobile a lancé le modèle "Mustang" en 1964 ?',
                'choix' => ['Ford', 'Chevrolet', 'Dodge', 'Ferrari'],
                'reponse' => 'Ford',
                'theme' => 'Automobile'
            ],
            [
                'question' => 'Quelle est la voiture la plus rapide du monde en 2021 ?',
                'choix' => ['Bugatti Chiron Super Sport 300+', 'Koenigsegg Jesko Absolut', 'Hennessey Venom F5', 'SSC Tuatara'],
                'reponse' => 'Bugatti Chiron Super Sport 300+',
                'theme' => 'Automobile'
            ],
            [
                'question' => 'Qui est le champion du monde poids lourd de boxe en 2021 ?',
                'choix' => ['Anthony Joshua', 'Tyson Fury', 'Deontay Wilder', 'Andy Ruiz Jr'],
                'reponse' => 'Tyson Fury',
                'theme' => 'Combat'
            ],
            [
                'question' => 'Dans quel art martial le pratiquant utilise-t-il ses poings et ses pieds ?',
                'choix' => ['Boxe', 'Judo', 'Karaté', 'Taekwondo'],
                'reponse' => 'Karate',
                'theme' => 'Combat'
            ],
            [
                'question' => 'Quel célèbre combattant de MMA a remporté le championnat des poids légers en UFC en 2021 ?',
        'choix' => ['Conor McGregor', 'Khabib Nurmagomedov', 'Jon Jones', 'Israel Adesanya'],
        'reponse' => 'Charles Oliveira',
        'theme' => 'Combat'
    ],
    [
        'question' => 'Quel est le circuit automobile qui accueille le Grand Prix de Monaco de Formule 1 ?',
        'choix' => ['Monza', 'Silverstone', 'Spa-Francorchamps', 'Monaco'],
        'reponse' => 'Monaco',
        'theme' => 'Course'
    ],
    [
        'question' => 'Quel pilote automobile britannique a remporté le championnat du monde de Formule 1 en 2021 ?',
        'choix' => ['Lewis Hamilton', 'Max Verstappen', 'Valtteri Bottas', 'Sebastian Vettel'],
        'reponse' => 'Lewis Hamilton',
        'theme' => 'Course'
    ],
    [
        'question' => 'Quelle est la course automobile la plus prestigieuse au monde ?',
        'choix' => ['24 Heures du Mans', 'Indianapolis 500', 'Grand Prix de Monaco', 'Daytona 500'],
        'reponse' => '24 Heures du Mans',
        'theme' => 'Course'
    ],
    [
        'question' => 'Quelle est la console de jeux vidéo la plus vendue de tous les temps ?',
        'choix' => ['PlayStation 2', 'Nintendo DS', 'Game Boy', 'Xbox 360'],
        'reponse' => 'PlayStation 2',
        'theme' => 'Jeux vidéos'
    ],
    [
        'question' => 'Quel jeu vidéo a été le plus vendu en 2020 ?',
        'choix' => ['FIFA 21', 'Call of Duty: Black Ops Cold War', 'Minecraft', 'Animal Crossing: New Horizons'],
        'reponse' => 'FIFA 21',
        'theme' => 'Jeux vidéos'
    ],
    [
        'question' => 'Quel est le personnage principal du jeu "The Legend of Zelda" de Nintendo ?',
        'choix' => ['Link', 'Mario', 'Samus Aran', 'Donkey Kong'],
        'reponse' => 'Link',
        'theme' => 'Jeux vidéos'
    ]
];
        foreach ($quiz as $question){
            $Newquestion = new Question();
            $Newquestion->setQuestion($question['question']);
            $Newquestion->setTheme($this->getReference($question['theme']));
            foreach ($question['choix'] as $response){
                $Newresponse = new \App\Entity\Reponse();
                $Newresponse->setIntitule($response);
                $Newresponse->setQuestion($Newquestion);
                if ($response == $question['reponse']){
                    $Newresponse->setEstCorrecte(true);
                } else
                    $Newresponse->setEstCorrecte(false);
                $manager->persist($Newresponse);
            }
            $manager->persist($Newquestion);
        }
        $manager->flush();

    }

    public function getDependencies()
    {
        return[
            ThemeFixtures::class
        ];
    }
};


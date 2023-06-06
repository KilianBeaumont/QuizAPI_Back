<?php

namespace App\DataFixtures;

use App\Entity\Theme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ThemeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $themes = [
            'Cinéma',
            'Automobile',
            'Combat',
            'Course',
            'Jeux vidéos',
        ];

        foreach ($themes as $theme) {
            $newTheme = new Theme();
            $newTheme->setTheme($theme);
            $this->addReference($theme, $newTheme);

            $manager->persist($newTheme);
        }

        $manager->flush();
    }
}
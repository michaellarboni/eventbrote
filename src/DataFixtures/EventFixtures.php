<?php

namespace App\DataFixtures;

use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EventFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $event = [];
        $event['1'] = new Event();
        $event['1']->setName('Symfony Conference');
        $event['1']->setLocation('Marseille, FR');
        $event['1']->setPrice(10);
        $event['1']->setDescription('Best Django conference ever!');
        $event['1']->setStartsAt(new \DateTime('20-02-2021'));

        $event['2'] = new Event();
        $event['2']->setName('Laravel Conference');
        $event['2']->setLocation('Marseille, FR');
        $event['2']->setPrice(15);
        $event['2']->setDescription('Best Django conference ever!');
        $event['2']->setStartsAt(new \DateTime('20-02-2021'));

        $event['3'] = new Event();
        $event['3']->setName('PHP Conference');
        $event['3']->setLocation('Paris, FR');
        $event['3']->setPrice(18);
        $event['3']->setDescription('Best Django conference ever!');
        $event['3']->setStartsAt(new \DateTime('20-02-2021'));

        $event['4'] = new Event();
        $event['4']->setName('Django Conference');
        $event['4']->setLocation('Aix en Provence, FR');
        $event['4']->setPrice(20);
        $event['4']->setDescription('Best Django conference ever!');
        $event['4']->setStartsAt(new \DateTime('20-02-2021'));

        foreach ($event as $value){
            $manager->persist($value);
        }

        $manager->flush();
    }
}

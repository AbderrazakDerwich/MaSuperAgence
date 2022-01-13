<?php

namespace App\DataFixtures;
use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
//use fakerphp\faker\src\Faker\factory;
//use Doctrine\DBAL\Driver\IBMDB2\Exception\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
  
        for ($i = 0; $i < 5; $i++) {
            $property = new Property;
            $property->setTitle('Title ' .$i);
            $property->setDesciption("C'est une maison avec un étage. Au rez-de-chaussée, il y a une chambre, une cuisine, une salle de bains, un salon et une salle à manger. Dans la chambre, il y a un lit, un radiateur, une table de nuit,
             un placard, un bureau et une chaise");
            $property->setSurface(random_int(10,500));
            $property->setBedrooms(random_int(1,6));
            $property->setPrice(random_int(100,1000));
            $property->setHeat($i);
            $property->setCity('Nabeul');
            $property->setAdresse('Rue Taher sfar 3040 Nabeul');
            $property->setPostalCode((string)random_int(3000,6000));
            $property->setSold(0);
            $property->setHeat($i);
            $property->setRooms(random_int(1,5));
            $property->setFloor(random_int(1,5));
            $manager->persist($property);
        }
        $manager->flush();
    }
}

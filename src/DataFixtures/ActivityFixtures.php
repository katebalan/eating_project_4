<?php

namespace App\DataFixtures;

use App\Entity\Activity;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class ActivityFixtures
 * @package App\DataFixtures
 */
class ActivityFixtures extends Fixture
{
    /** @var int $key */
    private $key = 0;

    /** @var int $image_key */
    private $image_key = 0;

    /** @var array $names */
    private $names = [
        'walking',
        'running',
        'gym',
        'yoga',
    ];

    /**
     * Load fixtures
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < count($this->names); $i++) {
            $entity = new Activity();
            $entity->setName($this->getName());
            $entity->setCalories(rand(400, 800));
            $entity->setProteins(rand(0, 30));
            $entity->setFats(rand(0, 30));
            $entity->setCarbohydrates(rand(0, 30));
            $entity->setImage($this->getImage());
            $manager->persist($entity);
        }

        $manager->flush();
    }

    /**
     * @return mixed
     */
    private function getName()
    {
        return ucfirst($this->names[$this->key++]);
    }

    public function getImage()
    {
        return $this->names[$this->image_key++] . ".jpg";
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Product;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class ProductFixtures
 * @package App\DataFixtures
 */
class ProductFixtures extends Fixture
{
    /** @var int $key */
    private $key = 0;

    /** @var int $image_key */
    private $image_key = 0;

    /** @var array $names */
    private $names = [
        'bacon',
        'cheese',
        'eggs',
        'granola',
        'omelet',
        'sausage',
        'slice of bread',
        'slice of toast',
        'hot chocolate',
        'milk',
        'tea',
        'sugar',
        'water',
        'yogurt',
        'chicken',
        'pizza',
        'caesar\'s salad',
        'chef salad',
        'broccoli',
        'apple',
        'banana',
        'cherry',
    ];

    /**
     * Load fixtures
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < count($this->names); $i++) {
            $entity = new Product();
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
     * Get name
     *
     * @return string
     */
    private function getName()
    {
        return ucfirst($this->names[$this->key++]);
    }

    /**
     * Get image
     *
     * @return string
     */
    private function getImage()
    {
        return str_replace(' ', '_', $this->names[$this->image_key++]) . ".jpg";
    }
}

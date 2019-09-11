<?php
declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class Consumption
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"consumption:read"}},
 *     denormalizationContext={"groups"={"consumption:write"}},
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ConsumptionRepository")
 * @ORM\Table(name="consumption")
 */
class Consumption
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Groups({"consumption:read", "consumption:write"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="consumption")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"consumption:read", "consumption:write"})
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Products", inversedBy="consumption")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"consumption:read", "consumption:write"})
     */
    private $product;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"consumption:read", "consumption:write"})
     */
    private $how_much;

    /**
     * @ORM\Column(type="string", name="meals_of_the_day")
     * @Groups({"consumption:read", "consumption:write"})
     */
    private $mealsOfTheDay;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"consumption:read", "consumption:write"})
     */
    private $createdAt;

    /**
     * Magic to string method
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getId();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     * @return mixed
     */
    public function getHowMuch()
    {
        return $this->how_much;
    }

    /**
     * @param mixed $how_much
     */
    public function setHowMuch($how_much)
    {
        $this->how_much = $how_much;
    }

    /**
     * @return mixed
     */
    public function getMealsOfTheDay()
    {
        return $this->mealsOfTheDay;
    }

    /**
     * @param mixed $mealsOfTheDay
     */
    public function setMealsOfTheDay($mealsOfTheDay)
    {
        $this->mealsOfTheDay = $mealsOfTheDay;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

}

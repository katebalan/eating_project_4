<?php
declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use App\Entity\Traits\UpdateTimestampsTrait;
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
 * @ORM\HasLifecycleCallbacks()
 */
class Consumption
{
    use UpdateTimestampsTrait;

    /**
     * Id
     * @var integer $id
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Groups({"consumption:read", "consumption:write"})
     */
    private $id;

    /**
     * User
     * @var User $user
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="consumption")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"consumption:read", "consumption:write"})
     */
    private $user;

    /**
     * Product
     * @var  Products $product
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Products", inversedBy="consumption")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"consumption:read", "consumption:write"})
     */
    private $product;

    /**
     * How much
     * @var integer $howMuch
     *
     * @ORM\Column(type="integer")
     * @Groups({"consumption:read", "consumption:write"})
     */
    private $howMuch;

    /**
     * Meals of the day
     * @var string $mealsOfTheDay
     *
     * @ORM\Column(type="string", name="meals_of_the_day")
     * @Groups({"consumption:read", "consumption:write"})
     */
    private $mealsOfTheDay;

    /**
     * Magic to string method
     *
     * @return string
     */
    public function __toString(): ?string
    {
        return (string) $this->getId();
    }

    /**
     * Get Id
     *
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * Set user
     *
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * Get product
     *
     * @return Products
     */
    public function getProduct(): ?Products
    {
        return $this->product;
    }

    /**
     * Set product
     *
     * @param Products $product
     */
    public function setProduct($product): void
    {
        $this->product = $product;
    }

    /**
     * Get how much
     *
     * @return integer
     */
    public function getHowMuch(): ?int
    {
        return $this->howMuch;
    }

    /**
     * Set how much
     *
     * @param integer $howMuch
     */
    public function setHowMuch($howMuch): void
    {
        $this->howMuch = $howMuch;
    }

    /**
     * Get meals of the day
     *
     * @return string
     */
    public function getMealsOfTheDay(): ?string
    {
        return $this->mealsOfTheDay;
    }

    /**
     * Set meals of the day
     *
     * @param string $mealsOfTheDay
     */
    public function setMealsOfTheDay($mealsOfTheDay): void
    {
        $this->mealsOfTheDay = $mealsOfTheDay;
    }
}

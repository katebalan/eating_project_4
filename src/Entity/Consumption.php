<?php
declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use App\Entity\Traits\TimestampTrait;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class Consumption
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}},
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ConsumptionRepository")
 * @ORM\Table(name="consumption")
 * @ORM\HasLifecycleCallbacks()
 */
class Consumption
{
    use TimestampTrait;

    /**
     * Id
     * @var integer $id
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Groups({"read", "write"})
     */
    private $id;

    /**
     * User
     * @var User $user
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="consumption")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read", "write"})
     */
    private $user;

    /**
     * Product
     * @var  Product $product
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="consumption")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read", "write"})
     */
    private $product;

    /**
     * How much
     * @var integer $amount
     *
     * @ORM\Column(type="integer")
     * @Groups({"read", "write"})
     */
    private $amount;

    /**
     * Meals of the day
     * @var string $mealsOfTheDay
     * @TODO create new entity Period with db translation
     *
     * @ORM\Column(type="string", name="meals_of_the_day")
     * @Groups({"read", "write"})
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
     * @return Product
     */
    public function getProduct(): ?Product
    {
        return $this->product;
    }

    /**
     * Set product
     *
     * @param Product $product
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
    public function getAmount(): ?int
    {
        return $this->amount;
    }

    /**
     * Set how much
     *
     * @param integer $amount
     */
    public function setAmount($amount): void
    {
        $this->amount = $amount;
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

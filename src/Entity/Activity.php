<?php
declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use App\Entity\Traits\CalorieTrait;
use App\Entity\Traits\ImageTrait;
use App\Entity\Traits\TimestampTrait;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Activity
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}},
 * )
 * @ORM\Entity
 * @ORM\Table(name="activity")
 * @ORM\HasLifecycleCallbacks()
 */
class Activity
{
    use TimestampTrait, CalorieTrait, ImageTrait;

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
     * Name
     * @var string $name
     *
     * @ORM\Column(type="string")
     * @Groups({"read", "write"})
     */
    private $name;

    /**
     * Rating
     * @var integer $rating
     *
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"read", "write"})
     */
    private $rating;

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
     * Get id
     *
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * Get rating
     *
     * @return integer
     */
    public function getRating(): ?int
    {
        return $this->rating;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     */
    public function setRating($rating): void
    {
        $this->rating = $rating;
    }
}

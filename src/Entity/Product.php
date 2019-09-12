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
 * Class Products
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ProductsRepository")
 * @ORM\Table(name="product")
 * @ORM\HasLifecycleCallbacks()
 */
class Product
{
    use TimestampTrait, CalorieTrait, ImageTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Groups({"read", "write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Groups({"read", "write"})
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"read", "write"})
     */
    private $rating;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Consumption", mappedBy="product")
     * @Groups({"none"})
     */
    private $consumption;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }
}

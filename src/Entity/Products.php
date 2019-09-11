<?php
declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Products
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"product:read"}},
 *     denormalizationContext={"groups"={"product:write"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ProductsRepository")
 * @ORM\Table(name="products")
 */
class Products
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Groups({"product:read", "product:write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Groups({"product:read", "product:write"})
     */
    private $name;

    /**
     * @ORM\Column(type="integer", name="kkal_per_100gr")
     * @Groups({"product:read", "product:write"})
     */
    private $kkalPer100Gr;

    /**
     * @ORM\Column(type="float", name="proteins_per_100gr")
     * @Groups({"product:read", "product:write"})
     */
    private $proteinsPer100Gr;

    /**
     * @ORM\Column(type="float", name="fats_per_100gr")
     * @Groups({"product:read", "product:write"})
     */
    private $fatsPer100Gr;

    /**
     * @ORM\Column(type="float", name="carbohydrates_per_100gr")
     * @Groups({"product:read", "product:write"})
     */
    private $carbohydratesPer100Gr;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"product:read", "product:write"})
     */
    private $rating;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"product:read", "product:write"})
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Consumption", mappedBy="product")
     * @Groups({"none"})
     */
    private $consumption;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @Assert\File(mimeTypes={ "image/jpg", "image/jpeg", "image/png" })
     * @Groups({"none"})
     */
    private $image;

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
    public function getKkalPer100Gr()
    {
        return $this->kkalPer100Gr;
    }

    /**
     * @param mixed $kkalPer100Gr
     */
    public function setKkalPer100Gr($kkalPer100Gr)
    {
        $this->kkalPer100Gr = $kkalPer100Gr;
    }

    /**
     * @return mixed
     */
    public function getProteinsPer100Gr()
    {
        return $this->proteinsPer100Gr;
    }

    /**
     * @param mixed $proteinsPer100Gr
     */
    public function setProteinsPer100Gr($proteinsPer100Gr)
    {
        $this->proteinsPer100Gr = $proteinsPer100Gr;
    }

    /**
     * @return mixed
     */
    public function getFatsPer100Gr()
    {
        return $this->fatsPer100Gr;
    }

    /**
     * @param mixed $fatsPer100Gr
     */
    public function setFatsPer100Gr($fatsPer100Gr)
    {
        $this->fatsPer100Gr = $fatsPer100Gr;
    }

    /**
     * @return mixed
     */
    public function getCarbohydratesPer100Gr()
    {
        return $this->carbohydratesPer100Gr;
    }

    /**
     * @param mixed $carbohydratesPer100Gr
     */
    public function setCarbohydratesPer100Gr($carbohydratesPer100Gr)
    {
        $this->carbohydratesPer100Gr = $carbohydratesPer100Gr;
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

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }
}

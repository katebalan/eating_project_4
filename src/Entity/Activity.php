<?php
declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Activity
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"activity:read"}},
 *     denormalizationContext={"groups"={"activity:write"}},
 * )
 * @ORM\Entity
 * @ORM\Table(name="activity")
 */
class Activity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Groups({"activity:read", "activity:write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Groups({"activity:read", "activity:write"})
     */
    private $name;

    /**
     * @ORM\Column(type="integer", name="kkal_per_5minutes")
     * @Groups({"activity:read", "activity:write"})
     */
    private $kkalPer5Minutes;

    /**
     * @ORM\Column(type="float", name="proteins_per_5minutes")
     * @Groups({"activity:read", "activity:write"})
     */
    private $proteinsPer5Minutes;

    /**
     * @ORM\Column(type="float", name="fats_per_5minutes")
     * @Groups({"activity:read", "activity:write"})
     */
    private $fatsPer5Minutes;

    /**
     * @ORM\Column(type="float", name="carbohydrates_per_5minutes")
     * @Groups({"activity:read", "activity:write"})
     */
    private $carbohydratesPer5Minutes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"activity:read", "activity:write"})
     */
    private $rating;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"activity:read", "activity:write"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @Assert\File(mimeTypes={ "image/jpg", "image/jpeg", "image/png" })
     * @Groups({"none"})
     */
    private $image;

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
    public function getKkalPer5Minutes()
    {
        return $this->kkalPer5Minutes;
    }

    /**
     * @param mixed $kkalPer5Minutes
     */
    public function setKkalPer5Minutes($kkalPer5Minutes)
    {
        $this->kkalPer5Minutes = $kkalPer5Minutes;
    }

    /**
     * @return mixed
     */
    public function getProteinsPer5Minutes()
    {
        return $this->proteinsPer5Minutes;
    }

    /**
     * @param mixed $proteinsPer5Minutes
     */
    public function setProteinsPer5Minutes($proteinsPer5Minutes)
    {
        $this->proteinsPer5Minutes = $proteinsPer5Minutes;
    }

    /**
     * @return mixed
     */
    public function getFatsPer5Minutes()
    {
        return $this->fatsPer5Minutes;
    }

    /**
     * @param mixed $fatsPer5Minutes
     */
    public function setFatsPer5Minutes($fatsPer5Minutes)
    {
        $this->fatsPer5Minutes = $fatsPer5Minutes;
    }

    /**
     * @return mixed
     */
    public function getCarbohydratesPer5Minutes()
    {
        return $this->carbohydratesPer5Minutes;
    }

    /**
     * @param mixed $carbohydratesPer5Minutes
     */
    public function setCarbohydratesPer5Minutes($carbohydratesPer5Minutes)
    {
        $this->carbohydratesPer5Minutes = $carbohydratesPer5Minutes;
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

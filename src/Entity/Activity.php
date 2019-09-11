<?php
declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use App\Entity\Traits\UpdateTimestampsTrait;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\File;
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
 * @ORM\HasLifecycleCallbacks()
 */
class Activity
{
    use UpdateTimestampsTrait;

    /**
     * Id
     * @var integer $id
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Groups({"activity:read", "activity:write"})
     */
    private $id;

    /**
     * Name
     * @var string $name
     *
     * @ORM\Column(type="string")
     * @Groups({"activity:read", "activity:write"})
     */
    private $name;

    /**
     * Kkal per 5 minutes
     * @var integer $kkalPer5Minutes
     *
     * @ORM\Column(type="integer", name="kkal_per_5minutes")
     * @Groups({"activity:read", "activity:write"})
     */
    private $kkalPer5Minutes;

    /**
     * Proteins per 5 minutes
     * @var float $proteinsPer5Minutes
     *
     * @ORM\Column(type="float", name="proteins_per_5minutes")
     * @Groups({"activity:read", "activity:write"})
     */
    private $proteinsPer5Minutes;

    /**
     * Fats per 5 minutes
     * @var float $fatsPer5Minutes
     *
     * @ORM\Column(type="float", name="fats_per_5minutes")
     * @Groups({"activity:read", "activity:write"})
     */
    private $fatsPer5Minutes;

    /**
     * Carbohydrates per 5 minutes
     * @var float $carbohydratesPer5Minutes
     *
     * @ORM\Column(type="float", name="carbohydrates_per_5minutes")
     * @Groups({"activity:read", "activity:write"})
     */
    private $carbohydratesPer5Minutes;

    /**
     * Rating
     * @var integer $rating
     *
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"activity:read", "activity:write"})
     */
    private $rating;

    /**
     * Image
     * @var File $image
     *
     * @ORM\Column(type="string", nullable=true)
     * @Assert\File(mimeTypes={ "image/jpg", "image/jpeg", "image/png"})
     * @Groups({"none"})
     */
    private $image;

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
     * Get kkal per 5 minutes
     *
     * @return integer
     */
    public function getKkalPer5Minutes(): ?int
    {
        return $this->kkalPer5Minutes;
    }

    /**
     * Set kkal per 5 minutes
     *
     * @param integer $kkalPer5Minutes
     */
    public function setKkalPer5Minutes($kkalPer5Minutes): void
    {
        $this->kkalPer5Minutes = $kkalPer5Minutes;
    }

    /**
     * Get proteins per 5 minutes
     *
     * @return float
     */
    public function getProteinsPer5Minutes(): ?float
    {
        return $this->proteinsPer5Minutes;
    }

    /**
     * Set proteins per 5 minutes
     *
     * @param float $proteinsPer5Minutes
     */
    public function setProteinsPer5Minutes($proteinsPer5Minutes): void
    {
        $this->proteinsPer5Minutes = $proteinsPer5Minutes;
    }

    /**
     * Get fats per 5 minutes
     *
     * @return float
     */
    public function getFatsPer5Minutes(): ?float
    {
        return $this->fatsPer5Minutes;
    }

    /**
     * Set fats per 5 minutes
     *
     * @param float $fatsPer5Minutes
     */
    public function setFatsPer5Minutes($fatsPer5Minutes): void
    {
        $this->fatsPer5Minutes = $fatsPer5Minutes;
    }

    /**
     * Get carbohydrates per 5 minutes
     *
     * @return float
     */
    public function getCarbohydratesPer5Minutes(): ?float
    {
        return $this->carbohydratesPer5Minutes;
    }

    /**
     * Set carbohydrates per 5 minutes
     *
     * @param float $carbohydratesPer5Minutes
     */
    public function setCarbohydratesPer5Minutes($carbohydratesPer5Minutes): void
    {
        $this->carbohydratesPer5Minutes = $carbohydratesPer5Minutes;
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

    /**
     * Get image
     *
     * @return File
     */
    public function getImage(): ?File
    {
        return $this->image;
    }

    /**
     * Set image
     *
     * @param File $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }
}

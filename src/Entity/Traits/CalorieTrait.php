<?php


namespace App\Entity\Traits;


use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Trait CalorieTrait
 * @package App\Entity\Traits
 */
trait CalorieTrait
{
    /**
     * Calories
     * @var integer $calories
     *
     * @ORM\Column(type="integer", name="calories")
     * @Groups({"read", "write"})
     */
    private $calories;

    /**
     * Proteins
     * @var float $proteins
     *
     * @ORM\Column(type="float", name="proteins")
     * @Groups({"read", "write"})
     */
    private $proteins;

    /**
     * Fats
     * @var float $fats
     *
     * @ORM\Column(type="float", name="fats")
     * @Groups({"read", "write"})
     */
    private $fats;

    /**
     * Carbohydrates
     * @var float $carbohydrates
     *
     * @ORM\Column(type="float", name="carbohydrates")
     * @Groups({"read", "write"})
     */
    private $carbohydrates;

    /**
     * Get calories
     *
     * @return integer
     */
    public function getCalories(): ?int
    {
        return $this->calories;
    }

    /**
     * Set calories
     *
     * @param integer $calories
     */
    public function setCalories($calories): void
    {
        $this->calories = $calories;
    }

    /**
     * Get proteins
     *
     * @return float
     */
    public function getProteins(): ?float
    {
        return $this->proteins;
    }

    /**
     * Set proteins
     *
     * @param float $proteins
     */
    public function setProteins($proteins): void
    {
        $this->proteins = $proteins;
    }

    /**
     * Get fats
     *
     * @return float
     */
    public function getFats(): ?float
    {
        return $this->fats;
    }

    /**
     * Set fats
     *
     * @param float $fats
     */
    public function setFats($fats): void
    {
        $this->fats = $fats;
    }

    /**
     * Get carbohydrates
     *
     * @return float
     */
    public function getCarbohydrates(): ?float
    {
        return $this->carbohydrates;
    }

    /**
     * Set carbohydrates
     *
     * @param float $carbohydrates
     */
    public function setCarbohydrates($carbohydrates): void
    {
        $this->carbohydrates = $carbohydrates;
    }
}

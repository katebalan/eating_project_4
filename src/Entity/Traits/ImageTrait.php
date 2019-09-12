<?php


namespace App\Entity\Traits;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait ImageTrait
 * @package App\Entity\Traits
 */
trait ImageTrait
{
    /**
     * Image
     *
     *
     * @ORM\Column(type="string", nullable=true)
     * @Assert\File(mimeTypes={ "image/jpg", "image/jpeg", "image/png"})
     * @Groups({"none"})
     */
    private $image;

    /**
     * Get image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }
}

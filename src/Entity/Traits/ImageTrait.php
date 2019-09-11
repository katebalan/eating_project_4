<?php


namespace App\Entity\Traits;


use Symfony\Component\HttpFoundation\File\File;
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
     * @var File $image
     *
     * @ORM\Column(type="string", nullable=true)
     * @Assert\File(mimeTypes={ "image/jpg", "image/jpeg", "image/png"})
     * @Groups({"none"})
     */
    private $image;

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

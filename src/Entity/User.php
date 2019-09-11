<?php
declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class User
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"user:read"}},
 *     denormalizationContext={"groups"={"user:write"}},
 * )
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @UniqueEntity(fields={"email"}, message="It looks like you already have account!")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Groups({"user:read", "user:write"})
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     * @ORM\Column(type="string", unique=true)
     * @Groups({"user:read", "user:write"})
     */
    private $email;

    /**
     * The encoded password
     *
     * @ORM\Column(type="string", length=64)
     * @Groups({"none"})
     */
    private $password;

    /**
     * A non-persisted field that's used to create the encoded password.
     *
     * @Assert\NotBlank(groups={"Registration"})
     * @Groups({"none"})
     * @var string
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="json_array")
     * @Groups({"user:read", "user:write"})
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"user:read", "user:write"})
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"user:read", "user:write"})
     */
    private $secondName;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"user:read", "user:write"})
     */
    private $age;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"user:read", "user:write"})
     */
    private $gender;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"user:read", "user:write"})
     */
    private $phone;

    /**
     * @ORM\Column(type="float")
     * @Groups({"user:read", "user:write"})
     */
    private $weight;

    /**
     * @ORM\Column(type="float")
     * @Groups({"user:read", "user:write"})
     */
    private $height;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"user:read", "user:write"})
     */
    private $energyExchange;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"user:read", "user:write"})
     */
    private $dailyKkal;

    /**
     * @ORM\Column(type="float")
     * @Groups({"user:read", "user:write"})
     */
    private $dailyProteins;

    /**
     * @ORM\Column(type="float")
     * @Groups({"user:read", "user:write"})
     */
    private $dailyFats;

    /**
     * @ORM\Column(type="float")
     * @Groups({"user:read", "user:write"})
     */
    private $dailyCarbohydrates;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"user:read", "user:write"})
     */
    private $currentKkal = 0;

    /**
     * @ORM\Column(type="float")
     * @Groups({"user:read", "user:write"})
     */
    private $currentProteins = 0;

    /**
     * @ORM\Column(type="float")
     * @Groups({"user:read", "user:write"})
     */
    private $currentFats = 0;

    /**
     * @ORM\Column(type="float")
     * @Groups({"user:read", "user:write"})
     */
    private $currentCarbohydrates = 0;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"user:read", "user:write"})
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Consumption", mappedBy="user")
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
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * Get roles
     *
     * @return array
     */
    public function getRoles()
    {
        $roles = $this->roles;

        // give EVERYONE ROLE_USER
        if(!in_array('ROLE_USER', $roles)) {
            $roles[] = 'ROLE_USER';
        }

        return $roles;
    }

    /**
     * Get password
     *
     * @return string|null
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Gat salt
     *
     * @return string|void|null
     */
    public function getSalt()
    {
        // leaving blank - I don't need/have a password!
    }

    /**
     * Erase credentials
     */
    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    /**
     * Add role
     *
     * @param mixed $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

    /**
     * Get plain password
     *
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * Set plain password
     *
     * @param string $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        $this->password = null;
    }

    /**
     * Set password
     *
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }


    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getSecondName()
    {
        return $this->secondName;
    }

    /**
     * @param string $secondName
     */
    public function setSecondName($secondName)
    {
        $this->secondName = $secondName;
    }

    /**
     * @return integer
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param integer $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return boolean
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param boolean $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param float $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    /**
     * @return float
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param float $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return float
     */
    public function getEnergyExchange()
    {
        return $this->energyExchange;
    }

    /**
     * @param float $energyExchange
     */
    public function setEnergyExchange($energyExchange)
    {
        $this->energyExchange = $energyExchange;
    }

    /**
     * @return mixed
     */
    public function getDailyKkal()
    {
        return $this->dailyKkal;
    }

    /**
     * @param mixed $dailyKkal
     */
    public function setDailyKkal($dailyKkal)
    {
        $this->dailyKkal = $dailyKkal;
    }

    /**
     * @return mixed
     */
    public function getDailyProteins()
    {
        return $this->dailyProteins;
    }

    /**
     * @param mixed $dailyProteins
     */
    public function setDailyProteins($dailyProteins)
    {
        $this->dailyProteins = $dailyProteins;
    }

    /**
     * @return mixed
     */
    public function getDailyFats()
    {
        return $this->dailyFats;
    }

    /**
     * @param mixed $dailyFats
     */
    public function setDailyFats($dailyFats)
    {
        $this->dailyFats = $dailyFats;
    }

    /**
     * @return mixed
     */
    public function getDailyCarbohydrates()
    {
        return $this->dailyCarbohydrates;
    }

    /**
     * @param mixed $dailyCarbohydrates
     */
    public function setDailyCarbohydrates($dailyCarbohydrates)
    {
        $this->dailyCarbohydrates = $dailyCarbohydrates;
    }

    /**
     * @return mixed
     */
    public function getCurrentKkal()
    {
        return $this->currentKkal;
    }

    /**
     * @param mixed $currentKkal
     */
    public function setCurrentKkal($currentKkal)
    {
        $this->currentKkal = $currentKkal;
    }

    /**
     * @return mixed
     */
    public function getCurrentProteins()
    {
        return $this->currentProteins;
    }

    /**
     * @param mixed $currentProteins
     */
    public function setCurrentProteins($currentProteins)
    {
        $this->currentProteins = $currentProteins;
    }

    /**
     * @return mixed
     */
    public function getCurrentFats()
    {
        return $this->currentFats;
    }

    /**
     * @param mixed $currentFats
     */
    public function setCurrentFats($currentFats)
    {
        $this->currentFats = $currentFats;
    }

    /**
     * @return mixed
     */
    public function getCurrentCarbohydrates()
    {
        return $this->currentCarbohydrates;
    }

    /**
     * @param mixed $currentCarbohydrates
     */
    public function setCurrentCarbohydrates($currentCarbohydrates)
    {
        $this->currentCarbohydrates = $currentCarbohydrates;
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

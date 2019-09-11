<?php
declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

use App\Entity\Traits\CalorieTrait;
use App\Entity\Traits\ImageTrait;
use App\Entity\Traits\TimestampTrait;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class User
 *
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}},
 * )
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @UniqueEntity(fields={"email"}, message="It looks like you already have account!")
 * @ORM\HasLifecycleCallbacks()
 */
class User implements UserInterface
{
    use TimestampTrait, ImageTrait;
    // @TODO find the way to use trait twice
    use CalorieTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Groups({"read", "write"})
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     * @ORM\Column(type="string", unique=true)
     * @Groups({"read", "write"})
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
     * @Groups({"read", "write"})
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"read", "write"})
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"read", "write"})
     */
    private $secondName;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read", "write"})
     */
    private $age;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"read", "write"})
     */
    private $gender;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"read", "write"})
     */
    private $phone;

    /**
     * @ORM\Column(type="float")
     * @Groups({"read", "write"})
     */
    private $weight;

    /**
     * @ORM\Column(type="float")
     * @Groups({"read", "write"})
     */
    private $height;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"read", "write"})
     */
    private $energyExchange;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read", "write"})
     */
    private $currentKkal = 0;

    /**
     * @ORM\Column(type="float")
     * @Groups({"read", "write"})
     */
    private $currentProteins = 0;

    /**
     * @ORM\Column(type="float")
     * @Groups({"read", "write"})
     */
    private $currentFats = 0;

    /**
     * @ORM\Column(type="float")
     * @Groups({"read", "write"})
     */
    private $currentCarbohydrates = 0;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Consumption", mappedBy="user")
     * @Groups({"none"})
     */
    private $consumption;

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
}

<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Auction
 *
 * @ORM\Table(name="auction")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AuctionRepository")
 */
class Auction
{
    const STATUS_ACTIVE = "active";
    const STATUS_FINISHED = "finished";
    const STATUS_CANCELLED = "cancelled";


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    //Assert\NotBlank() validacja - nie moze byc puste
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank(
     *      message="Tytuł nie może być pusty"
     * )
     * @Assert\Length(
     *      min=3,
     *      max=255,
     *      minMessage="Tytuł nie może byc krótszy niż 3 znaki!",
     *      maxMessage="Tytuł nie może być dłuższy niż 255 znaków!"
     * )
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     *
     * @Assert\NotBlank(
     *      message="Opis nie może być pusty"
     * )
     * @Assert\Length(
     *      min=10,
     *      minMessage="Opis nie może byc krótszy niż 10 znaków!"
     * )
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2)
     * @Assert\NotBlank(
     *      message="Cena nie może być pusta"
     * )
     * @Assert\GreaterThan(
     *      value="0",
     *      message="Cena musi być większa od zera!"
     * )
     */
    private $price;

    /**
     * @var float
     * @ORM\Column(name="starting_price", type="decimal", precision=10, scale=2)
     * @Assert\NotBlank(
     *      message="Cena wywoławcza nie może być pusta"
     * )
     * @Assert\GreaterThan(
     *      value="0",
     *      message="Cena wywoławcza musi być większa od zera!"
     * )
     */
    private $startingPrice;

    /**
     * @var \DatetTime
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @var \DatetTime
     * @ORM\Column(name="updated_at", type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;


    /**
     * @var \DatetTime
     * @ORM\Column(name="expires_at", type="datetime")
     * @Assert\NotBlank(
     *      message="Musisz podać datę zakończenia aukcji"
     * )
     * @Assert\GreaterThan(
     *      value="+1 day",
     *      message="Aukcja nie może kończyć się za mniej niż 24 godziny"
     * )
     */
    private $expiresAt;

    /**
     * @var string
     * @ORM\Column(name="status", type="string", length=10)
     */
    private $status;

    /**
     * @var Offer[]
     * @ORM\OneToMany(targetEntity="Offer", mappedBy="auction")
     */
    private $offers;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="auctions")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    private $owner;

    /**
     * Auction constructor
     */
    function __construct()
    {
        $this->offers = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Auction
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Auction
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Auction
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $startingPrice
     * @return $this
     */
    public function setStartingPrice($startingPrice)
    {
        $this->startingPrice = $startingPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getStartingPrice()
    {
        return $this->startingPrice;
    }

    /**
     * @param \DateTime $createdAt
     * @return $this;
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreateedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return $this;
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    /**
     * @param \DateTime $expiresAt
     * @return $this;
     */
    public function setExpiresAt(\DateTime $expiresAt)
    {
        $this->expiresAt = $expiresAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return Offer[]|ArrayCollection
     */
    public function getOffers()
    {
        return $this->offers;
    }

    /**
     * @param Offer $offer
     * @return $this
     */
    public function setOffers(Offer $offer)
    {
        $this->offers[] = $offer;

        return $this;
    }


    /**
     * @return User
     */
    public function getOwner()
    {
        return $this->owner;
    }


    /**
     * @param User $owner
     * @return $this
     */
    public function setOwner(User $owner)
    {
        $this->owner = $owner;

        return $this;
    }

}


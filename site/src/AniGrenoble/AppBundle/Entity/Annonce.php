<?php

namespace AniGrenoble\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Annonce
 *
 * @ORM\Table(name="annonce")
 * @ORM\Entity(repositoryClass="AniGrenoble\AppBundle\Repository\AnnonceRepository")
 */
class Annonce
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     * @Assert\Length(
     *      min = 4,
     *      max = 80,
     *      minMessage = "Le titre de l'article doit faire {{ limit }} caractères mini.",
     *      maxMessage = "Le titre de l'article doit faire {{ limit }} caractères maxi."
     * )
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text")
     * @Assert\NotBlank(message="Le contenu ne peux pas être vide.")
     */
    private $contenu;

    /**
     * @var string
     *
     * @ORM\Column(name="auteur", type="string", length=255)
     * @Assert\Length(
     *      min = 2,
     *      max = 30,
     *      minMessage = "Nom de l'auteur doit faire {{ limit }} caractères mini.",
     *      maxMessage = "Nom de l'auteur doit faire {{ limit }} caractères maxi."
     * )
     */
    private $auteur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     * @Assert\DateTime(message="Date non valide.")
     */
    private $date;

    /**
     * @ORM\ManyToMany(targetEntity="AniGrenoble\AppBundle\Entity\Categorie", cascade={"persist"})
     */
    public $categories;

    /**
     * @ORM\OneToOne(targetEntity="AniGrenoble\AppBundle\Entity\Image", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     * @Assert\Valid()
     */
    private $image;

    /**
     * @var bool
     *
     * @ORM\Column(name="publie", type="boolean", nullable=true)
     */
    private $publie;

    public function __construct()
    {
        // Par défaut, la date de l'annonce est la date d'aujourd'hui
        $this->date = new \Datetime();
        $this->categories = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Annonce
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     * @return Annonce
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set auteur
     *
     * @param string $auteur
     * @return Annonce
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * Get auteur
     *
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Annonce
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set publie
     *
     * @param boolean $publie
     * @return Annonce
     */
    public function setPublie($publie)
    {
        $this->publie = $publie;

        return $this;
    }

    /**
     * Get publie
     *
     * @return boolean
     */
    public function getPublie()
    {
        return $this->publie;
    }

    /**
     * Add categories
     *
     * @param \AniGrenoble\AppBundle\Entity\Categorie $categories
     * @return Annonce
     */
    public function addCategory(\AniGrenoble\AppBundle\Entity\Categorie $categories)
    {
        $this->categories[] = $categories;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param \AniGrenoble\AppBundle\Entity\Categorie $categories
     */
    public function removeCategory(\AniGrenoble\AppBundle\Entity\Categorie $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set image
     *
     * @param \AniGrenoble\AppBundle\Entity\Image $image
     * @return Annonce
     */
    public function setImage(\AniGrenoble\AppBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \AniGrenoble\AppBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }
}

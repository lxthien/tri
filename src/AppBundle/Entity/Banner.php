<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Banner
 *
 * @ORM\Table(name="banner")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BannerRepository")
 * @Vich\Uploadable
 */

class Banner
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
     * @var AppBundle\Entity\BannerCategory;
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\BannerCategory", inversedBy="banner")
     * @ORM\JoinColumn(name="bannercategory_id", referencedColumnName="id")
     */
    private $bannercategory;

    /**
     * @var int
     *
     * @ORM\Column(name="position", type="integer", nullable=true)
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255, nullable=true)
     */
    private $alt;

    /**
     * @var string
     *
     * @ORM\Column(name="caption", type="text", nullable=true)
     */
    private $caption;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="urlImage", type="string", length=255, nullable=true)
     */
    private $urlImage;

    /**
     * @Vich\UploadableField(mapping="banner_images", fileNameProperty="urlImage")
     * @var File
     */
    private $imageFile;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="createdAt", type="datetime") 
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setBannerCategory(\AppBundle\Entity\BannerCategory $bannercategory)
    {
        $this->bannercategory = $bannercategory;

        return $this;
    }

    public function getBannerCategory()
    {
        return $this->bannercategory;
    }

    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    public function getAlt()
    {
        return $this->alt;
    }

    public function setCaption($caption)
    {
        $this->caption = $caption;

        return $this;
    }

    public function getCaption()
    {
        return $this->caption;
    }

    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrlImage($urlImage)
    {
        $this->urlImage = $urlImage;

        return $this;
    }

    public function getUrlImage()
    {
        return $this->urlImage;
    }

    public function setImageFile(File $urlImage = null)
    {
        $this->imageFile = $urlImage;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($urlImage) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setcreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}

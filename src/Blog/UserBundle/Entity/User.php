<?php

namespace Blog\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @Vich\Uploadable
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

     /**
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="imageName")
     * @var File $file
     */
    public $file;

    /**
     * @ORM\Column(type="string", length=255, name="image_name")
     *
     * @var string $imageName
     */
    protected $imageName;

    public function __construct()
    {
        parent::__construct();
        $this->imageName = 'name';
        // your own logic
    }

    /**
     * @param string $imageName
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }

    /**
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Sets file.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\File $file
     */
    public function setFile(File $file)
    {
        $this->file = $file;

        if ($file) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * Get file.
     *
     * @return File
     */
    public function getFile()
    {
        return $this->file;
    }
}

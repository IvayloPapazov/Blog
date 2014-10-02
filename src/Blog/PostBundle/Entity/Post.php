<?php

namespace Blog\PostBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="Blog\PostBundle\Entity\PostRepository")
 * @Vich\Uploadable
 */
class Post
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="\Blog\UserBundle\Entity\User")
     */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\Length(
     *      min = "4",
     *      max = "150",
     *      minMessage = "post.title.minLength",
     *      maxMessage = "post.title.maxLength"
     * )
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     * @Assert\Length(
     *      min = "10",
     *      minMessage = "post.content.message"
     * )
     */
    private $content;

    /**
     * @ORM\ManyToMany(targetEntity="\Blog\PostBundle\Entity\Tag", cascade={"persist"})
     */
    private $tags;

    /**
     * @ORM\OneToMany(targetEntity="\Blog\CommentsBundle\Entity\Comment", mappedBy="post")
     */
    private $comments;

    /**
     * @var integer
     *
     * @ORM\Column(name="commentsCount", type="integer")
     * @Assert\Type(type="integer", message="The value {{ value }} is not a valid {{ type }}.")
     */
    private $commentsCount;

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
        $this->date = new \DateTime();
        // $this->user = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->commentsCount = 0;
        $this->imageName = 'image';
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

    public function setId($id)
    {
        $this->id = $id;
    }

    // /**
    //  * Add user
    //  *
    //  * @param \Blog\UserBundle\Entity\User $user
    //  * @return Post
    //  */
    // public function addUser(\Blog\UserBundle\Entity\User $user)
    // {
    //     $this->user[] = $user;

    //     return $this;
    // }

    /**
     * Get user
     *
     * @return integer
     */
    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * Add comment
     *
     * @param  \Blog\CommentsBundle\Entity\Comment $comment
     * @return Post
     */
    public function addComment(\Blog\CommentsBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Add tags
     *
     * @param  \Blog\PostBundle\Entity\Tags $tags
     * @return Post
     */
    public function addTag(\Blog\PostBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set tag
     *
     * @param  string $tag
     * @return Post
     */
    public function setTags(ArrayCollection $tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Set title
     *
     * @param  string $title
     * @return Post
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
     * Set content
     *
     * @param  string $content
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set commentsCount
     *
     * @param  integer $commentsCount
     * @return Post
     */
    public function setCommentsCount($commentsCount)
    {
        $this->commentsCount = $commentsCount;

        return $this;
    }

    /**
     * Get commentsCount
     *
     * @return integer
     */
    public function getCommentsCount()
    {
        return $this->commentsCount;
    }

    /**
     * Set date
     *
     * @param  \DateTime $date
     * @return Post
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
     * Sets file.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\File $file
     */
    public function setFile(File $file)
    {
        $this->file = $file;
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
}

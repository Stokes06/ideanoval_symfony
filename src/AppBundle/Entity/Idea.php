<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * Class Idea
 * @package AppBundle\Entity
 * @ORM\Entity()
 */
class Idea{
  use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @ORM\Column(type="string")
     */
    protected $title;

    /**
     * @ORM\Column(type="integer", name="like_number")
     */
    protected $like;
    /**
     * @ORM\Column(type="integer", name="dislike_number")
     */
    protected $dislike;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category")
     */
    protected $category;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="ideas")
     */
    protected $author;

    public function __construct(string $title)
    {
        $this->title = $title;
        $this->like = mt_rand(0,1000);
        $this->dislike = mt_rand(0,1000);
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title.
     *
     * @param string $title
     *
     * @return Idea
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set like.
     *
     * @param int $like
     *
     * @return Idea
     */
    public function setLike($like)
    {
        $this->like = $like;

        return $this;
    }

    /**
     * Get like.
     *
     * @return int
     */
    public function getLike()
    {
        return $this->like;
    }

    /**
     * Set dislike.
     *
     * @param int $dislike
     *
     * @return Idea
     */
    public function setDislike($dislike)
    {
        $this->dislike = $dislike;

        return $this;
    }

    /**
     * Get dislike.
     *
     * @return int
     */
    public function getDislike()
    {
        return $this->dislike;
    }

    /**
     * Set category.
     *
     * @param \AppBundle\Entity\Category|null $category
     *
     * @return Idea
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category.
     *
     * @return \AppBundle\Entity\Category|null
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set author.
     *
     * @param \AppBundle\Entity\User|null $author
     *
     * @return Idea
     */
    public function setAuthor(\AppBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author.
     *
     * @return \AppBundle\Entity\User|null
     */
    public function getAuthor()
    {
        return $this->author;
    }
}

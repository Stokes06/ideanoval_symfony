<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Vote
 * @package AppBundle\Entity
 * @ORM\Entity()
 */
class Vote{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    protected $user;
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Idea")
     */
    protected $idea;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $liked;

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
     * Set liked.
     *
     * @param bool $liked
     *
     * @return Vote
     */
    public function setLiked($liked)
    {
        $this->liked = $liked;

        return $this;
    }

    /**
     * Get liked.
     *
     * @return bool
     */
    public function getLiked()
    {
        return $this->liked;
    }

    /**
     * Set user.
     *
     * @param \AppBundle\Entity\User|null $user
     *
     * @return Vote
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \AppBundle\Entity\User|null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set idea.
     *
     * @param \AppBundle\Entity\Idea|null $idea
     *
     * @return Vote
     */
    public function setIdea(\AppBundle\Entity\Idea $idea = null)
    {
        $this->idea = $idea;

        return $this;
    }

    /**
     * Get idea.
     *
     * @return \AppBundle\Entity\Idea|null
     */
    public function getIdea()
    {
        return $this->idea;
    }
}

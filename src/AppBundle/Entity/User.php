<?php
namespace AppBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * Class User
 * @package AppBundle\Entity
 * @ORM\Entity()
 */
class User extends BaseUser{
    use TimestampableEntity;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Idea",mappedBy="author")
     */
    protected $ideas;
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Add idea.
     *
     * @param \AppBundle\Entity\Idea $idea
     *
     * @return User
     */
    public function addIdea(\AppBundle\Entity\Idea $idea)
    {
        $this->ideas[] = $idea;

        return $this;
    }

    /**
     * Remove idea.
     *
     * @param \AppBundle\Entity\Idea $idea
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeIdea(\AppBundle\Entity\Idea $idea)
    {
        return $this->ideas->removeElement($idea);
    }

    /**
     * Get ideas.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdeas()
    {
        return $this->ideas;
    }
}

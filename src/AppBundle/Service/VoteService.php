<?php
/**
 * Created by PhpStorm.
 * User: HB1
 * Date: 17/02/2018
 * Time: 20:16
 */

namespace AppBundle\Service;


use AppBundle\Entity\Idea;
use AppBundle\Entity\User;
use AppBundle\Entity\Vote;
use AppBundle\Service\IdeaService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class VoteService
{
    /**
     * @var IdeaService
     */
    private $ideaService;
    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, IdeaService $ideaService)
    {
        $this->ideaService = $ideaService;
        $this->entityManager = $entityManager;
    }



    /**
     * @param Idea $idea
     * @param User|null $user
     * @return Vote
     */
    public function previousVote(Idea $idea, ?User $user){
        if($user === null) return null;
        $res =  $this->entityManager
                        ->createQuery("select v from AppBundle\Entity\Vote v JOIN v.user u join v.idea i
            where u.id= ?1 and i.id = ?2")
                ->setParameter(1, $user->getId())
                ->setParameter(2, $idea->getId())
                ->execute();
        return !empty($res) ? $res[0] : null;
    }

    public function isPreviousVote(Idea $idea, ?User $user, bool $choice){
        $vote = $this->previousVote($idea, $user);
        return $vote ? $vote->getLiked() === $choice : false;
    }

    /**
     * Vote de manière unique
     *
     * @param Idea $ideaId
     * @param User $user
     * @param bool $liked
     */
    public function vote(Idea $ideaId, User $user, bool $liked)
    {
        $idea = $this->ideaService->getById($ideaId);
        $previousVote =  $this->previousVote($idea, $user);

        if($previousVote){
            $this->cancelVote($previousVote);
            if($previousVote->getLiked() === $liked){
                $this->entityManager->remove($previousVote);
                $this->entityManager->flush();
                return;
            }
            $previousVote->setLiked($liked);
            $this->entityManager->persist($previousVote);
        }else{
            $vote = (new Vote())->setIdea($idea)
                ->setUser($user)
                ->setLiked($liked);
            $this->entityManager->persist($vote);
        }
        if ($liked)
            $idea->setLike($idea->getLike() + 1);
        else
            $idea->setDislike($idea->getDislike() + 1);

        $this->entityManager->persist($idea);
        $this->entityManager->flush();
    }

    /**
     * @param Vote $vote
     */
    private function cancelVote(Vote $vote=null){
        if(!$vote) return;

        $liked = $vote->getLiked();
        $idea = $vote->getIdea();
        if($liked){
            $idea->setLike($idea->getLike() - 1);
        }else{
            $idea->setDislike($idea->getDislike() - 1);
        }
        $this->entityManager->persist($idea);
        $this->entityManager->flush();
    }
}
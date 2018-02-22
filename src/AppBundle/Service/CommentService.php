<?php
/**
 * Created by PhpStorm.
 * User: HB1
 * Date: 23/02/2018
 * Time: 00:15
 */

namespace AppBundle\Service;


use AppBundle\Entity\Comment;
use Doctrine\ORM\EntityManagerInterface;

class CommentService
{
    protected $em;
    protected $repo;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repo = $this->em->getRepository('AppBundle:Comment');
    }

    public function getCommentsByIdea($id) {
        $comments = $this->repo->findByIdea($id);
        return $comments;
    }

    public function postComment(Comment $comment) {
        $this->em->persist($comment);
        $this->em->flush();
    }

}
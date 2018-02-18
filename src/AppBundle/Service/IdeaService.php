<?php
namespace AppBundle\Service;

use Doctrine\ORM\EntityManagerInterface;

class IdeaService{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getAll(){

        return $this->em->getRepository('AppBundle:Idea')->findAll();
    }

    public function getAllOrderByNumberOfVote(){
        return $this->em->createQuery("select i from AppBundle\Entity\Idea i  
          order by i.like + i.dislike desc ")
            ->getResult();
    }

    public function getById($ideaId)
    {
        return $this->em->getRepository('AppBundle:Idea')->find($ideaId);
    }
}
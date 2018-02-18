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

    public function getById($ideaId)
    {
        return $this->em->getRepository('AppBundle:Idea')->find($ideaId);
    }
}
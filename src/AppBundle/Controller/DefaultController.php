<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Idea;
use AppBundle\Service\IdeaService;
use AppBundle\Service\VoteService;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
       return $this->redirectToRoute('ideas');
    }

    /**
     * @Route("/test")
     */
    public function test(VoteService $voteService, IdeaService $ideaService){

        dump($voteService->vote($ideaService->getById(35), $this->getUser(), true));die;
    }
}

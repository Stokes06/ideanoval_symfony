<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Idea;
use AppBundle\Service\IdeaService;
use AppBundle\Service\VoteService;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IdeaController extends Controller
{
    public function indexAction(IdeaService $ideaService)
    {
        /** @var Idea[] $ideas */
        $ideas = $ideaService->getAllOrderByNumberOfVote();
        return $this->render('@App/ideas.html.twig', compact("ideas"));
    }

    /**
     * @param EntityManagerInterface $em
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/ideas/generate")
     */
    public function generate(EntityManagerInterface $em)
    {

        $em->persist(new Idea("idea_" . mt_rand(1, 1000)));
        $em->persist(new Idea("idea_" . mt_rand(1, 1000)));
        $em->persist(new Idea("idea_" . mt_rand(1, 1000)));
        $em->persist(new Idea("idea_" . mt_rand(1, 1000)));
        $em->persist(new Idea("idea_" . mt_rand(1, 1000)));
        $em->persist(new Idea("idea_" . mt_rand(1, 1000)));
        $em->persist(new Idea("idea_" . mt_rand(1, 1000)));
        $em->persist(new Idea("idea_" . mt_rand(1, 1000)));
        $em->persist(new Idea("idea_" . mt_rand(1, 1000)));
        $em->persist(new Idea("idea_" . mt_rand(1, 1000)));
        $em->persist(new Idea("idea_" . mt_rand(1, 1000)));
        $em->flush();

        return $this->redirectToRoute('ideas');
    }

    /**
     * @param Request $request
     * @param VoteService $voteService
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/ideas/vote", name="vote")
     */
    public function voteAction(Request $request, IdeaService $ideaService, VoteService $voteService)
    {
        if (!$this->isGranted("IS_AUTHENTICATED_FULLY")) {
            $this->addFlash('danger', 'Vous devez être connecté pour pouvoir voter');
            return $this->redirectToRoute('ideas');
        }
        $id = $request->get('idea_id');
        $idea = $ideaService->getById($id);
        $liked = null !== $request->get('like');
        $voteService->vote($idea, $this->getUser(), $liked);
        return $this->redirectToRoute('ideas');
    }
}

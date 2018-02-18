<?php

namespace AppBundle\Twig\Extension;

use AppBundle\Service\VoteService;

class VoteExtension extends \Twig_Extension
{
    /**
     * @var VoteService
     */
    private $voteService;

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'vote';
    }

    public function __construct(VoteService $voteService)
    {
        $this->voteService = $voteService;
    }

    public function getFunctions()
    {
        return [
           new \Twig_SimpleFunction('previousVote', [$this->voteService, "isPreviousVote"]),
        ];
    }
}

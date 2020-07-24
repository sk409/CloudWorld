<?php

namespace App\UseCases\Git;

use App\Core\Git\Git;

class GitReceivePackUseCaseCore implements GitReceivePackUseCaseInputInterface
{

    private $git;
    private $presenter;

    public function __construct(GitUploadPackUseCaseOutputInterface $presenter)
    {
        $this->git = new Git(
            config("git.binPath"),
            config("git.repoDir"),
            config("os.pathDelimiter")
        );
        $this->presenter = $presenter;
    }

    public function execute(string $repoPath, string ...$options): string
    {
        return $this->presenter->present($this->git->receivePack($repoPath, ...$options));
    }

    public function getGit(): Git
    {
        return $this->git;
    }
}

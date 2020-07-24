<?php

namespace App\UseCases\Git;

use App\Core\Git\Git;

interface GitReceivePackUseCaseInputInterface
{
    public function execute(string $repoPath, string ...$options): string;
    public function getGit(): Git;
}

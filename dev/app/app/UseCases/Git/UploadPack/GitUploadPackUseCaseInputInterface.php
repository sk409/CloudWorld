<?php

namespace App\UseCases\Git;

use App\Core\Git\Git;

interface GitUploadPackUseCaseInputInterface
{
    function execute(string $repoPath, string ...$options): string;
    function getGit(): Git;
}

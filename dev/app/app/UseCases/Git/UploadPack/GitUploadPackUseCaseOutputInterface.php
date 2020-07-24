<?php

namespace App\UseCases\Git;

interface GitUploadPackUseCaseOutputInterface
{
    public function present(string $output): string;
}

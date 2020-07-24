<?php

namespace App\UseCases\Git;

class GitUploadPackUseCasePresenter implements GitUploadPackUseCaseOutputInterface
{

    public function present(string $output): string
    {
        return $output;
    }
}

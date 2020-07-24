<?php

namespace App\UseCases\Git;

class GitReceivePackUseCasePresenter implements GitReceivePackUseCaseOutputInterface
{
    public function present(string $output): string
    {
        return $output;
    }
}

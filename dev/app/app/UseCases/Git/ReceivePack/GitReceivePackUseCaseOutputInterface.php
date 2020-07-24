<?php

namespace App\UseCases\Git;

interface GitReceivePackUseCaseOutputInterface
{
    function present(string $output): string;
}

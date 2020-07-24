<?php

namespace App\Services;

interface FilePathServiceInterface
{
    function join(string ...$components): string;
}

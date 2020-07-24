<?php

namespace App\Services;

class FilePathService implements FilePathServiceInterface
{
    public function join(string ...$components): string
    {
        return implode("/", $components);
    }
}

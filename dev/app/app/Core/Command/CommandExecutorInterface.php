<?php

namespace App\Core\Command;

interface CommandExecutorInterface
{
    function execute(string ...$args): string;
}

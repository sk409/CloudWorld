<?php

namespace App\Core\Command;

class CommandExecutor implements CommandExecutorInterface
{

    public function execute(string ...$args): string
    {
        $command = implode(" ", $args);
        exec($command, $output);
        return implode("\n", $output);
    }
}

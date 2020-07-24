<?php

namespace App\Core\Git;

use App\Core\Command\CommandExecutor;
use App\Core\Command\CommandExecutorInterface;

class Git
{

    private $commandExecutor;
    private $gitBinPath;
    private $repoDir;
    private $osPathDelimiter;

    public function __construct(string $gitBinPath, string $repoDir, string $osPathDelimiter)
    {
        $this->commandExecutor = new CommandExecutor();
        $this->gitBinPath = $gitBinPath;
        $this->repoDir = $repoDir;
        $this->osPathDelimiter = $osPathDelimiter;
    }

    public function receivePack(string $repoPath, string ...$options): string
    {
        return $this->execute("receive-pack", $repoPath, ...$options);
    }

    public function uploadPack(string $repoPath, string ...$options): string
    {
        return $this->execute("upload-pack", $repoPath, ...$options);
    }

    public function getCommandExecutor(): CommandExecutorInterface
    {
        return $this->commandExecutor;
    }

    public function setCommandExecutor(CommandExecutorInterface $commandExecutor)
    {
        $this->commandExecutor = $commandExecutor;
    }

    private function execute(string $subcommand, string $repoPath, string ...$options): string
    {
        $fullRepoPath = $this->repoDir . $this->osPathDelimiter . $repoPath;
        $args = array_merge([$this->gitBinPath, $subcommand], $options, [$fullRepoPath]);
        return $this->commandExecutor->execute(...$args);
    }
}

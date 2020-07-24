<?php

namespace App\InterfaceAdapters\Controllers\Git;

use App\Core\Command\CommandStreamExecutor;
use App\InterfaceAdapters\Controllers\Controller;
use App\Services\FilePathServiceInterface;
use App\UseCases\Git\GitReceivePackUseCaseInputInterface;
use App\UseCases\Git\GitUploadPackUseCaseInputInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GitController extends Controller
{

    private $filePathService;
    private $gitReceivePackUseCase;
    private $gitUploadPackUseCase;

    public function __construct(
        FilePathServiceInterface $filePathService,
        GitReceivePackUseCaseInputInterface $gitReceivePackUseCase,
        GitUploadPackUseCaseInputInterface $gitUploadPackUseCase
    ) {
        $this->filePathService = $filePathService;
        $this->gitReceivePackUseCase = $gitReceivePackUseCase;
        $this->gitUploadPackUseCase = $gitUploadPackUseCase;
    }

    public function refs(Request $request, string $account, string $project)
    {
        $repoPath = $this->filePathService->join($account, $project);
        if ($request->service === "git-receive-pack") {
            $output = "001f# service=git-receive-pack\n";
            $output .= "0000";
            $output .= $this->gitReceivePackUseCase->execute($repoPath, "--advertise-refs");
            return response($output)->withHeaders([
                "Content-Type" => "application/x-git-receive-pack-advertisement"
            ]);
        } else if ($request->service === "git-upload-pack") {
            $output = "001e# service=git-upload-pack\n";
            $output .= "0000";
            $output .= $this->gitUploadPackUseCase->execute($repoPath, "--advertise-refs");
            return response($output)->withHeaders([
                "Content-Type" => "application/x-git-upload-pack-advertisement"
            ]);
        }
        return response("", Response::HTTP_BAD_REQUEST);
    }

    public function receivePack(Request $request, string $account, string $project)
    {
        $repoPath = $this->filePathService->join($account, $project);
        $commandExecutor = new CommandStreamExecutor($request->getContent());
        $this->gitReceivePackUseCase->getGit()->setCommandExecutor($commandExecutor);
        $output = $this->gitReceivePackUseCase->execute($repoPath, "--stateless-rpc");
        return response($output)
            ->header("Content-Type", "application/x-git-receive-pack-result");
    }

    public function uploadPack(Request $request, string $account, string $project)
    {
        $repoPath = $this->filePathService->join($account, $project);
        $commandExecutor = new CommandStreamExecutor($request->getContent());
        $this->gitUploadPackUseCase->getGit()->setCommandExecutor($commandExecutor);
        $output = $this->gitUploadPackUseCase->execute($repoPath, "--stateless-rpc");
        return response($output)
            ->header("Content-Type", "application/x-git-upload-pack-result");
    }
}

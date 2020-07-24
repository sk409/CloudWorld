<?php

namespace App\Core\Command;

class CommandStreamExecutor implements CommandExecutorInterface
{

    private $input;

    public function __construct(string $input = "")
    {
        $this->input = $input;
    }

    public function execute(string ...$args): string
    {
        $descriptorspec = array(
            0 => array("pipe", "r"),
            1 => array("pipe", "w"),
            2 => array("file", "/tmp/error-output.txt", "a") // はファイルで、そこに書き込みます。
        );

        $cwd = '/tmp';

        $command = implode(" ", $args);
        $process = proc_open($command, $descriptorspec, $pipes, $cwd);

        if (is_resource($process)) {

            // $body = $request->getContent();
            fwrite($pipes[0], $this->input);
            fclose($pipes[0]);

            $output = stream_get_contents($pipes[1]);
            fclose($pipes[1]);

            proc_close($process);
            return $output;

            // return response($output)
            // ->header("Content-Type", "application/x-git-upload-pack-result");
        }
        return "";
    }

    public function getInput(): string
    {
        return $this->input;
    }

    public function setInput(string $input)
    {
        $this->input = $input;
    }
}

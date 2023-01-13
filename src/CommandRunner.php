<?php
declare(strict_types=1);
namespace Dk\TestworkLenvendo;

Class CommandRunner {
    private array $argv;
    private $commands = [];
    function __construct(array $argv) {
        $this->argv = $argv;
    }

    function run() {
        $argv = [...$this->argv];
        array_shift($argv);
        $commandName = array_shift($argv);
        $params = preg_grep("/\[.*\]/", $argv);
        $commandArgs = preg_grep("/{.*}/", $argv);
        $commandArgs = [...array_diff_key($argv, $params, $commandArgs), ...$commandArgs];

        if (!$commandName) {
            $this->help();
            exit();
        }


        if (!array_key_exists($commandName, $this->commands)) {
            echo "command [$commandName] is not registred:" . PHP_EOL ;
            $this->help();
            exit();
        }

        $cmdParams = [];

        foreach($params as $p) {
            $p = trim($p, '[]');
            [$param, $value] = explode('=', $p);
            if (!array_key_exists($param, $cmdParams)) {
                $cmdParams[$param] = [];
            }
            $cmdParams[$param][] = $value;
        }

        $cmdArgs = array_map(function ($c) {
            $c = trim($c, '{}');
            return $c;
        }, $commandArgs);

        if (array_search('help', $cmdArgs) !== false) {
            $this->commands[$commandName]->help();
            exit();    
        }

        $this->commands[$commandName]->run($cmdArgs, $cmdParams);
    }

    function register(ACommand $command) {
        $this->commands[$command->name] = $command;
        return $this;
    }

    function help() {
        echo "available commands:" . PHP_EOL;
        foreach($this->commands as $command) {
            echo "{$command->name} -> {$command->description}" . PHP_EOL;
        }
    } 
}
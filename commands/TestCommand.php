<?php
namespace My\Commands;
use Dk\TestworkLenvendo\ACommand;
class TestCommand extends ACommand {
    public $name = 'test';
    public $description = 'is test command, print info';
    function run($args, $opts) {
        echo <<<INFO
called command: {$this->name}

arguments:
{$this->args($args)}

options:
{$this->opts($opts)}

INFO;
    }

    function args($args) {
        $str = [];
        foreach($args as $a) {
            $str[] = str_pad("", 4, ' ', STR_PAD_LEFT) . "- {$a}";
        }
        return implode(PHP_EOL,$str);
    }

    function opts($opts) {
        $str = [];
        foreach($opts as $name => $value) {
            $str[] = str_pad("", 4, ' ', STR_PAD_LEFT) . "- {$name}";
            foreach ($value as $v) {
                $str[] = str_pad("", 8, ' ', STR_PAD_LEFT) . "- {$v}";
            }
        }
        return implode(PHP_EOL,$str);
    }
}
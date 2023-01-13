<?php
namespace Dk\TestworkLenvendo;

/**
 * @description Тест
 */
abstract class ACommand {
    public $name = 'abstract';
    public $description = 'abstract';
    abstract function run(array $args, array $props);

    final function help() {
        echo  $this->description . PHP_EOL;
    }
}
<?php
/*
 * 純粋なbrainfuck
 */
require __DIR__ . '/../vendor/autoload.php';
use Polidog\Brainfuck\Memory;
use Polidog\Brainfuck\Interpreter;

$memory = new Memory();
$memory->init(100);

$brainfuck = new Interpreter(__DIR__);
$brainfuck->setMemory($memory);


if (isset($argv[1])) {
	$brainfuck->setFile($argv[1]);
}
else {
	$brainfuck->setCommand();
}

$brainfuck->exec();
echo "\n";
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
	$brainfuck->inputFile($argv[1]);
}
else {
	$brainfuck->inputCommand();
}

$brainfuck->exec();
<?php
/*
 * うーにゃー言語
 * 仕様自体はここからいただいてきました(・ω<)
 * http://kissaten-no-heya.blogspot.jp/2012/04/blog-post_8719.html
 */
require __DIR__ . '/../vendor/autoload.php';

/**
 * オブジェクト生成用のクロージャ
 */
$c = function($class,$params = null) {
	$class = 'Polidog\\Brainfuck\\'.$class;
	return new $class($params);
};

$brainfuck = $c('Interpreter',__DIR__)->setMemory($c('Memory')->init(100))->setReplaceCommand([
	'(」・ω・)」うー(／・ω・)／にゃー' => '>',
	'(」・ω・)」うー!!(／・ω・)／にゃー!!' => '<',
	'(」・ω・)」うー!(／・ω・)／にゃー!' => '+',
	'(」・ω・)」うー!!!(／・ω・)／にゃー!!!' => '-',
	"Let's＼(・ω・)／にゃー" => '.',
	'cosmic!' => ',',
	'CHAOS☆CHAOS!' => '[',
	'I WANNA CHAOS!' => ']',	
]);

if (isset($argv[1])) {
	$brainfuck->inputFile($argv[1]);
}
else {
	$brainfuck->inputCommand();
}

$brainfuck->exec();
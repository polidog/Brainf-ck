<?php
/*
 * brainfuckから他言語への変換用サンプル
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

// KQに変換
echo $brainfuck->convert([
	'ﾀﾞｧｲｪｽ' => '>',
	'ｲｪｽﾀﾞｧ' => '<',
	'ﾀﾞｧﾀﾞｧ' => '+',
	'ｼｴﾘｼｴﾘ' => '-',
	"ｼｴﾘﾀﾞｧ" => '.',
	'ﾀﾞｧｼｴﾘ' => ',',
	'ｼｴﾘｲｪｽ' => '[',
	'ｲｪｽｼｴﾘ' => ']',		
]);

// ニャルらとホテブ言語
// KQに変換
echo $brainfuck->convert([
	'(」・ω・)」うー(／・ω・)／にゃー'			=> '>',
	'(」・ω・)」うー!!(／・ω・)／にゃー!!'		=> '<',
	'(」・ω・)」うー!(／・ω・)／にゃー!'		=> '+',
	'(」・ω・)」うー!!!(／・ω・)／にゃー!!!'	=> '-',
	"Let's＼(・ω・)／にゃー"					=> '.',
	'cosmic!'								=> ',',
	'CHAOS☆CHAOS!'							=> '[',
	'I WANNA CHAOS!'						=> ']',
]);
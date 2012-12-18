<?php
/*
 * jojo言語から他言語への変換用サンプル
 */
require __DIR__ . '/../vendor/autoload.php';
use Polidog\Brainfuck\Memory;
use Polidog\Brainfuck\Interpreter;

$memory = new Memory();
$memory->init(100);

$brainfuck = new Interpreter(__DIR__);
$brainfuck->setMemory($memory);
$brainfuck->setReplaceCommand([
	'スターフィンガー' => '>',
	'やれやれだぜ' => '>',
	'ロードローラ' => '<',
	'貧弱' => '<',
	'オラ' => '+',
	'無駄' => '-',
	"ハーミットパープル" => '.',
	'新手のスタンド使いか' => ',',
	'あ・・・ありのまま今起こったことを話すぜ' => '[',
	'ザ・ワールド' => ']',	
]);


if (isset($argv[1])) {
	$brainfuck->setFile($argv[1]);
}
else {
	$brainfuck->setCommand();
}

// ニャルらとホテブ言語
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
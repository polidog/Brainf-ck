<?php
/**
 * jojo言語
 * http://d.hatena.ne.jp/toyoshi/20100208/1265587511
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
	$brainfuck->inputFile($argv[1]);
}
else {
	$brainfuck->inputCommand();
}
$brainfuck->exec();
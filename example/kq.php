<?php
/**
 * プログラミング言語KQ
 * http://lyia.net/kq.php
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
	'ﾀﾞｧｲｪｽ' => '>',
	'ｲｪｽﾀﾞｧ' => '<',
	'ﾀﾞｧﾀﾞｧ' => '+',
	'ｼｴﾘｼｴﾘ' => '-',
	"ｼｴﾘﾀﾞｧ" => '.',
	'ﾀﾞｧｼｴﾘ' => ',',
	'ｼｴﾘｲｪｽ' => '[',
	'ｲｪｽｼｴﾘ' => ']',	
]);

if (isset($argv[1])) {
	$brainfuck->inputFile($argv[1]);
}
else {
	$brainfuck->inputCommand();
}
$brainfuck->exec();

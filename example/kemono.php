<?php

/**
 * プログラミング言語フレンズ Kemono
 * https://github.com/consomme/kemono_friends_lang
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
    'たのしー！' => '>',
    'すごーい！' => '<',
    'たーのしー！' => '+',
    'すっごーい！' => '-',
    'なにこれなにこれ！' => '.',
    'おもしろーい！' => ',',
    'うわー！' => '[',
    'わーい！' => ']',
]);

if (isset($argv[1])) {
    $brainfuck->setFile($argv[1]);
}
else {
    $brainfuck->setCommand();
}
$brainfuck->exec();
echo "\n";
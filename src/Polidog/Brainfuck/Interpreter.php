<?php
namespace Polidog\Brainfuck;
/**
 * @author polidog
 */
class Interpreter {

	/**
	 * @var Memory
	 */
	protected $Memory;

	/**
	 * bfファイルの格納ディレクトリ
	 * @var string
	 */
	protected $basePath = null;

	
	/**
	 * コマンド対応配列
	 * @var array
	 */
	protected $commandMap = array(
		'>' => 'next',
		'<' => 'prev',
		'+' => 'up',
		'-' => 'down',
		'.' => 'output',
		',' => 'input',
		'[' => 'LoopStart',
		']' => 'LoopEnd',
	);
	
	/**
	 * コマンド置き換え
	 * @var array 
	 */
	protected $replaceCommand = array();

	/**
	 * コマンド
	 * @var string
	 */
	protected $command = null;

	/**
	 * 現在実行しているコマンドの位置
	 * @var int
	 */
	protected $position = 0;

	/**
	 * コンストラクタ
	 * @param string $basePath
	 */
	public function __construct($basePath = null) {
		if (is_null($basePath)) {
			$basePath = __DIR__;
		}
		$this->basePath = $basePath;
	}

	/**
	 * setter
	 * @param Memory $Memory
	 */
	public function setMemory(Memory $Memory) {
		$this->Memory = $Memory;
		return $this;
	}

	/**
	 * getter
	 * @return Memory
	 */
	public function getMemory() {
		return $this->Memory;
	}
	
	/**
	 * リプレスする際のコマンドを定義する
	 */
	public function setReplaceCommand(array $replaceCommand) {
		$this->replaceCommand = $replaceCommand;
		return $this;
	}

	/**
	 * コマンドを入力する
	 * @return boolean
	 */
	public function inputCommand() {
		$input = $this->input();
		$this->command = trim($input);
		if (!empty($this->command)) {
			$this->comandParse();
			return true;
		}
		return false;
	}

	/**
	 * コマンドを入力する
	 * @param string $filename 読み込みたいファイル名
	 * @return boolean
	 */
	public function inputFile($filename) {
		$file = $this->basePath . DIRECTORY_SEPARATOR . $filename;
		if (!file_exists($file)) {
			return false;
		}
		$_input = file_get_contents($file);
		$this->command = trim(str_replace("\n", "", $_input));
		if (!empty($this->command)) {
			$this->comandParse();
			return true;
		}
		return false;
	}
	
	/**
	 * コマンドを取得する
	 * @param boolean $clean
	 * @return string
	 */
	public function getCommand($clean = false) {
		if ( $clean ) {
			$len = strlen($this->command);
			$ret = null;
			for ($i = 0;$i < $len; $i++ ) {
				if ( isset($this->commandMap[$this->command[$i]]) ) {
					$ret .= $this->command[$i];
				}
			}
			return $ret;
		}
		else {
			return $this->command;
		}
	}

	/**
	 * 実行する
	 */
	public function exec() {
		$length = mb_strlen($this->command);
		for ($i = 0; $i < $length; ++$i) {
			$this->position = $i;
			$method = $this->getCommandMethod();
			if ($method) {
				$method = 'command' . $method;
				$this->$method();
			}
			$i = $this->position;
		}
	}

	/**
	 * ------------------------------------------------------------
	 * コマンド系男子
	 * ------------------------------------------------------------
	 */
	protected function getCommandMethod() {
		$command = $this->command[$this->position];
		if (isset($this->commandMap[$command])) {
			return ucwords($this->commandMap[$command]);
		}
		return false;
	}

	/**
	 * コマンド(>)
	 */
	protected function commandNext() {
		$this->Memory->next();
	}

	/**
	 * コマンド(<)
	 */
	protected function commandPrev() {
		$this->Memory->prev();
	}

	/**
	 * コマンド(+)
	 */
	protected function commandUp() {
		$this->Memory->up();
	}

	/**
	 * コマンド(-)
	 */
	protected function commandDown() {
		$this->Memory->down();
	}

	/**
	 * コマンド(,)
	 */
	protected function commandInput() {
		$input = $this->input();
		$this->Memory->setAscii(trim($input));
	}

	/**
	 * コマンド(.)
	 */
	protected function commandOutput() {
		echo $this->Memory->getAscii();
	}

	/**
	 * ループスタート([)
	 */
	protected function commandLoopStart() {
		$c = $this->Memory->current();
		if ($c != 0) {
			return null;
		}

		$count = 0;
		$length = mb_strlen($this->command);
		for ($i = $this->position; $i < $length; $i++) {
			if ($this->command[$i] == '[') {
				$count++;
			} elseif ($this->command[$i] == ']') {
				$count--;
				if ($count == 0) {
					$this->position = $i;
					break;
				}
			}
		}
	}

	/**
	 * コマンド(])
	 */
	protected function commandLoopEnd() {
		$count = 0;
		for ($i = $this->position; $i >= 0; $i--) {
			if ($this->command[$i] == ']') {
				$count++;
			} elseif ($this->command[$i] == '[') {
				$count--;
				if ($count < 1) {
					$this->position = $i - 1;
					break;
				}
			}
		}
	}
	
	
	/**
	 * コマンド解析して1コマンドずつ配列にいれる←いれてねーよw
	 */
	protected function comandParse() {
		$command = $this->command; 
		if ( empty($this->replaceCommand) ) {
			// 置き換えの必要がない場合は置き換えない
			return null;
		}
		
		// コマンドもじをbrainfuck形式に置き換える
		foreach ( $this->replaceCommand as $search => $replace ) {
			$this->command = str_replace($search, $replace, $this->command);
		}
	}

	/**
	 * 入力
	 * @return string
	 */
	protected function input() {
		$line = null;
		while (true) {
			$line = trim(fgets(STDIN));
			if ($line == 'exit') {
				exit("exit\n");
			} elseif (!empty($line)) {
				break;
			}
		}
		return $line;
	}

}

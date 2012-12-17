<?php
namespace Polidog\Brainfuck;
/**
 * メモリっぽいオブジェクト
 */
class Memory
{
	/**
	 * アドレス位置
	 * @var int
	 */
	private $addr = 0;
	
	/**
	 * メモリもどき
	 * @var array
	 */
	private $data = array();
	
	
	/**
	 * コンストラクタ
	 */
	public function __construct() {
		$this->addr = 0;
	}
	
	/**
	 * 初期化
	 * @param int $max 最大メモリの値
	 */
	public function init($max) {
		for ($i = 0; $i < $max; $i++) {
			$this->data[$i] = 0;
		}
		return $this;
	}
	
	/**
	 * 現在のアドレスの情報を取得する
	 * @return int
	 */
	public function current() {
		return $this->data[$this->addr];
	}
	
	/**
	 * 現在のアドレスを取得する
	 * @return int
	 */
	public function key() {
		return $this->addr;
	}
	
	/**
	 * アドレスを次ぎにうつす
	 */
	public function next() {
		++$this->addr;
		if ( $this->addr >= count($this->data) ) {
			$this->addr = count($this->data) - 1;
		}
	}
	
	/**
	 * アドレスを一つ前に戻す
	 */
	public function prev() {
		--$this->addr;
		if ( $this->addr < 0 ) {
			$this->addr = 0;
		}
	}
	
	/**
	 * アドレスを0番目にする
	 */
	public function rewind() {
		$this->addr = 0;
	}
	
	/**
	 * 1up
	 */
	public function up() {
		$this->data[$this->addr]++;
		if ( $this->data[$this->addr] >= 255 ) {
			$this->data[$this->addr] = 0;
		}
	}
	
	/**
	 * 1down
	 */
	public function down() {
		$this->data[$this->addr]--;
		if ( $this->data[$this->addr] < 0 ) {
			$this->data[$this->addr] = 255;
		}
	}
	
	/**
	 * アスキーコードを取得する
	 * @return string
	 */
	public function getAscii() {
		return chr($this->data[$this->addr]);
	}
	
	/**
	 * アスキーコードをセットする
	 * @param string $ascii
	 */
	public function setAscii($ascii) {
		$this->data[$this->addr] = ord($ascii);
	}
	
	/**
	 * ダンプ
	 */
	public function dump() {
		var_dump($this->data);
	}
	
}

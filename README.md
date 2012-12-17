Brainf*ckをPHPで実行しちゃうよ(・ω<)
==========

元々は池袋バイナリ勉強会に参加したときにつくってたんですが、  
なんかjojo言語とかプログラミング言語KQとかいろいろと面白いものがあったので、  
PHPで動かせたらたのしーなーなんて糞PHPer的な発想からPHPで動かすようにコード書いてみました的な感じだったりします。

動作環境
------------
php5.4以上  
みなさん、php5.4使いましょう＾＾


動かし方
------------
インストールとかとか

	git@github.com:polidog/Brainf-ck.git
	
	#composer無い方
	curl -s http://getcomposer.org/installer | php
	
	composer.phar install 

これで準備完了。あとは実行するだけ！

	php example/brainfuck.php bk/hello.bk


ジョジョ言語を動かす

 	php example/jojo.php jojo/hello.jojo 

プログラミング言語KQを動かす

	php example/kq.php kq/hello.qk

ニャルラトホテプ言語

	php example/nyaruko.php nyaruko/hello.nc


ファイルを使わずに直接入力もできるお！
-----

ジョジョ言語で「H」一文字を出力する

	php exmpale/jojo.php
	オラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオラオララオラオラオラオララオラオラオラオラハーミットパープル

出力として以下のように表示されます
	
	H


ほかの言語はもうめんどくさいので割愛します。


hello wrold的なものとか仕様とかを以下のサイトから参考させていただきました。感謝です。
--------

http://d.hatena.ne.jp/toyoshi/20100208/1265587511  
http://ideone.com/DDWfy  
http://kissaten-no-heya.blogspot.jp/2012/04/blog-post_8719.html

	

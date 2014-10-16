<?php
/**
 * class bowl
 * 
 * Pickles2 のコアオブジェクトの1つ `$bowl` のオブジェクトクラスを定義します。
 * 
 * @author Tomoya Koyanagi <tomk79@gmail.com>
 */
namespace pickles;

/**
 * Bowl
 * 
 * Pickles2 のコアオブジェクトの1つ `$bowl` のオブジェクトクラスです。
 * このオブジェクトは、Pickles2 の初期化処理の中で自動的に生成され、`$px` の内部に格納されます。
 * 
 * メソッド `$px->bowl()` を通じてアクセスします。
 * 
 * @author Tomoya Koyanagi <tomk79@gmail.com>
 */
class bowl{

	private $contents_bowl = array(
		// 'main'=>'', //  メインコンテンツ
		// 'head'=>''  //  ヘッドセクションに追記
	);

	/**
	 * コンストラクタ
	 * 
	 * @param object $px Picklesオブジェクト
	 */
	public function __construct(){
	}

	/**
	 * コンテンツボウルにコンテンツを送る。
	 * 
	 * ソースコードを$pxオブジェクトに預けます。
	 * このメソッドから預けられたコードは、同じ `$content_name` 値 をキーにして、`$px->bowl()->pull()` から引き出すことができます。
	 * 
	 * この機能は、コンテンツからテーマへコンテンツを渡すために使用されます。
	 * 
	 * 同じ名前(`$content_name`値)で複数回ソースを送った場合、後方に追記されます。
	 * 
	 * @param string $src 送るHTMLソース
	 * @param string $content_name ボウルの格納名。
	 * $px->bowl()->pull() から取り出す際に使用する名称です。
	 * 任意の名称が利用できます。PxFWの標準状態では、無名(空白文字列) = メインコンテンツ、'head' = ヘッダー内コンテンツ の2種類が定義されています。
	 * 
	 * @return bool 成功時 true、失敗時 false
	 */
	public function send( $src , $content_name = '' ){
		if( !strlen($content_name) ){ $content_name = ''; }
		if( !is_string($content_name) ){ return false; }
		@$this->contents_bowl[$content_name] .= $src;
		return true;
	}

	/**
	 * コンテンツボウルのコンテンツを置き換える。
	 * 
	 * ソースコードを$pxオブジェクトに預けます。
	 * `$px->bowl()->send()` と同じですが、複数回送信した場合に、このメソッドは追記ではなく上書きする点が異なります。
	 * 
	 * @param string $src 送るHTMLソース
	 * @param string $content_name ボウルの格納名。
	 * $px->bowl()->pull() から取り出す際に使用する名称です。
	 * 任意の名称が利用できます。PxFWの標準状態では、無名(空白文字列) = メインコンテンツ、'head' = ヘッダー内コンテンツ の2種類が定義されています。
	 * 
	 * @return bool 成功時 true、失敗時 false
	 */
	public function replace( $src , $content_name = '' ){
		if( !strlen($content_name) ){ $content_name = ''; }
		if( !is_string($content_name) ){ return false; }
		@$this->contents_bowl[$content_name] = $src;
		return true;
	}

	/**
	 * コンテンツボウルからコンテンツを引き出す
	 * 
	 * 引き出したコンテンツは、ボウルからはなくなります。
	 * 
	 * @param string $content_name ボウル上のコンテンツ名
	 * @param bool $do_finalize ファイナライズ処理を有効にするか(default: true)
	 * @return mixed 成功時、ボウルから得られたHTMLソースを返す。失敗時、false
	 */
	public function pull( $content_name = '' ){
		if( !strlen($content_name) ){ $content_name = ''; }
		if( !is_string($content_name) ){ return false; }
		if( !array_key_exists($content_name, $this->contents_bowl) ){ return null; }

		$content = $this->contents_bowl[$content_name];
		unset( $this->contents_bowl[$content_name] );// コンテンツを引き出したら、ボウル上にはなくなる。

		return $content;
	}

	/**
	 * コンテンツボウルにあるコンテンツの索引を取得する
	 * @return array ボウルのキーの一覧
	 */
	public function get_keys(){
		$keys = array_keys( $this->contents_bowl );
		return $keys;
	}

}

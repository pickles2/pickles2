<?php
/**
 * PX Commands "autoindex"
 */
namespace tomk79\pickles2\autoindex;

/**
 * PX Commands "autoindex"
 */
class autoindex{

	private $px;

	/**
	 * 機能別に値を記憶する領域
	 */
	private $func_data_memos = '<!-- autoindex -->';

	/**
	 * extensions function
	 */
	public static function exec( $px, $src, $contents_key ){
		$autoindex = new self( $px );

		//  autoindex
		if( strlen( $autoindex->func_data_memos ) ){
			$src = $autoindex->apply_autoindex( $src );
		}

		return $src;
	}

	/**
	 * constructor
	 */
	public function __construct( $px ){
		$this->px = $px;
	}

	/**
	 * ページ内の目次を自動生成する。
	 * 
	 * ページ内の目次を生成するHTMLソースを返すように動作しますが、実際の内部処理は、
	 * 直接的には一時的に生成されたランダムな文字列を返し、最終処理の中で目次HTMLに置き換えるように動作します。
	 *
	 * @return string ページ内の目次のHTMLソース
	 */
	public function autoindex(){
		if( !is_string( $this->func_data_memos ) ){
			$this->func_data_memos = '[__autoindex_'.md5( time() ).'__]';
		}
		return $this->func_data_memos;
	}//autoindex();

	/**
	 * ページ内の目次をソースに反映する。
	 * 
	 * `$theme->autoindex()` によって生成予告された目次を実際に生成します。
	 * 
	 * @param string $content 予告状態の コンテンツ HTMLソース
	 * 
	 * @return string 目次が反映されたHTMLソース
	 */
	private function apply_autoindex( $content ){
		$tmp_cont = $content;
		$content = '';
		$index = array();
		$indexCounter = array();
		$i = 0;
		while( 1 ){
			set_time_limit(60*30);
			if( !preg_match( '/^(.*?)(<\!\-\-(?:.*?)\-\->|<script(?:\s.*?)?>(?:.*?)<\/script>|<h([2-6])(?:\s.*?)?>(.*?)<\/h\3>)(.*)$/is' , $tmp_cont , $matched ) ){
				$content .= $tmp_cont;
				break;
			}
			$i ++;
			$tmp = array();
			$tmp['label'] = $matched[4];
			$tmp['label'] = strip_tags( $tmp['label'] );//ラベルからHTMLタグを除去
			// IDに含められない文字をアンダースコアに変換;
			$label_for_anch = $tmp['label'];
			$label_for_anch = preg_replace('/[ #%]/', '_', $label_for_anch);
			$label_for_anch = preg_replace('/[\[\{\<]/', '(', $label_for_anch);
			$label_for_anch = preg_replace('/[\]\}\>]/', ')', $label_for_anch);
			$tmp['anch'] = 'hash_'.($label_for_anch);
			if(array_key_exists($tmp['anch'], $indexCounter) && $indexCounter[$tmp['anch']]){
				$indexCounter[$tmp['anch']] ++;
				$tmp['anch'] = 'hash_'.$indexCounter[$tmp['anch']].'_'.($label_for_anch);
			}else{
				$indexCounter[$tmp['anch']] = 1;
			}

			$tmp['headlevel'] = intval($matched[3]);
			if( $tmp['headlevel'] ){# 引っかかったのが見出しの場合
				array_push( $index , $tmp );
			}

			$content .= $matched[1];
			if( $tmp['headlevel'] ){# 引っかかったのが見出しの場合
				#$content .= $this->back2top();
				$content .= '<span';
				$content .= ' id="'.htmlspecialchars($tmp['anch']).'"';
				$content .= '></span>';
			}
			$content .= $matched[2];
			$tmp_cont = $matched[5];
		}
		set_time_limit(30);

		$anchorlinks = '';
		$topheadlevel = 2;
		$headlevel = $topheadlevel;
		if( count( $index ) ){
			$anchorlinks .= '<!-- autoindex -->'."\n";
			$anchorlinks .= '<div class="anchor_links">'."\n";
			$anchorlinks .= '<p class="anchor_links-heading">目次</p>';
			foreach($index as $key=>$row){
				$csa = $row['headlevel'] - $headlevel;
				$nextLevel = @$index[$key+1]['headlevel'];
				$nsa = null;
				if( strlen( $nextLevel ) ){
					$nsa = $nextLevel - $row['headlevel'];
				}
				$headlevel = $row['headlevel'];
				if( $csa>0 ){
					#	いま下がるとき
					if( $key == 0 ){
						$anchorlinks .= '<ul><li>';
					}
					for( $i = $csa; $i>0; $i -- ){
						$anchorlinks .= '<ul><li>';
					}
				}elseif( $csa<0 ){
					#	いま上がるとき
					if( $key == 0 ){
						$anchorlinks .= '<ul><li>';
					}
					for( $i = $csa; $i<0; $i ++ ){
						$anchorlinks .= '</li></ul>';
					}
					$anchorlinks .= '</li><li>';
				}else{
					#	いま現状維持
					if( $key == 0 ){
						$anchorlinks .= '<ul>';
					}
					$anchorlinks .= '<li>';
				}
				$anchorlinks .= '<a href="#'.htmlspecialchars($row['anch']).'">'.($row['label']).'</a>';
				if( is_null($nsa) ){
					break;
				}elseif( $nsa>0 ){
					#	つぎ下がるとき
#					for( $i = $nsa; $i>0; $i -- ){
#						$anchorlinks .= '</li></ul></li>';
#					}
				}elseif( $nsa<0 ){
					#	つぎ上がるとき
					for( $i = $nsa; $i<0; $i ++ ){
//						$anchorlinks .= '</li></ul>'."\n";
					}
				}else{
					#	つぎ現状維持
					$anchorlinks .= '</li>'."\n";
				}
			}
			while($headlevel >= $topheadlevel){
				$anchorlinks .= '</li></ul>'."\n";
				$headlevel --;
			}
			$anchorlinks .= '</div><!-- /.anchor_links -->'."\n";
			$anchorlinks .= '<!-- / autoindex -->'."\n";
		}

		$content = preg_replace( '/'.preg_quote($this->func_data_memos,'/').'/si' , $anchorlinks , $content );
		return $content;
	}//apply_autoindex();

}

<?php
$listMgr = (new \tomk79\pickles2\pageListGenerator\main($px))->create(
	function($page_info){
		if(array_key_exists('article_flg', $page_info) && $page_info['article_flg']){
			return true;
		}
		return false;
	} ,
	array(
		'scheme'=>$px->conf()->scheme,
		'domain'=>$px->conf()->domain,
		'title'=>$px->conf()->name,
		'description'=>'Try Shopify Blog',
		'lang'=>'ja',
		'dpp'=>9,
		'url_home'=>$px->canonical('/'),
		'url_index'=>$px->canonical('/articles/'),
		'author'=>$px->conf()->copyright,
		// 'rss'=>array(
		// 	'atom-1.0'=>$px->get_path_docroot().'rss/articles_atom0100.xml',
		// 	'rss-1.0'=>$px->get_path_docroot().'rss/articles_rss0100.rdf',
		// 	'rss-2.0'=>$px->get_path_docroot().'rss/articles_rss0200.xml',
		// )
	)
);

echo $listMgr->draw();
?>

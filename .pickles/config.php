<?php
return call_user_func( function(){

	// initialize
	$conf = new stdClass;

	// project
	$conf->name = 'Pickles 2'; // サイト名
	$conf->domain = null; // ドメイン
	$conf->path_controot = '/'; // コンテンツルートディレクトリ

	// paths
	$conf->path_top = '/'; // トップページのパス(デフォルト "/")
	$conf->path_publish_dir = null; // パブリッシュ先ディレクトリパス
	$conf->public_cache_dir = '/caches/'; // 公開キャッシュディレクトリ

	// directory index
	$conf->directory_index = array(
		'index.html'
	);


	// system
	$conf->file_default_permission = '775';
	$conf->dir_default_permission = '775';
	$conf->filesystem_encoding = 'UTF-8';
	$conf->output_encoding = 'UTF-8';
	$conf->output_eol_coding = 'lf';
	$conf->session_name = 'PXSID';
	$conf->session_expire = 1800;
	$conf->allow_pxcommands = 0; // PX Commands の実行を許可

	// commands
	$conf->commands = new stdClass;
	$conf->commands->php = 'php';

	// processor
	$conf->paths_proc_type = array(
		// パスのパターン別に処理方法を設定
		//     - ignore = 対象外パス
		//     - direct = 加工せずそのまま出力する(デフォルト)
		//     - その他 = extension 名
		// パターンは先頭から検索され、はじめにマッチした設定を採用する。
		// ワイルドカードとして "*"(アスタリスク) を使用可。
		'/.htaccess' => 'ignore' ,
		'/.px_execute.php' => 'ignore' ,
		'/.pickles/*' => 'ignore' ,
		'*.ignore/*' => 'ignore' ,
		'*.ignore.*' => 'ignore' ,
		'/composer.json' => 'ignore' ,
		'/composer.lock' => 'ignore' ,
		'/README.md' => 'ignore' ,
		'/vendor/*' => 'ignore' ,
		'*/.DS_Store' => 'ignore' ,
		'*/Thumbs.db' => 'ignore' ,
		'*/.svn/*' => 'ignore' ,
		'*/.git/*' => 'ignore' ,
		'*/.gitignore' => 'ignore' ,

		'*.html' => 'html' ,
		'*.htm' => 'html' ,
		'*.css' => 'css' ,
		'*.js' => 'js' ,
		'*.png' => 'direct' ,
		'*.jpg' => 'direct' ,
		'*.gif' => 'direct' ,
		'*.svg' => 'direct' ,
	);


	// -------- functions --------

	$conf->funcs = new stdClass;

	// Starting
	$conf->funcs->starting = [
		 // PX=phpinfo
		'pickles\commands\phpinfo::funcs_starting' ,

		// PX=clearcache
		'pickles\commands\clearcache::funcs_starting' ,
	];

	// Before content
	$conf->funcs->before_content = [
		// PX=publish
		'pickles\commands\publish::funcs_before_content' ,
	];


	// processors
	$conf->funcs->process = new stdClass;

	$conf->funcs->process->html = [
		// ページ内目次を自動生成する
		'pickles\processors\autoindex\autoindex::exec' ,

		// テーマ
		'pickles\themes\pickles\theme::exec' , 

		// Apache互換のSSIの記述を解決する
		'pickles\processors\ssi\ssi::exec' ,

		// output_encoding, output_eol_coding の設定に従ってエンコード変換する。
		'pickles\processors\encodingconverter\encodingconverter::exec' ,
	];

	$conf->funcs->process->css = [
		// output_encoding, output_eol_coding の設定に従ってエンコード変換する。
		'pickles\processors\encodingconverter\encodingconverter::exec' ,
	];

	$conf->funcs->process->js = [
		// output_encoding, output_eol_coding の設定に従ってエンコード変換する。
		'pickles\processors\encodingconverter\encodingconverter::exec' ,
	];

	$conf->funcs->process->md = [
		// Markdown文法を処理する
		'pickles\processors\md\ext::exec' ,

		// html の処理を追加
		$conf->funcs->process->html ,
	];

	$conf->funcs->process->scss = [
		// SCSS文法を処理する
		'pickles\processors\scss\ext::exec' ,

		// css の処理を追加
		$conf->funcs->process->css ,
	];


	// output filter
	$conf->funcs->output_filter = [
	];


	return $conf;
} );
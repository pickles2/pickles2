<?php
/**
 * theme "pickles"
 */
namespace pickles\themes\pickles;

/**
 * theme "pickles" class
 */
class theme{
	private $px;
	private $path_tpl;
	private $page;

	/**
	 * constructor
	 */
	public function __construct($px){
		$this->px = $px;
		$this->path_tpl = $px->fs()->get_realpath(__DIR__.'/../').DIRECTORY_SEPARATOR;
		$this->page = $this->px->site()->get_current_page_info();
		if( @!strlen( $this->page['layout'] ) ){
			$this->page['layout'] = 'default';
		}
		if( !$px->fs()->is_file( $this->path_tpl.$this->page['layout'].'.html' ) ){
			$this->page['layout'] = 'default';
		}
	}

	/**
	 * entry method
	 */
	public static function exec( $px ){
		switch( strtolower( pathinfo( $px->req()->get_request_file_path() , PATHINFO_EXTENSION ) ) ){
			// HTML以外はスルー
			case 'html':
			case 'htm':
				break;
			default:
				return $px->pull_content();
				break;
		}

		$self = new self($px);
		$src = $self->bind($px);
		return $src;
	}

	/**
	 * bind content to theme
	 */
	private function bind( $px ){
		ob_start();
		include( $this->path_tpl.$this->page['layout'].'.html' );
		$src = ob_get_clean();
		return $src;
	}

}
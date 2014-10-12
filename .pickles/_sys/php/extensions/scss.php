<?php
/**
 * extention "*.scss"
 */
namespace pickles\extensions;

/**
 * extention "*.scss" class
 */
class scss{
	public static function exec( $px ){
		foreach( $px->get_content_keys() as $key ){
			$src = $px->pull_content( $key );

			$tmp_current_dir = realpath('./');
			chdir( dirname( $_SERVER['SCRIPT_FILENAME'] ) );
			$scss = new \scssc();
			$src = $scss->compile( $src );
			chdir( $tmp_current_dir );

			$src = $px->replace_content( $src, $key );
		}

		return true;
	}
}

<?php
/**
 * processor "*.md"
 */
namespace pickles\processors\md;

/**
 * processor "*.md" class
 */
class ext{
	public static function exec( $px ){

		foreach( $px->bowl()->get_keys() as $key ){
			$src = $px->bowl()->pull( $key );

			$src = \Michelf\MarkdownExtra::defaultTransform($src);

			$src = $px->bowl()->replace( $src, $key );
		}

		return true;
	}
}

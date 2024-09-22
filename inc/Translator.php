<?php

/**
 * Translator.
 * 
 * @package Master_Whats_Chat
 */

namespace TMWC\Master_Whats_Chat;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Translator {

    /**
	 * Get Translated Strings
	 * Useful for WPML and Polylang plugins
	 *
	 */
	public static function translate_string( $original_value = '', $name = '', $default_value = false, $placeholder = '' ){
		
		if( empty($original_value) ) {
			$original_value = $placeholder;
		}

		// WPML
		if( class_exists( 'SitePress' ) ) {
			$domain = 'TM Whatsapp';
			
			return apply_filters('wpml_translate_single_string', esc_html( $original_value ), $domain, $name );
		}

		// Polylang
		if( class_exists( 'Polylang' ) ) {
			if( function_exists( 'pll__' ) ) {
				return pll__( $original_value );
			}
		}

		return esc_html( $original_value );
	}
}
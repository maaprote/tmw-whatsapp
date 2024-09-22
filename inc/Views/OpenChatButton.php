<?php

/**
 * Open chat button.
 * 
 * @package Master_Whats_Chat
 */

namespace TMWC\Master_Whats_Chat\Views;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

use TMWC\Master_Whats_Chat\Functions;
use TMWC\Master_Whats_Chat\Translator;

class OpenChatButton {

    /**
     * Constructor.
     * 
     */
    public function __construct() {
        $this->render();
    }

	/**
	 * Singleton
	 * 
	 */
	public static function instance() {
		static $instance = null;

		if( null === $instance ) {
			$instance = new self();
		}

		return $instance;
	}

    /**
	 * Whatsapp Trigger/Open Chat Button Output
	 *
	 */
	public function render() {
        $settings = Functions::get_settings();

		$output = '';

		$classes = array( 'tmw-whatsapp-trigger-button tmw-whatsapp-trigger-button-fixed' );
		$atts    = array();
		$styles  = array();

		// RTL
		if( isset($settings['rtl_layout']) && $settings['rtl_layout'] ) {
			$classes[] = 'tmw-direction-rtl';
		}

		// Move Button
		$x = $y = 0;
		if( isset($settings['whatsapp_move_button-left-right']) ) {
			$x = $settings['whatsapp_move_button-left-right'];
		}

		if( isset($settings['whatsapp_move_button-top-bottom']) ) {
			$y = $settings['whatsapp_move_button-top-bottom'];
		}
		
		$styles[] = 'transform: translate3d('. esc_attr( $x ) .'px, '. esc_attr( $y ) .'px, 0)';
		
		// Mount Class
		$atts[] = 'class="'. implode( ' ', $classes ) .'"';

		// Mount Style
		$atts[] = 'style="'. implode( ' ;', $styles ) .'"';

		$output .= '<div '. implode( ' ', $atts ) .'>';
			if( Functions::get_setting('call_to_action_show') === 'on' && ! empty( $settings['call_to_action_text'] ) ) {
				$output .= '<div class="tmw-whatsapp-call-to-action">';
					$output .= '<a href="#" class="tmw-whatsapp-call-to-action-button" rel="nofollow">';
						$output .= esc_html( Translator::translate_string( $settings['call_to_action_text'], 'call_to_action_text' ) );
					$output .= '</a>';
				$output .= '</div>';
			}
			$output .= '<a href="#" rel="nofollow">';
				$output .= '<i class="tmw-whatsapp-trigger-button-icon tmw-whatsapp-trigger-button-icon-open tmw-fab tmw-fa-whatsapp"></i>';
				$output .= '<i class="tmw-whatsapp-trigger-button-icon tmw-whatsapp-trigger-button-icon-close tmw-fas tmw-fa-times"></i>';
			$output .= '</a>';
		$output .= '</div>';

		echo wp_kses_post( $output );
	}
}
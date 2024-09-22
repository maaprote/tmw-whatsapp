<?php

/**
 * Single Product Button.
 * 
 * @package Master_Whats_Chat
 */

namespace TMWC\Master_Whats_Chat\Integration\WooCommerce;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

use TMWC\Master_Whats_Chat\Functions;
use TMWC\Master_Whats_Chat\Translator;

class SingleProductButton {

    /**
     * Cosntructor.
     * 
     */
    public function __construct() {
        if ( ! is_singular( 'product' ) ) {
            return;
        }

		add_action( 'the_post', function(){
			global $post;

			// Shop Archive Page
			$button_position_shop_archive = get_post_meta( $post->ID, 'tmwc_woocommerce_button_position_shop_archive', true );
			if( $button_position_shop_archive != '' && $button_position_shop_archive != 'none' ) {
				add_action( $button_position_shop_archive, array( $this, 'render_chat_button' ) );
			}

			// Product Single Page
			$button_position = get_post_meta( $post->ID, 'tmwc_woocommerce_button_position', true );
			if( $button_position != '' && $button_position != 'none' ) {
				add_action( $button_position, array( $this, 'render_chat_button' ) );
			}
		} );
    }

    /**
	 * Get Attendant Status HTML
	 *
     * @param array $settings
     * 
     * @return string
	 */
	public function get_attendant_status_html( $settings ) {
		$output = '';

		$classes = array( 'tmw-whatsapp-elementor-title-status' );
		$attributes = array();

		// Check Status
		if( $settings['status'] ) {
			$classes[] = 'tmw-whatsapp-elementor-title-status-online';
			$status_text = Translator::translate_string( __( 'Online!', 'master-whats-chat' ), 'status_online' );
		} else {
			$classes[] = 'tmw-whatsapp-elementor-title-status-offline';
			$status_text = Translator::translate_string( __( 'Offline!', 'master-whats-chat' ), 'status_offline' );
		}

		// Mount Class
		$attributes[] = 'class="'. esc_attr( implode( ' ', $classes ) ) .'"';

		// Output
		$output .= '<span '. implode( ' ', $attributes ) .'>';
			$output .= esc_html( $status_text );
		$output .= '</span>';

		return $output;
	}
    
    /**
     * Render Chat Button. 
     * 
     * @return void
     */
    public function render_chat_button() {
		global $post;

        $settings = Functions::get_settings();

		// Post Metabox Data
		$show_button                  = get_post_meta( $post->ID, 'tmwc_show_woocommerce_button', true );
		$attendant_id                 = get_post_meta( $post->ID, 'tmwc_woocommerce_button_attendant_id', true );
		$button_layout                = get_post_meta( $post->ID, 'tmwc_woocommerce_button_layout', true );
		$attendant_photo_or_icon      = get_post_meta( $post->ID, 'tmwc_woocommerce_button_attendant_photo_or_icon', true );
		$attendant_title              = get_post_meta( $post->ID, 'tmwc_woocommerce_button_attendant_title', true );
		$attendant_description        = get_post_meta( $post->ID, 'tmwc_woocommerce_button_attendant_description', true );
		$button_position              = get_post_meta( $post->ID, 'tmwc_woocommerce_button_position', true );
		$button_position_shop_archive = get_post_meta( $post->ID, 'tmwc_woocommerce_button_position_shop_archive', true );
		$show_woo_button              = get_post_meta( $post->ID, 'tmwc_show_woocommerce_button', true );
		
		if( !$show_button ) {
			return '';
		}

		if( is_shop() ) {
			if( empty($button_position_shop_archive) ) {
				return '';
			}
		}

		// Margin According Hook Positions
		$display_class = '';

		// Shop Archive
		if( is_shop() || taxonomy_exists( 'product_cat' ) ) {
			switch ( $button_position_shop_archive ) {
				case 'woocommerce_before_shop_loop_item_title':
				case 'woocommerce_after_shop_loop_item':
					$display_class = ' tmw-mt-20px';
					break;
				case 'woocommerce_shop_loop_item_title':
					$display_class = ' tmw-my-7px';
					break;
				case 'woocommerce_after_shop_loop_item_title':
					$display_class = ' tmw-mb-20px';
					break;
			}
		}

		// Product Single
		if( is_singular( 'product' ) ) {
			switch ( $button_position ) {
				case 'woocommerce_before_add_to_cart_button':
				case 'woocommerce_before_add_to_cart_form':
					$display_class = ' tmw-mb-20px';
					break;
				case 'woocommerce_after_add_to_cart_button':
				case 'woocommerce_after_add_to_cart_form':
					$display_class = ' tmw-mt-20px';
					break;
				case 'woocommerce_before_add_to_cart_quantity':
					$display_class = ' tmw-float-left tmw-d-inline-flex tmw-mr-5px';
					break;
				case 'woocommerce_after_add_to_cart_quantity':
					$display_class = ' tmw-float-left tmw-d-inline-flex tmw-mx-5px';
					break;
				case 'woocommerce_before_add_to_cart_form':
					$display_class = ' tmw-mb-20px';
					break;          
			}
		}
		
		// Get Attendants Array
		$attendants = $settings['attendants'];

		// Get Selected Attendant
		$attendant = $attendants[ $attendant_id ];

		// Attendant Title
		if( empty($attendant_title) ) {
			$attendant_title = Translator::translate_string( $attendant['name'], 'attendant_'. $attendant_id .'_name' );
		}

		// Attendant Description
		if( empty($attendant_description) ) {
			$attendant_description = Translator::translate_string( $attendant['description'], 'attendant_'. $attendant_id .'_description' );
		}

		$settings = array(
			'alignment' => 'left',
			'background-color' => '#61CE70',
			'status-text-color' => '#54595F',
			'layout-style' => $button_layout,
			'status' => 'yes',
			'phone-number' => '123456',
			'photo-or-icon' => $attendant_photo_or_icon,
			'background-hover-color' => '#38bd6a',
			'icon-color' => '#FFF',
			'icon-hover-color' => '#FFF',
			'attendant-name-color' => '#FFF',
			'attendant-name-hover-color' => '#FFF',
			'attendant-description-color' => '#FFF',
			'attendant-description-hover-color' => '#FFF',
			'status-background-color' => '#61c386',
			'status-background-hover-color' => '#61c386',
			'status-text-hover-color' => '#FFF',
		);

		$wrapper_classes = array( 'tmw-whatsapp-elementor-wrapper' );
		$wrapper_atts = array(); 

		// Layout Style
		$wrapper_classes[] = esc_attr( $settings['layout-style'] );

		// Alignment
		switch ( $settings['alignment'] ) {
			case 'full-width':
				$wrapper_classes[] = 'tmw-whatsapp-elementor-wrapper-full-width';
				break;

			case 'center':
				$wrapper_classes[] = 'tmw-whatsapp-elementor-wrapper-align-center';
				break;

			case 'right':
				$wrapper_classes[] = 'tmw-whatsapp-elementor-wrapper-align-right';
				break;

			case 'left':
			default:
				$wrapper_classes[] = 'tmw-whatsapp-elementor-wrapper-align-left';
				break;
		}

		// Attendant Availability
		$attendantAvailability = base64_encode( wp_json_encode( $attendant['availability'] ) );

		// Mount Class
		$wrapper_atts[] = 'class="'. esc_attr( implode( ' ', $wrapper_classes ) ) .'"';

		$output = '';

		/* Translators: %1$s - Product Title, %2$s - Product URL */
		$start_message = sprintf( Translator::translate_string( __( 'Hello! I have some questions about the product: %1$s (%2$s)', 'master-whats-chat' ), 'woo_button_product_start_message' ), $post->post_title, get_the_permalink( $post->ID ) );

		$output .= '<a href="#" class="tmw-whatsapp-button" data-phone-number="'. esc_attr( Translator::translate_string( $attendant['phone'], 'attendant_'. $attendant_id .'_phone' ) ) .'"'. ( empty($attendant['phone']) ? ' disabled' : '' ) .' data-start-message="'. esc_attr( $start_message ) .'" data-availability="'. esc_attr( $attendantAvailability ) .'" data-default-timezone="'. esc_attr( $attendant['default_timezone'] ) .'">';
			$output .= '<div '. implode( ' ', $wrapper_atts ) .'>';
				$output .= '<div class="tmw-whatsapp-elementor-body">';
					$output .= '<div class="tmw-whatsapp-elementor-icon">';
						if( $settings['photo-or-icon'] == 'icon' ) {
							$output .= '<i class="tmw-fab tmw-fa-whatsapp"></i>';
						} else {
							$image = array(
								'image' => $attendants[ $attendant_id ]['image']['attendant-image'] ? wp_get_attachment_url( $attendants[ $attendant_id ]['image']['attendant-image'] ) : TMWC_PLUGIN_URL . '/img/user-placeholder.png',
								'width' => 150,
								'height' => 150,
							);

							$output .= '<img src="'. esc_url( $image['image'] ) .'" width="'. esc_attr( $image['width'] ) .'" height="'. esc_attr( $image['height'] ) .'" alt="" />';
						}
					$output .= '</div>';
					$output .= '<div class="tmw-whatsapp-elementor-info">';
						$output .= '<span class="tmw-whatsapp-elementor-info-offline-message">'. esc_html( Translator::translate_string( $attendant['offline_message'], 'atendant_'. $attendant_id .'_offline_message' ) ) .'</span>';
						$output .= '<span class="tmw-whatsapp-elementor-info-offline-message is-interval">'. esc_html( Translator::translate_string( $attendant['interval_message'], 'atendant_'. $attendant_id .'_interval_message' ) ) .'</span>';
						$output .= '<div class="tmw-whatsapp-elementor-title">';
							$output .= '<h5>'. esc_html( Translator::translate_string( $attendant_title, 'attendant_'. $attendant_id .'_name' ) ) .'</h5>';
							$output .= $this->get_attendant_status_html( $settings );
						$output .= '</div>';
						if( isset($attendant['description']) && !empty($attendant['description']) ) {
							$output .= '<div class="tmw-whatsapp-elementor-description">';
								$output .= '<p>'. esc_html( Translator::translate_string( $attendant_description, 'attendant_'. $attendant_id .'_description' ) ) .'</p>';
							$output .= '</div>';
						}
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</a>';

		echo '<div class="tmw-whatsapp-elementor-widget'. esc_attr( $display_class ) .'">';
			echo wp_kses_post( $output );
		echo '</div>';
	}    
}
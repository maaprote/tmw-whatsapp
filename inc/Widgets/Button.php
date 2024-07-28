<?php

/**
 * Button widget.
 * 
 * @package Master_Whats_Chat
 */

namespace TM\Master_Whats_Chat\Widgets;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

use TM\Master_Whats_Chat\Functions;
use TM\Master_Whats_Chat\Translator;
use TM\Master_Whats_Chat\Views\ChatWidget;

class Button extends \WP_Widget {

    /**
     * Constructor.
     * 
     */
    public function __construct() {
		$options = array( 
			'classname' => 'tmw-whatsapp-wp-widget-button',
			'description' => esc_html__( 'Show TM Whatsapp Button', 'tmw-whatsapp' ),
		);

		parent::__construct( 'tmw-whatsapp-wp-widget-button', esc_html__( 'TM Whatsapp: Button', 'tmw-whatsapp' ), $options );
    }

	/**
	 * Attendant Status Output
	 *
	 */
	public function get_attendant_status_html( $settings ) {
		$output = '';

		$html_tag = 'span';
		$classes = array('tmw-whatsapp-title-status');
		$attributes = array();

		$status_text = esc_html__( 'Online', 'tmw-whatsapp' );

		// Mount Class
		$attributes[] = 'class="'. esc_attr( implode( ' ', $classes ) ) .'"';

		// Output
		$output .= '<'. $html_tag .' '. implode( ' ', $attributes ) .'>';
			$output .= esc_html( $status_text );
		$output .= '</'. $html_tag .'>';

		return $output;
	}

    /**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$output = '';

		// Prevent undefined index
		if( !isset($args['type']) ) {
			$args['type'] = '';
		}

        $settings = Functions::get_settings();

		// Attendant ID
		$attendant_id = $instance['attendant_id'];

		if( $instance['attendant_id'] === NULL ) {
			$attendant_id = 0;
		}

        // Get attendants.
		$attendants_list = $settings['attendants'];

		// Get Selected Attendant
		$attendant = $attendants_list[ $attendant_id ];

		if( $attendants_list === NULL ) {
            echo esc_html__( 'None attendant is registered to show in this widget. Please register at least one attendant to render the widget.', 'tmw-whatsapp' );

			return;
        }

		// Register widgets script
		wp_register_script( 'tmw-whatsapp-widgets', TM_MASTER_WHATS_CHAT_URL . '/js/tmw-whatsapp-widgets.js', array('jquery'), false, true );
		wp_enqueue_script( 'tmw-whatsapp-widgets' );

		// Attendant Title
		$att_title = !empty( $instance['att_title'] ) ? $instance['att_title'] : Translator::translate_string( $attendant['name'], 'attendant_'. $attendant_id .'_name' );
		
		// Attendant Description
		$description = !empty( $instance['description'] ) ? $instance['description'] : Translator::translate_string( $attendant['description'], 'attendant_'. $attendant_id .'_description' );

		// Photo or Icons
		$photo_or_icon = $instance['photo_or_icon'];

		$settings = array(
			'alignment' => 'left',
			'background-color' => '#61CE70',
			'status-text-color' => '#54595F',
			'layout-style' => 'tmw-whatsapp-elementor-wrapper-style-1',
			'status' => 'yes',
			'phone-number' => '123456',
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

		if ( ! empty( $instance['title'] ) ) {
			$output .= $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		$output .= '<a href="#" class="tmw-whatsapp-button tmw-whatsapp-button-widget tmw-fadeIn" data-phone-number="'. esc_attr( Translator::translate_string( $attendant['phone'], 'attendant_'. $attendant_id .'_phone' ) ) .'"'. ( empty($attendant['phone']) ? ' disabled' : '' ) .' data-start-message="'. esc_attr( Translator::translate_string( $attendant['start_message'], 'attendant_'. $attendant_id .'_start_message' ) ) .'" data-availability="'. esc_attr( $attendantAvailability ) .'" data-default-timezone="'. esc_attr( $attendant['default_timezone'] ) .'">';
			$output .= '<div '. implode( ' ', $wrapper_atts ) .'>';
				$output .= '<div class="tmw-whatsapp-elementor-body">';
					$output .= '<div class="tmw-whatsapp-elementor-icon">';
						if( $photo_or_icon == 'icon' ) {
							$output .= '<i class="tmw-fab tmw-fa-whatsapp"></i>';
						} else {
							$image = array(
								'image' => $attendant['image']['attendant-image'] ? wp_get_attachment_url( $attendant['image']['attendant-image'] ) : TM_MASTER_WHATS_CHAT_URL . '/img/user-placeholder.png',
								'width' => 150,
								'height' => 150
							);

							$output .= '<img src="'. esc_url( $image['image'] ) .'" width="'. esc_attr( $image['width'] ) .'" height="'. esc_attr( $image['height'] ) .'" alt="" />';
						}
					$output .= '</div>';
					$output .= '<div class="tmw-whatsapp-elementor-info">';
						$output .= '<span class="tmw-whatsapp-elementor-info-offline-message">'. esc_html( Translator::translate_string( $attendant['offline_message'], 'attendant_'. $attendant_id .'_offline_message' ) ) .'</span>';
						$output .= '<span class="tmw-whatsapp-elementor-info-offline-message is-interval">'. esc_html( Translator::translate_string( $attendant['interval_message'], 'attendant_'. $attendant_id .'_interval_message' ) ) .'</span>';
						$output .= '<div class="tmw-whatsapp-elementor-title">';
							$output .= '<h5>'. esc_html( $att_title ) .'</h5>';
							$output .= $this->get_attendant_status_html( $settings );
						$output .= '</div>';
						if( !empty($description) ) {
							$output .= '<div class="tmw-whatsapp-elementor-description">';
								$output .= '<p>'. esc_html( $description ) .'</p>';
							$output .= '</div>';
						}
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</a>';

		echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- previously escaped.
	}

}
<?php

/**
 * Button shortcode.
 * 
 * @package Master_Whats_Chat
 */

namespace TM\Master_Whats_Chat\Shortcodes;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use TM\Master_Whats_Chat\Functions;
use TM\Master_Whats_Chat\Translator;

class Button {

    /**
     * Constructor.
     * 
     */
    public function __construct() {
        add_shortcode( 'tmw_whatsapp_button_wp', array( $this, 'render' ), 10, 3 );
    }

    /**
	 * Attendant Status Output
	 *
	 */
	public function get_attendant_status_html( $settings, $attendants ) {
		$output = '';

		$html_tag = 'span';
		$classes = array( 'tmw-whatsapp-title-status' );
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
     * Render
     * 
     * @param array $atts
     */
    public function render( $atts, $content, $tag ) {
        $settings = (shortcode_atts(array(
            'attendant' => 0,
            'layout-style' => 'tmw-whatsapp-elementor-wrapper-style-1',
            'title' => '',
            'description' => '',
            'photo_or_icon' => 'icon',
            'alignment' => '',
            'background_color' => '',
            'background_hover_color' => '',
            'icon_color' => '',
            'icon_hover_color' => '',
            'attendant_name_color' => '',
            'attendant_name_hover_color' => '',
            'attendant_description_color' => '',
            'attendant_description_hover_color' => '',
            'status_background_color' => '',
            'status_background_hover_color' => '',
            'status_text_color' => '',
            'badge_offline_message_background' => '',
            'badge_offline_message_text' => '',
            'badge_interval_background' => '',
            'badge_interval_text' => '',
        ), $atts));

        $attendants = Functions::get_attendants();

        if( $attendants === NULL ) {
            return esc_html__( 'None attendant is registered to show in this widget. Please register at least one attendant to render the widget.', 'tmw-whatsapp' );
        }

        // Uniqueid
        $uniqid = 'el_' . uniqid();

        // Attendant ID
        $attendant_id = $settings['attendant'];

        // Attendant Availability
        $attendantAvailability = base64_encode( wp_json_encode( $attendants[ $attendant_id ]['availability'] ) );

        // Attendant Title
        $title = !empty( $settings['title'] ) ? $settings['title'] : $attendants[ $attendant_id ]['name'];

        // Attendant Description
        $description = !empty( $settings['description'] ) ? $settings['description'] : $attendants[ $attendant_id ]['description'];
        
        $wrapper_classes = array( 'tmw-whatsapp-elementor-wrapper' );
        $wrapper_atts = array(); 

        // Layout Style
        $wrapper_classes[] = $settings['layout-style'];

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

        // Mount Class
        $wrapper_atts[] = 'id="'. esc_attr( $uniqid ) .'" class="'. esc_attr( implode( ' ', $wrapper_classes ) ) .'"';

        $output = '';

        $output .= '<div class="tmw-whatsapp-wpbakery-widget">';
            $output .= '<a href="#" class="tmw-whatsapp-button tmw-fadeIn tmw-d-block" data-phone-number="'. esc_attr( Translator::translate_string( $attendants[ $attendant_id ]['phone'], 'atendant_'. array( $attendant_id ) .'_phone' ) ) .'" data-availability="'. esc_attr( $attendantAvailability ) .'" data-default-timezone="'. esc_attr( $attendants[ $attendant_id ]['default_timezone'] ) .'"'. ( empty($attendants[ $attendant_id ]['phone'] ) ? ' disabled' : '' ) .'>';
                $output .= '<div '. implode( ' ', $wrapper_atts ) .'>';
                    $output .= '<div class="tmw-whatsapp-elementor-body">';
                        $output .= '<div class="tmw-whatsapp-elementor-icon">';
                        if( $settings['photo_or_icon'] == 'icon' ) {
                            $output .= '<i class="tmw-fab tmw-fa-whatsapp"></i>';
                        } else {
                            $image = array(
                                'image' => $attendants[ $attendant_id ]['image']['attendant-image'] ? wp_get_attachment_url( $attendants[ $attendant_id ]['image']['attendant-image'] ) : TM_MASTER_WHATS_CHAT_URL . '/img/user-placeholder.png',
                                'width' => 150,
                                'height' => 150,
                            );

                            $output .= '<img src="'. esc_url( $image['image'] ) .'" width="'. esc_attr( $image['width'] ) .'" height="'. esc_attr( $image['height'] ) .'" alt="" />';
                        }
                        $output .= '</div>';
                        $output .= '<div class="tmw-whatsapp-elementor-info">';
                            $output .= '<span class="tmw-whatsapp-elementor-info-offline-message">'. esc_html( Translator::translate_string( $attendants[ $attendant_id ]['offline_message'], 'atendant_'. array( $attendant_id ) .'_offline_message' ) ) .'</span>';
                            $output .= '<span class="tmw-whatsapp-elementor-info-offline-message is-interval">'. esc_html( Translator::translate_string( $attendants[ $attendant_id ]['interval_message'], 'atendant_'. array( $attendant_id ) .'_interval_message' ) ) .'</span>';
                            $output .= '<div class="tmw-whatsapp-elementor-title">';
                                $output .= '<h5>'. esc_html( $title ) .'</h5>';
                                $output .= $this->get_attendant_status_html( $settings, $attendants );
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
        $output .= '</div>';
        
        // Skin
        $output .= '<style>';
            $output .= '#'. $uniqid .'.tmw-whatsapp-elementor-wrapper.tmw-whatsapp-elementor-wrapper-style-1 .tmw-whatsapp-elementor-body { background: '. esc_attr( $atts['background_color'] ) .'; }';
            $output .= '#'. $uniqid .'.tmw-whatsapp-elementor-wrapper:hover .tmw-whatsapp-elementor-body { background: '. esc_attr( array( 'background_hover_color' ) ) .'; }';
            $output .= '#'. $uniqid .'.tmw-whatsapp-elementor-wrapper .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-icon { color: '. esc_attr( array( 'icon_color' ) ) .'; }';
            $output .= '#'. $uniqid .'.tmw-whatsapp-elementor-wrapper:hover .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-icon { color: '. esc_attr( array( 'icon_hover_color' ) ) .'; }';
            $output .= '#'. $uniqid .'.tmw-whatsapp-elementor-wrapper .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-title h5 { color: '. esc_attr( array( 'attendant_name_color' ) ) .'; }';
            $output .= '#'. $uniqid .'.tmw-whatsapp-elementor-wrapper:hover .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-title h5 { color: '. esc_attr( array( 'attendant_name_hover_color' ) ) .'; }';
            $output .= '#'. $uniqid .'.tmw-whatsapp-elementor-wrapper .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-description p { color: '. esc_attr( array( 'attendant_description_color' ) ) .'; }';
            $output .= '#'. $uniqid .'.tmw-whatsapp-elementor-wrapper:hover .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-description p { color: '. esc_attr( array( 'attendant_description_hover_color' ) ) .'; }';
            $output .= '#'. $uniqid .'.tmw-whatsapp-elementor-wrapper .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-title .tmw-whatsapp-elementor-title-status { background-color: '. esc_attr( array( 'status_background_color' ) ) .'; }';
            $output .= '#'. $uniqid .'.tmw-whatsapp-elementor-wrapper .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-title .tmw-whatsapp-elementor-title-status { color: '. esc_attr( array( 'status_text_color' ) ) .'; }';
            $output .= '#'. $uniqid .'.tmw-whatsapp-elementor-wrapper.tmw-whatsapp-elementor-wrapper-style-1 .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-info-offline-message { background-color: '. esc_attr( array( 'badge_offline_message_background' ) ) .'; }';
            $output .= '#'. $uniqid .'.tmw-whatsapp-elementor-wrapper.tmw-whatsapp-elementor-wrapper-style-1 .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-info-offline-message { color: '. esc_attr( array( 'badge_offline_message_text' ) ) .'; }';
            $output .= '#'. $uniqid .'.tmw-whatsapp-elementor-wrapper.tmw-whatsapp-elementor-wrapper-style-1 .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-info-offline-message.is-interval { color: '. esc_attr( array( 'badge_interval_background' ) ) .'; }';
            $output .= '#'. $uniqid .'.tmw-whatsapp-elementor-wrapper.tmw-whatsapp-elementor-wrapper-style-1 .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-info-offline-message.is-interval { color: '. esc_attr( array( 'badge_interval_text' ) ) .'; }';
        $output .= '</style>';

        return $output;         
    }
}

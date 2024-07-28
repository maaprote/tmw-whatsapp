<?php

/**
 * WPBakery Button Widget.
 * 
 * @package Master_Whats_Chat
 */

namespace TM\Master_Whats_Chat\Integration\WPBakery;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

use TM\Master_Whats_Chat\Functions;
use TM\Master_Whats_Chat\Translator;

class Button extends WPBakeryShortCode {
    
    /**
     * Plugin settings.
     */
    public $settings;

    /**
     * Constructor.
     * 
     */
    public function __construct() {
        add_action( 'init', array( $this, 'create_shortcode' ), 999 );            
        add_shortcode( 'tmw_whatsapp_button', array( $this, 'render_shortcode' ), 10, 3 );

        $this->settings = Functions::get_settings();
    }

    /**
     * Create shortcode.
     * 
     * @return void
     */
    public function create_shortcode() {            
        vc_map( array(
            'name'          => esc_html__( 'TM Whatsapp Button', 'tmw-whatsapp'),
            'base'          => 'tmw_whatsapp_button',
            'description'   => esc_html__( 'Add whatsapp button', 'tmw-whatsapp' ),
            'icon' => 'tmw-wpbakery-element-icon dashicons dashicons-whatsapp',
            'category'      => esc_html__( 'TM Whatsapp', 'tmw-whatsapp'),
            'admin_enqueue_css' => TM_MASTER_WHATS_CHAT_URL . '/css/tmw-whatsapp-wpbakery.css',
            'front_enqueue_css' => TM_MASTER_WHATS_CHAT_URL . '/css/tmw-whatsapp-wpbakery.css',
            'front_enqueue_js' => TM_MASTER_WHATS_CHAT_URL . '/js/tmw-whatsapp-widgets.js',
            'params' => array(
                
                // General
                array(
                    'type' => 'dropdown',
                    'admin_label' => false,
                    'edit_field_class' => 'vc_col-sm-6',
                    'heading' => esc_html__( 'Select Attendant', 'tmw-whatsapp' ),
                    'param_name' => 'attendant',
                    'value' => Functions::get_attendants_list(),
                    'std' => 0,
                ),

                array(
                    'type' => 'dropdown',
                    'admin_label' => false,
                    'edit_field_class' => 'vc_col-sm-6',
                    'heading' => esc_html__( 'Layout Style', 'tmw-whatsapp' ),
                    'param_name' => 'layout-style',
                    'value' => array(
                        esc_html__( 'Style 1', 'tmw-whatsapp' ) => 'tmw-whatsapp-elementor-wrapper-style-1',
                        esc_html__( 'Style 2', 'tmw-whatsapp' ) => 'tmw-whatsapp-elementor-wrapper-style-1 tmw-whatsapp-elementor-wrapper-style-1-rounded',
                    ),
                ),

                array(
                    'type' => 'textfield',
                    'admin_label' => false,
                    'edit_field_class' => 'vc_col-sm-6',
                    'heading' => esc_html__( 'TItle', 'tmw-whatsapp' ),
                    'param_name' => 'title',
                    'value' => '',
                ),

                array(
                    'type' => 'textfield',
                    'admin_label' => false,
                    'edit_field_class' => 'vc_col-sm-6',
                    'heading' => esc_html__( 'Description', 'tmw-whatsapp' ),
                    'param_name' => 'description',
                    'value' => '',
                ),

                array(
                    'type' => 'dropdown',
                    'admin_label' => false,
                    'edit_field_class' => 'vc_col-sm-6',
                    'heading' => esc_html__( 'Attendant Image', 'tmw-whatsapp' ),
                    'param_name' => 'photo_or_icon',
                    'value' => array(
                        esc_html__( 'Whatsapp Icon', 'tmw-whatsapp' ) => 'icon',
                        esc_html__( 'Attendant Image', 'tmw-whatsapp' ) => 'image', 
                    ),
                    'std' => 'icon',
                ),

                array(
                    'type' => 'dropdown',
                    'admin_label' => false,
                    'edit_field_class' => 'vc_col-sm-6',
                    'heading' => esc_html__( 'Alignment', 'tmw-whatsapp' ),
                    'param_name' => 'alignment',
                    'value' => array(
                        esc_html__( 'Full Width', 'tmw-whatsapp' ) => 'full-width',
                        esc_html__( 'Center', 'tmw-whatsapp' ) => 'center',
                        esc_html__( 'Left', 'tmw-whatsapp' ) => 'left',
                        esc_html__( 'Right', 'tmw-whatsapp' ) => 'right',
                    ),
                    'std' => 'left',
                ),

                // Skin
                array(
                    'type' => 'colorpicker',
                    'admin_label' => false,
                    'edit_field_class' => 'vc_col-sm-6',
                    'class' => '',
                    'heading' => esc_html__( 'Background Color', 'tmw-whatsapp' ),
                    'param_name' => 'background_color',
                    'value' => '#20ab54',
                    'group' => esc_html__( 'Skin', 'tmw-whatsapp' ),
                ),

                array(
                    'type' => 'colorpicker',
                    'admin_label' => false,
                    'edit_field_class' => 'vc_col-sm-6',
                    'class' => '',
                    'heading' => esc_html__( 'Background Hover Color', 'tmw-whatsapp' ),
                    'param_name' => 'background_hover_color',
                    'value' => '#38bd6a',
                    'group' => esc_html__( 'Skin', 'tmw-whatsapp' ),
                ),

                array(
                    'type' => 'colorpicker',
                    'admin_label' => false,
                    'edit_field_class' => 'vc_col-sm-6',
                    'class' => '',
                    'heading' => esc_html__( 'Icon Color', 'tmw-whatsapp' ),
                    'param_name' => 'icon_color',
                    'value' => '#FFF',
                    'group' => esc_html__( 'Skin', 'tmw-whatsapp' ),
                ),

                array(
                    'type' => 'colorpicker',
                    'admin_label' => false,
                    'edit_field_class' => 'vc_col-sm-6',
                    'class' => '',
                    'heading' => esc_html__( 'Icon Hover Color', 'tmw-whatsapp' ),
                    'param_name' => 'icon_hover_color',
                    'value' => '#FFF',
                    'group' => esc_html__( 'Skin', 'tmw-whatsapp' ),
                ),

                array(
                    'type' => 'colorpicker',
                    'admin_label' => false,
                    'edit_field_class' => 'vc_col-sm-6',
                    'class' => '',
                    'heading' => esc_html__( 'Attendant Name Color', 'tmw-whatsapp' ),
                    'param_name' => 'attendant_name_color',
                    'value' => '#FFF',
                    'group' => esc_html__( 'Skin', 'tmw-whatsapp' ),
                ),

                array(
                    'type' => 'colorpicker',
                    'admin_label' => false,
                    'edit_field_class' => 'vc_col-sm-6',
                    'class' => '',
                    'heading' => esc_html__( 'Attendant Name Hover Color', 'tmw-whatsapp' ),
                    'param_name' => 'attendant_name_hover_color',
                    'value' => '#FFF',
                    'group' => esc_html__( 'Skin', 'tmw-whatsapp' ),
                ),

                array(
                    'type' => 'colorpicker',
                    'admin_label' => false,
                    'edit_field_class' => 'vc_col-sm-6',
                    'class' => '',
                    'heading' => esc_html__( 'Attendant Description Color', 'tmw-whatsapp' ),
                    'param_name' => 'attendant_description_color',
                    'value' => '#FFF',
                    'group' => esc_html__( 'Skin', 'tmw-whatsapp' ),
                ),

                array(
                    'type' => 'colorpicker',
                    'admin_label' => false,
                    'edit_field_class' => 'vc_col-sm-6',
                    'class' => '',
                    'heading' => esc_html__( 'Attendant Description Hover Color', 'tmw-whatsapp' ),
                    'param_name' => 'attendant_description_hover_color',
                    'value' => '#FFF',
                    'group' => esc_html__( 'Skin', 'tmw-whatsapp' ),
                ),

                array(
                    'type' => 'colorpicker',
                    'admin_label' => false,
                    'edit_field_class' => 'vc_col-sm-6',
                    'class' => '',
                    'heading' => esc_html__( 'Status Background Color', 'tmw-whatsapp' ),
                    'param_name' => 'status_background_color',
                    'value' => '#FFF',
                    'group' => esc_html__( 'Skin', 'tmw-whatsapp' ),
                ),

                array(
                    'type' => 'colorpicker',
                    'admin_label' => false,
                    'edit_field_class' => 'vc_col-sm-6',
                    'class' => '',
                    'heading' => esc_html__( 'Status Text Color', 'tmw-whatsapp' ),
                    'param_name' => 'status_text_color',
                    'value' => '#212121',
                    'group' => esc_html__( 'Skin', 'tmw-whatsapp' ),
                ),

                array(
                    'type' => 'colorpicker',
                    'admin_label' => false,
                    'edit_field_class' => 'vc_col-sm-6',
                    'class' => '',
                    'heading' => esc_html__( 'Offline Badge Background', 'tmw-whatsapp' ),
                    'param_name' => 'badge_offline_message_background',
                    'value' => '#ebebeb',
                    'group' => esc_html__( 'Skin', 'tmw-whatsapp' ),
                ),

                array(
                    'type' => 'colorpicker',
                    'admin_label' => false,
                    'edit_field_class' => 'vc_col-sm-6',
                    'class' => '',
                    'heading' => esc_html__( 'Offline Message Badge Text', 'tmw-whatsapp' ),
                    'param_name' => 'badge_offline_message_text',
                    'value' => '#000',
                    'group' => esc_html__( 'Skin', 'tmw-whatsapp' ),
                ),

                array(
                    'type' => 'colorpicker',
                    'admin_label' => false,
                    'edit_field_class' => 'vc_col-sm-6',
                    'class' => '',
                    'heading' => esc_html__( 'Interval Badge Background', 'tmw-whatsapp' ),
                    'param_name' => 'badge_interval_background',
                    'value' => '#e2c80c',
                    'group' => esc_html__( 'Skin', 'tmw-whatsapp' ),
                ),

                array(
                    'type' => 'colorpicker',
                    'admin_label' => false,
                    'edit_field_class' => 'vc_col-sm-6',
                    'class' => '',
                    'heading' => esc_html__( 'Interval Badge Text', 'tmw-whatsapp' ),
                    'param_name' => 'badge_interval_text',
                    'value' => '#000',
                    'group' => esc_html__( 'Skin', 'tmw-whatsapp' ),
                ),
       
            ),
        ));             
    }

    /**
     * Attendant Status Output
     *
     */
    public function get_attendant_status_html( $settings ) {
        $output = '';

        $html_tag = 'span';
        $classes = array( 'tmw-whatsapp-elementor-title-status' );
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
    
    public function render_shortcode( $atts, $content, $tag ) {
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
                        if( $settings['photo_or_icon'] === 'icon' ) {
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
            $output .= '#' . $uniqid . '.tmw-whatsapp-elementor-wrapper.tmw-whatsapp-elementor-wrapper-style-1 .tmw-whatsapp-elementor-body { background: '. esc_attr( $atts['background_color'] ) .'; }';
            $output .= '#' . $uniqid . '.tmw-whatsapp-elementor-wrapper:hover .tmw-whatsapp-elementor-body { background: '. esc_attr( $atts['background_hover_color'] ) .'; }';
            $output .= '#' . $uniqid . '.tmw-whatsapp-elementor-wrapper .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-icon { color: '. esc_attr( $atts['icon_color'] ) .'; }';
            $output .= '#' . $uniqid . '.tmw-whatsapp-elementor-wrapper:hover .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-icon { color: '. esc_attr( $atts['icon_hover_color'] ) .'; }';
            $output .= '#' . $uniqid . '.tmw-whatsapp-elementor-wrapper .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-title h5 { color: '. esc_attr( $atts['attendant_name_color'] ) .'; }';
            $output .= '#' . $uniqid . '.tmw-whatsapp-elementor-wrapper:hover .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-title h5 { color: '. esc_attr( $atts['attendant_name_hover_color'] ) .'; }';
            $output .= '#' . $uniqid . '.tmw-whatsapp-elementor-wrapper .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-description p { color: '. esc_attr( $atts['attendant_description_color'] ) .'; }';
            $output .= '#' . $uniqid . '.tmw-whatsapp-elementor-wrapper:hover .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-description p { color: '. esc_attr( $atts['attendant_description_hover_color'] ) .'; }';
            $output .= '#' . $uniqid . '.tmw-whatsapp-elementor-wrapper .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-title .tmw-whatsapp-elementor-title-status { background-color: '. esc_attr( $atts['status_background_color'] ) .'; }';
            $output .= '#' . $uniqid . '.tmw-whatsapp-elementor-wrapper .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-title .tmw-whatsapp-elementor-title-status { color: '. esc_attr( $atts['status_text_color'] ) .'; }';
            $output .= '#' . $uniqid . '.tmw-whatsapp-elementor-wrapper.tmw-whatsapp-elementor-wrapper-style-1 .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-info-offline-message { background-color: '. esc_attr( $atts['badge_offline_message_background'] ) .'; }';
            $output .= '#' . $uniqid . '.tmw-whatsapp-elementor-wrapper.tmw-whatsapp-elementor-wrapper-style-1 .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-info-offline-message { color: '. esc_attr( $atts['badge_offline_message_text'] ) .'; }';
            $output .= '#' . $uniqid . '.tmw-whatsapp-elementor-wrapper.tmw-whatsapp-elementor-wrapper-style-1 .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-info-offline-message.is-interval { color: '. esc_attr( $atts['badge_interval_background'] ) .'; }';
            $output .= '#' . $uniqid . '.tmw-whatsapp-elementor-wrapper.tmw-whatsapp-elementor-wrapper-style-1 .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-info-offline-message.is-interval { color: '. esc_attr( $atts['badge_interval_text'] ) .'; }';
        $output .= '</style>';

        return $output;                  
    }
}
<?php

/**
 * Settings page.
 * 
 * @package Master_Whats_Chat
 */

namespace TMWC\Master_Whats_Chat\Admin;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class SettingsPage {

    /**
     * Constructor.
     * 
     */
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_menu_page' ) );
    }

    /**
     * Add menu page.
     * 
     * @return void
     */
    public function add_menu_page() {
        add_menu_page(
            esc_html__( 'TM Whatsapp', 'master-whats-chat' ),
            esc_html__( 'TM Whatsapp', 'master-whats-chat' ),
            'manage_options',
            'tmwc-whatsapp-settings',
            array(
                $this,
                'render_page',
            ),
            'dashicons-whatsapp',
            3
        );
    }
        
    /**
     * Render page.
     * 
     */
    public function render_page() {
        require TMWC_PLUGIN_PATH . 'inc/default-settings-data.php';

        $data = get_option( 'tmwc_settings_data' );
        if( $data ) {
            foreach( $data as $key_name => $value ) {

                if( !in_array( $key_name, array( 'css_skin' ) ) ) {
                    
                    // Mount the data of attendants
                    if( is_array($value) ) {
                        foreach( $value as $k => $v ) {

                            // Image
                            $imageArr = array();
                            foreach( $v as $image_k => $image_v ) {
                                if( $image_k == 'image' ) {
                                    $imageArr = $image_v;
                                }
                            }

                            // Availability Days
                            $availabilityArr = array();
                            foreach( $v['availability'] as $day => $params ) {
                                $availabilityArr[ $day ] = $params;
                            }

                            $defaults['fields'][ $key_name ]['value'][$k]['id'] = $v['id'];
                            $defaults['fields'][ $key_name ]['value'][$k]['name'] = $v['name'];
                            $defaults['fields'][ $key_name ]['value'][$k]['description'] = $v['description'];
                            $defaults['fields'][ $key_name ]['value'][$k]['start_message'] = $v['start_message'];
                            $defaults['fields'][ $key_name ]['value'][$k]['phone'] = $v['phone'];
                            $defaults['fields'][ $key_name ]['value'][$k]['offline_message'] = $v['offline_message'];
                            $defaults['fields'][ $key_name ]['value'][$k]['interval_message'] = $v['interval_message'];
                            $defaults['fields'][ $key_name ]['value'][$k]['image'] = $imageArr;
                            $defaults['fields'][ $key_name ]['value'][$k]['default_timezone'] = $v['default_timezone'];
                            $defaults['fields'][ $key_name ]['value'][$k]['availability'] = $availabilityArr;

                        }

                    } else if( in_array( $key_name, array( 'whatsapp_move_button-top-bottom', 'whatsapp_move_button-left-right' ) ) ) {

                        switch ( $key_name ) {
                            case 'whatsapp_move_button-top-bottom':
                                $defaults['fields'][ 'whatsapp_move_button' ]['value']['top-bottom'] = $value;
                                break;
                            case 'whatsapp_move_button-left-right':
                                $defaults['fields'][ 'whatsapp_move_button' ]['value']['left-right'] = $value;
                                break;
                        }

                    } else {
                        $defaults['fields'][ $key_name ]['value'] = $value;
                    }

                }
            }
        }

        // RTL Layout
        $rtl_direction_class = '';
        if( $defaults['fields']['rtl_layout']['value'] == true ) {
            $rtl_direction_class = ' tmw-direction-rtl';
        }

        include TMWC_PLUGIN_PATH . 'templates/admin/settings.php';
    }
}
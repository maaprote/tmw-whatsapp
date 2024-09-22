<?php

/**
 * Ajax handlers.
 * 
 * @package Master_Whats_Chat
 */

namespace TMWC\Master_Whats_Chat\Admin;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

use TMWC\Master_Whats_Chat\Admin\SettingsFields;
use TMWC\Master_Whats_Chat\Views\ChatWidget;

class AjaxHandlers {

    /**
     * Constructor.
     * 
     */
    public function __construct() {
        add_action( 'wp_ajax_tmwc_save_settings', array( $this, 'save_settings' ) );
    }

    /**
     * Ajax callback to save the plugin settings
     *
     * @return void
     */
    function save_settings() {
        if ( ! isset( $_POST['data'] ) ) {
            wp_send_json_error( array( 'message' => 'No data received' ) );
        }

        if ( ! isset( $_POST['tmwc_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['tmwc_nonce'] ) ), 'tmw-save-plugin-settings-nonce' ) ) {
            wp_send_json_error( array( 'message' => 'Invalid nonce' ) );
        }
        
        $data = json_decode( sanitize_text_field( wp_unslash( $_POST['data'] ) ));
        $data = SettingsFields::sanitize_data($data);

        unset($data['_wp_http_referer']);

        $reset_settings = false;
        if( isset( $data['reset_settings'] ) && $data['reset_settings'] === 'on' ) {
            delete_option( 'tmwc_settings_data' );
            delete_option( 'tmwc_settings_data_skin_css' );
            $reset_settings = true;
        } else {
            update_option( 'tmwc_settings_data', $data );
            update_option( 'tmwc_settings_data_skin_css', $data['css_skin'] );
        }

        ob_start();
        ChatWidget::instance();
        $app_html = ob_get_clean();

        $send_json = array(
            'success' => true,
            'app_html' => $app_html,
        );

        if( isset($data['debug']) && $data['debug'] === 'on' ) {
            $send_json['debug'] = $data;
        }

        if( $reset_settings ) {
            $send_json['reset_settings'] = true;
        }

        wp_send_json( $send_json );       
    }
}
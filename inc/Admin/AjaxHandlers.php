<?php

/**
 * Ajax handlers.
 * 
 * @package Master_Whats_Chat
 */

namespace TM\Master_Whats_Chat\Admin;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

use TM\Master_Whats_Chat\Admin\SettingsFields;
use TM\Master_Whats_Chat\Views\ChatWidget;

class AjaxHandlers {

    /**
     * Constructor.
     * 
     */
    public function __construct() {
        add_action( 'wp_ajax_tmw_save_settings', array( $this, 'save_settings' ) );
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

        $data = SettingsFields::sanitize_data($_POST['data']); // phpcs:ignore WordPress.Security.NonceVerification, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- Data is sanitized in the function and nonce is verified below

        if ( ! isset( $data['tmw-nonce'] ) || ! wp_verify_nonce( $data['tmw-nonce'], 'tmw-save-plugin-settings-nonce' ) ) {
            wp_send_json_error( array( 'message' => 'Invalid nonce' ) );
        }

        unset($data['tmw-nonce']);
        unset($data['_wp_http_referer']);

        $reset_settings = false;
        if( $data['reset_settings'] === 'on' ) {
            delete_option( 'tmw_whatsapp_settings_data' );
            delete_option( 'tmw_whatsapp_settings_data_skin_css' );
            $reset_settings = true;
        } else {
            update_option( 'tmw_whatsapp_settings_data', $data );
            update_option( 'tmw_whatsapp_settings_data_skin_css', $data['css_skin'] );
        }

        ob_start();
        new ChatWidget();
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
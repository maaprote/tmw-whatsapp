<?php

/**
 * Admin assets.
 * 
 * @package Master_Whats_Chat
 */

namespace TMWC\Master_Whats_Chat\Admin;

use TMWC\Master_Whats_Chat\Functions;

class Assets {

    /**
     * Cosntructor.
     * 
     */
    public function __construct() {
        if ( ! is_admin() ) {
            return;
        }

        // phpcs:ignore WordPress.Security.NonceVerification
        if ( isset( $_GET['page'] ) && ! in_array( $_GET['page'], array( 'tmwc-whatsapp-settings', 'mlang_strings' ), true ) ) {
            return;
        }

        // Enqueue CSS and JS.
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
    }

    /**
	 * Enqueue admin CSS and JS
	 *
     * @return void
	 */
	public function enqueue_scripts() {
		$data_to_localize = array(
            'tmwc_dir'   => TMWC_PLUGIN_PATH,
            'tmwc_uri'   => TMWC_PLUGIN_URL,
            'site_url' => get_site_url(),
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'i18n'     => Functions::get_i18n_data(),
        );

		// Plugin settings data.
		$settings = get_option( 'tmwc_settings_data' );

        wp_enqueue_style( 'tmwc-whatsapp-font', Functions::get_google_fonts_family( $settings ), false, TMWC_VERSION );

        wp_register_style( 'tmwc-whatsapp-admin', TMWC_PLUGIN_URL . 'assets/css/tmw-whatsapp-admin.css', false, TMWC_VERSION );
        wp_enqueue_style( 'tmwc-whatsapp-admin' );

        wp_register_style( 'tmwc-whatsapp-app', TMWC_PLUGIN_URL . 'assets/css/tmw-whatsapp-app.css', false, TMWC_VERSION );
        wp_enqueue_style( 'tmwc-whatsapp-app' );

        $skinCSS = get_option( 'tmwc_settings_data_skin_css' );
        if( isset($settings['skin_font_family_name']) || isset($settings['skin_font_family_name']) && !empty($settings['skin_font_family_name']) ) {
            
            if( empty($skinCSS) ) {
                $skinCSS = '/\* TM Whatsapp Fonts \*/';
            }
            $skinCSS .= '.tmw-whatsapp-trigger-button > a { font-family: '. wp_unslash( $settings['skin_font_family_name'] ) .' }';
            $skinCSS .= '.tmw-whatsapp-trigger-button .tmw-whatsapp-call-to-action > a { font-family: '. wp_unslash( $settings['skin_font_family_name'] ) .' }';
            $skinCSS .= '.tmw-whatsapp-wrapper p, .tmw-whatsapp-wrapper a, .tmw-whatsapp-wrapper span, .tmw-whatsapp-wrapper li, .tmw-whatsapp-wrapper h2, .tmw-whatsapp-wrapper h3, .tmw-whatsapp-wrapper h4, .tmw-whatsapp-wrapper h5, .tmw-whatsapp-wrapper h6, .tmw-whatsapp-wrapper input { font-family: '. wp_unslash( $settings['skin_font_family_name'] ) .' }';
            $skinCSS .= '.tmw-whatsapp-elementor-wrapper p, .tmw-whatsapp-elementor-wrapper a, .tmw-whatsapp-elementor-wrapper span, .tmw-whatsapp-elementor-wrapper li, .tmw-whatsapp-elementor-wrapper h2, .tmw-whatsapp-elementor-wrapper h3, .tmw-whatsapp-elementor-wrapper h4, .tmw-whatsapp-elementor-wrapper h5, .tmw-whatsapp-elementor-wrapper h6 { font-family: '. wp_unslash( $settings['skin_font_family_name'] ) .' }';
            $skinCSS .= '.tmw-whatsapp-elementor-wrapper.tmw-whatsapp-elementor-wrapper-style-1 .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-title h5 { font-family: '. wp_unslash( $settings['skin_font_family_name'] ) .' }';
            $skinCSS .= '.tmw-whatsapp-elementor-wrapper.tmw-whatsapp-elementor-wrapper-style-1 .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-title .tmw-whatsapp-elementor-title-status { font-family: '. wp_unslash( $settings['skin_font_family_name'] ) .' }';
            $skinCSS .= '.tmw-whatsapp-elementor-wrapper.tmw-whatsapp-elementor-wrapper-style-1 .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-description p { font-family: '. wp_unslash( $settings['skin_font_family_name'] ) .' }';
            $skinCSS .= '.tmw-whatsapp-elementor-wrapper.tmw-whatsapp-elementor-wrapper-style-2 .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-title h5 { font-family: '. wp_unslash( $settings['skin_font_family_name'] ) .' }';
            $skinCSS .= '.tmw-whatsapp-elementor-wrapper.tmw-whatsapp-elementor-wrapper-style-2 .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-title .tmw-whatsapp-elementor-title-status { font-family: '. wp_unslash( $settings['skin_font_family_name'] ) .' }';
            $skinCSS .= '.tmw-whatsapp-elementor-wrapper.tmw-whatsapp-elementor-wrapper-style-2 .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-description p { font-family: '. wp_unslash( $settings['skin_font_family_name'] ) .' }';
        }

        if( !empty($skinCSS) ) {
            wp_add_inline_style( 'tmwc-whatsapp-app', $skinCSS );
        }

        wp_register_style( 'bootstrap-grid', TMWC_PLUGIN_URL . '/assets/vendor/bootstrap-grid/bootstrap-grid.min.css', false, TMWC_VERSION );
        wp_enqueue_style( 'bootstrap-grid' );

        wp_register_style( 'tmwc-whatsapp-fontawesome-custom', TMWC_PLUGIN_URL . '/assets/vendor/tmw-fontawesome-custom/css/all.css', false, TMWC_VERSION );
        wp_enqueue_style( 'tmwc-whatsapp-fontawesome-custom' );

        wp_register_style( 'flatpickr', TMWC_PLUGIN_URL . '/assets/vendor/flatpickr/flatpickr.min.css', false, TMWC_VERSION );
        wp_enqueue_style( 'flatpickr' );

        wp_register_script( 'flatpickr', TMWC_PLUGIN_URL . 'assets/vendor/flatpickr/flatpickr.min.js', false, TMWC_VERSION, true );
        wp_enqueue_script( 'flatpickr' );

        wp_enqueue_script( 'moment' );

        wp_register_script( 'moment-timezone-with-data', TMWC_PLUGIN_URL . 'assets/vendor/moment/moment-timezone-with-data.min.js', false, TMWC_VERSION, true );
        wp_enqueue_script( 'moment-timezone-with-data' );

        wp_register_script( 'tmwc-whatsapp-admin', TMWC_PLUGIN_URL . 'assets/js/tmw-whatsapp-admin.js', array( 'jquery', 'jquery-ui-tabs', 'wp-color-picker' ), TMWC_VERSION, true );
        wp_localize_script( 'tmwc-whatsapp-admin', 'tmwc_data', $data_to_localize );
        wp_enqueue_script( 'tmwc-whatsapp-admin' );

        wp_register_script( 'tmwc-whatsapp-app', TMWC_PLUGIN_URL . 'assets/js/tmw-whatsapp-app.js', array( 'jquery' ), TMWC_VERSION, true );
        wp_enqueue_script( 'tmwc-whatsapp-app' );

        wp_enqueue_media();

        // phpcs:ignore WordPress.Security.NonceVerification
		if( class_exists( 'WooCommerce' ) && ( isset( $_GET['post'] ) && 'product' === get_post_type( sanitize_text_field( wp_unslash( $_GET['post'] ) ) ) ) ) {
			wp_register_style( 'tmwc-whatsapp-admin', TMWC_PLUGIN_URL . 'assets/css/tmw-whatsapp-admin.css', array(), TMWC_VERSION );
			wp_enqueue_style( 'tmwc-whatsapp-admin' );
		}

		wp_register_script( 'tmwc-whatsapp-widgets', TMWC_PLUGIN_URL . 'assets/js/tmw-whatsapp-widgets.js', array( 'jquery' ), TMWC_VERSION, true );
		wp_localize_script( 'tmwc-whatsapp-widgets', 'tmwc_data', $data_to_localize );
		wp_enqueue_script( 'tmwc-whatsapp-widgets' );

		// Dequeue script from Polyland breaking the WPBakery Fron End Editor.
		if( isset($_GET['vc_action']) && ( isset( $_GET['vc_action'] ) && sanitize_text_field( wp_unslash( $_GET['vc_action'] ) ) === 'vc_inline' ) ) { // phpcs:ignore WordPress.Security.NonceVerification
			wp_dequeue_script( 'pll_block-editor' );
		}
	}
}
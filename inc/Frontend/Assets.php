<?php

/**
 * Frontend assets.
 * 
 * @package Master_Whats_Chat
 */

namespace TM\Master_Whats_Chat\Frontend;

use TM\Master_Whats_Chat\Functions;

class Assets {

    /**
     * Cosntructor.
     * 
     */
    public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_print_styles', array( $this, 'print_styles' ) );
    }

	/**
	 * Enqueue CSS and JS.
	 * 
	 * @return void
	 */
	public function enqueue_scripts() {
		$data_to_localize = array(
            'tmw_dir'   => TM_MASTER_WHATS_CHAT_PATH,
            'tmw_uri'   => TM_MASTER_WHATS_CHAT_URL,
            'site_url' => get_site_url(),
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'i18n'     => Functions::get_i18n_data(),
        );
		
		// Plugin User Settings
		$settings = get_option( 'tmw_whatsapp_settings_data' );

		wp_enqueue_style( 'tmw-whatsapp-font', Functions::get_google_fonts_family( $settings ), false );
		
		wp_register_style( 'tmw-whatsapp-fontawesome-custom', TM_MASTER_WHATS_CHAT_URL . '/assets/vendor/tmw-fontawesome-custom/css/all.css' );
		wp_enqueue_style( 'tmw-whatsapp-fontawesome-custom' );

		wp_register_style( 'tmw-whatsapp-app', TM_MASTER_WHATS_CHAT_URL . '/assets/css/tmw-whatsapp-app.css' );
		wp_enqueue_style( 'tmw-whatsapp-app' );
		
		$skinCSS = get_option( 'tmw_whatsapp_settings_data_skin_css' );
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
			wp_add_inline_style( 'tmw-whatsapp-app', $skinCSS );
		}

		wp_register_script( 'moment', TM_MASTER_WHATS_CHAT_URL . '/assets/vendor/moment/moment.min.js', false, TM_MASTER_WHATS_CHAT_VERSION, true );
		wp_enqueue_script( 'moment' );

		wp_register_script( 'moment-timezone-with-data', TM_MASTER_WHATS_CHAT_URL . '/assets/vendor/moment/moment-timezone-with-data.min.js', false, TM_MASTER_WHATS_CHAT_VERSION, true );
		wp_enqueue_script( 'moment-timezone-with-data' );

		wp_register_script( 'tmw-whatsapp-app', TM_MASTER_WHATS_CHAT_URL . '/assets/js/tmw-whatsapp-app.js', array( 'jquery' ), TM_MASTER_WHATS_CHAT_VERSION, true );
		wp_localize_script( 'tmw-whatsapp-app', 'tmw_data', $data_to_localize );
		wp_enqueue_script( 'tmw-whatsapp-app' );

		wp_register_script( 'tmw-whatsapp-widgets', TM_MASTER_WHATS_CHAT_URL . '/assets/js/tmw-whatsapp-widgets.js', array( 'jquery' ), TM_MASTER_WHATS_CHAT_VERSION, true );
		wp_localize_script( 'tmw-whatsapp-widgets', 'tmw_data', $data_to_localize );
	}

    /**
	 * Print styles.
	 *
     * @return void
	 */
	public function print_styles() {
        global $post;

        if( empty( $post ) ) {
			global $post;
		}

        $settings = Functions::get_settings();

		// Register widgets script
		wp_register_script( 'tmw-whatsapp-widgets', TM_MASTER_WHATS_CHAT_URL . '/js/tmw-whatsapp-widgets.js', array( 'jquery' ), TM_MASTER_WHATS_CHAT_VERSION, true );

		// Pages
		if( isset( $post->post_content ) && is_page() ) {
			if( has_shortcode( $post->post_content, 'tmw_whatsapp_button') || has_shortcode( $post->post_content, 'tmw_whatsapp_button_wp') || strpos( $post->post_content, 'data-phone-number' ) !== FALSE ) {
				wp_enqueue_style( 'tmw-whatsapp-font', Functions::get_google_fonts_family( $settings ), false, TM_MASTER_WHATS_CHAT_VERSION );
				wp_enqueue_script( 'tmw-whatsapp-widgets' );
			} 
		}

		// Single Pages Only
		if( isset( $post->post_content ) && is_singular() ) {
			if( has_shortcode( $post->post_content, 'tmw_whatsapp_button') || has_shortcode( $post->post_content, 'tmw_whatsapp_button_wp') || strpos( $post->post_content, 'data-phone-number' ) !== FALSE ) {
				wp_enqueue_style( 'tmw-whatsapp-font', Functions::get_google_fonts_family( $settings ), false, TM_MASTER_WHATS_CHAT_VERSION );
				wp_enqueue_script( 'tmw-whatsapp-widgets' );
			} 
		}

		// Shop Archive / Product Categories Pages
		if( class_exists('WooCommerce') ) {
			if( is_shop() || taxonomy_exists( 'product_cat' ) ) {
				global $wp_query;
	
				foreach( $wp_query->posts as $_post ) {
					if( get_post_meta( $_post->ID, 'tmw_show_woocommerce_button', false ) ) {
						wp_enqueue_style( 'tmw-whatsapp-font', Functions::get_google_fonts_family( $settings ), false, TM_MASTER_WHATS_CHAT_VERSION );
						wp_enqueue_script( 'tmw-whatsapp-widgets' );
					} 
				}
			}
		}
	}
}
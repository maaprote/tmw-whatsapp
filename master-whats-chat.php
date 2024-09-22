<?php
/**
 * Plugin Name: Master Whats Chat
 * Description: Chat plugin with a beatiful interface which allows to your website visitors to contact your team with few clicks.
 * Version:     1.0.0
 * Author:      Rodrigo Teixeira
 * Author URI:  https://github.com/maaprote/
 * License:     GPLv3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: master-whats-chat
 * Domain Path: /languages
 *
 * WC requires at least: 6.0
 * WC tested up to: 8.8.3
 *
 * @package Master_Whats_Chat
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

define( 'TMWC_VERSION', '1.0.0' );
define( 'TMWC_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'TMWC_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

use TMWC\Master_Whats_Chat\Admin\AjaxHandlers as Admin_Ajax_Handlers;
use TMWC\Master_Whats_Chat\Admin\Assets as Admin_Assets;
use TMWC\Master_Whats_Chat\Admin\SettingsPage as Admin_Settings_Page;
use TMWC\Master_Whats_Chat\Shortcodes\Button as Button_Shortcode;
use TMWC\Master_Whats_Chat\Widgets\Button as Button_Widget;
use TMWC\Master_Whats_Chat\Integration\Elementor\Button as Elementor_Widget_Button;
use TMWC\Master_Whats_Chat\Integration\WPBakery\Button as WPBakery_Widget_Button;
use TMWC\Master_Whats_Chat\Frontend\Assets as Frontend_Assets;
use TMWC\Master_Whats_Chat\Frontend\RenderChat;
use TMWC\Master_Whats_Chat\Integration\WooCommerce\Admin\Metabox as WooCommerce_Metabox;
use TMWC\Master_Whats_Chat\Integration\WooCommerce\SingleProductButton;

class TMWC_Master_Whats_Chat {

    /**
     * Cosntructor.
     * 
     */
    public function __construct() {
        require 'vendor/autoload.php';

        // Textdomain.
        add_action( 'init', array( $this, 'load_textdomain' ) );

        // Admin.
        new Admin_Ajax_Handlers();
        new Admin_Assets();
        new Admin_Settings_Page();

        // Shortcodes.
        new Button_Shortcode();

        // Widgets.
        new Button_Widget();

        // Elementor Widget
		if( class_exists('\Elementor\Plugin') ) {
			add_action( 'elementor/widgets/widgets_registered', function() {
				\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Elementor_Widget_Button() );
			}); 
		}

        // WPBakery.
        if ( defined( 'WPB_VC_VERSION' ) ) {
            new WPBakery_Widget_Button();
        }

        // WPML Strings Translation.
		if( class_exists( 'SitePress' ) ) {
			add_action( 'wpml_st_loaded', array( $this, 'tmwc_wpml_register_strings' ) );
		}

		// Polylang Strings Translation.
		if( class_exists( 'Polylang' ) ) {
			add_action( 'init', array( $this, 'tmwc_polylang_register_strings' ) );
		}

        // Frontend Assets.
        new Frontend_Assets();

        // WooCommerce.
        if ( class_exists( 'WooCommerce' ) ) {
            new WooCommerce_Metabox();
            new SingleProductButton();
        }

        // Render the chat.
        new RenderChat();
    }

    /**
     * Load textdomain.
     * 
     * @return void
     */
    public function load_textdomain() {
        load_plugin_textdomain( 'master-whats-chat', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
    }
}

new TMWC_Master_Whats_Chat();
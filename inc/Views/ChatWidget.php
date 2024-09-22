<?php

/**
 * Chat widget.
 * 
 * @package Master_Whats_Chat
 */

namespace TMWC\Master_Whats_Chat\Views;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

use TMWC\Master_Whats_Chat\Functions;
use TMWC\Master_Whats_Chat\Translator;
use TMWC\Master_Whats_Chat\Views\OpenChatButton;

class ChatWidget {

    /**
     * Constructor.
     * 
     */
    public function __construct() {
        $this->render_widget();
    }

	/**
	 * Singleton
	 * 
	 */
	public static function instance() {
		static $instance = null;

		if( $instance === null ) {
			$instance = new self();
		}
		
		return $instance;
	}

    public function hide_from_pages() {
        if( is_admin() ) {
			return false;
		}

		global $post;

		$hide_from_pages = false;
		if( ! empty( Functions::get_setting('whatsapp_hide_from_pages') ) ) {
			$hide_from_pages = explode( ',', Functions::get_setting('whatsapp_hide_from_pages') );
		}

		if( $hide_from_pages && in_array( $post->ID, $hide_from_pages, true ) ) {
			return true;
		}

		return false;
    }

    /**
	 * Show the floating whatsapp button in specific pages
	 *
     * @return boolean
	 */
	public function is_allowed_page() {
		if( is_admin() ) {
			return true;
		}

		global $post;

		$settings = Functions::get_settings();
		
		$show_on_pages = false;
		if( !empty(Functions::get_setting('whatsapp_show_on_pages')) ) {
			$show_on_pages = explode( ',', Functions::get_setting('whatsapp_show_on_pages') );
		}

		if( $show_on_pages && in_array( $post->ID, $show_on_pages, true ) ) {
			return true;
		}

		if( empty( Functions::get_setting('whatsapp_show_on_pages') ) ) {
			return true;
		}

		return false;
	}

    /**
	 * Special Variables
	 * Useful for options like "Whatsapp Web Start Message"
	 *
     * @param string $str
     * 
     * @return string
	 */
	public function replace_special_variables( $str ) {
		$post_ids = get_posts( array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'fields' => 'ids',
			'posts_per_page' => -1,
		) );
		
		foreach( $post_ids as $post_id ) {

			if( strpos( $str, "{{post_title:$post_id}}" ) !== FALSE  ) {
				$str = str_replace( "{{post_title:$post_id}}", get_the_title( $post_id ), $str );
			}

			if( strpos( $str, "{{post_link:$post_id}}" ) !== FALSE  ) {
				$str = str_replace( "{{post_link:$post_id}}", get_the_permalink( $post_id ), $str );
			}
			
		}

		// Pages
		$page_ids = get_posts( array(
			'post_type' => 'page',
			'post_status' => 'publish',
			'fields' => 'ids',
			'posts_per_page' => -1,
		) );

		foreach( $page_ids as $page_id ) {

			if( strpos( $str, "{{page_title:$page_id}}" ) !== FALSE  ) {
				$str = str_replace( "{{page_title:$page_id}}", get_the_title( $page_id ), $str );
			}

			if( strpos( $str, "{{page_link:$page_id}}" ) !== FALSE  ) {
				$str = str_replace( "{{page_link:$page_id}}", get_the_permalink( $page_id ), $str );
			}
			
		}

		// WooCommerce Products
		if( class_exists( 'WooCommerce' ) ) {
			$product_ids = get_posts( array(
				'post_type' => 'product',
				'post_status' => 'publish',
				'fields' => 'ids',
				'posts_per_page' => -1,
			) );
			
			foreach( $product_ids as $product_id ) {
	
				if( strpos( $str, "{{woo_product_title:$product_id}}" ) !== FALSE  ) {
					$str = str_replace( "{{woo_product_title:$product_id}}", get_the_title( $product_id ), $str );
				}

				if( strpos( $str, "{{woo_product_link:$product_id}}" ) !== FALSE  ) {
					$str = str_replace( "{{woo_product_link:$product_id}}", get_the_permalink( $product_id ), $str );
				}

			}

		}

		return $str;
	}

    /**
	 * Get the excerpt of certain string
	 *
     * @param string $text
     * @param int $limit
     * 
     * @return string
	 */
	public function get_excerpt($text, $limit) {
        $excerpt = explode(' ', $text, $limit);

        if (count($excerpt) >= $limit) {
            array_pop($excerpt);
            $excerpt = implode(" ", $excerpt) . '...';
        } else {
            $excerpt = implode(" ", $excerpt);
        }

        $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);

        return $excerpt;
    }

    /**
     * Format phone number
     *
     * @param string $str
     * 
     * @return string
     */
    public function format_phone_number( $str ) {
        $str = preg_replace("/[^0-9]/", "", $str);
        return $str;
    }
    
    /**
     * Render the widget.
     * 
     * @return void
     */
    public function render_widget() { 
		if( $this->hide_from_pages() ) {
			return false;
		}

		if( $this->is_allowed_page() === false ) {
			return false;
		}

		$settings = Functions::get_settings();

		$wrapper_classes = array( 'tmw-whatsapp-wrapper tmw-whatsapp-wrapper-fixed tmw-hide' );
		$wrapper_atts    = array();
		$wrapper_styles  = array();

		// RTL
		$rtl_layout = Functions::get_setting('rtl_layout');
		if( isset( $rtl_layout ) && $rtl_layout ) {
			$wrapper_classes[] = 'tmw-direction-rtl';
		}

		// Position
		$wrapper_classes[] = 'tmw-whats-app-wrapper-' . Functions::get_setting('position');

		// Open WhatsApp Chat Type
		switch ( Functions::get_setting('open_whatsapp_type') ) {
			case 'click-icon':
				$wrapper_atts[] = 'data-tmw-open-whatsapp-chat-type="click-icon"';
				break;

			case 'select-attendant':
				$wrapper_atts[] = 'data-tmw-open-whatsapp-chat-type="select-attendant"';
				break;

			case 'click-chat-send':
			default:
				$wrapper_atts[] = 'data-tmw-open-whatsapp-chat-type="click-chat-send"';
				break;

		}

		// If none attendant is registered, show a message for it
		if( !isset($settings['attendants']) && !Functions::get_setting('attendants') || !is_array( Functions::get_setting('attendants') ) ) {
			$wrapper_classes[] = 'tmw-whatsapp-none-attendants';
		}

		// Whatsapp Web Start Message
		$wrapper_atts[] = 'data-tmw-whatsapp-web-start-message="'. esc_attr( Translator::translate_string( $this->replace_special_variables( Functions::get_setting('whatsapp_initial_message') ), 'whatsapp_initial_message' ) ) .'"';

		// No Footer
		if( !isset( $settings['footer_show'] ) && Functions::get_setting('footer_show') !== 'on' ) {
			$wrapper_classes[] = 'tmw-whatsapp-no-footer';
		}

		// Move Button
		$x = $y = 0;
		if( isset($settings['whatsapp_move_button-left-right']) ) {
			$x = Functions::get_setting('whatsapp_move_button-left-right');
		}

		if( isset($settings['whatsapp_move_button-top-bottom']) ) {
			$y = Functions::get_setting('whatsapp_move_button-top-bottom');
		}

		// Open conversation chat for specific attendant after X seconds
		if( isset($settings['whatsapp_open_chat_with_attendant']) && Functions::get_setting('whatsapp_open_chat_with_attendant') ) {
			$wrapper_atts[] = 'data-open-chat-with="'. esc_attr( Functions::get_setting('whatsapp_open_chat_with_attendant_id') ) .'" data-open-chat-with-delay="'. esc_attr( Functions::get_setting('whatsapp_open_chat_with_attendant_delay') ) .'"';
		}

		// How the plugin should be iniitilized
		$wrapper_atts[] = 'data-init-method="'. esc_attr( Functions::get_setting('performance_how_plugin_init') ) .'"';
		if( isset($settings['performance_after_few_seconds_delay']) && !empty(Functions::get_setting('performance_after_few_seconds_delay')) ) {
			$wrapper_atts[] = 'data-init-method-delay="'. esc_attr( Functions::get_setting('performance_after_few_seconds_delay') ) .'"';
		}
		
		$wrapper_styles[] = 'transform: translate3d('. esc_attr( $x ) .'px, '. esc_attr( $y ) .'px, 0)';

		// Mount Wrapper Class
		$wrapper_atts[] = 'class="'. implode( ' ', $wrapper_classes ) .'"';

		// Mount Wrapper Style
		$wrapper_atts[] = 'style="'. implode( ' ;', $wrapper_styles ) .'"';

		?>

		<div <?php echo wp_kses_post( ( implode( ' ', $wrapper_atts ) ) ); ?>>
			<div class="tmw-whatsapp-card">
				<div class="tmw-whatsapp-card-header">

					<?php 
					// If has attendants show the normal header
					if( isset($settings['attendants']) && Functions::get_setting('attendants') && is_array( Functions::get_setting('attendants') ) ) : ?>
						<div class="tmw-whatsapp-presentation-info">
							<h2><?php echo Functions::get_setting('header_title') ? esc_html( Translator::translate_string( Functions::get_setting('header_title'), 'header_title' ) ) : esc_html( Translator::translate_string( __( 'Hello!', 'master-whats-chat' ), 'header_title', true ) ); ?></h2>
							<p><?php echo Functions::get_setting('header_description') ? esc_html( Translator::translate_string( Functions::get_setting('header_description'), 'header_description' ) ) : esc_html( Translator::translate_string( __( 'Any questions? Feel free to chat with our attendants.', 'master-whats-chat' ), 'header_description', true ) ); ?></p>
							<?php if( Functions::get_setting('header_phone') ) : ?>
								<a href="tel:<?php echo esc_attr( $this->format_phone_number( Translator::translate_string( Functions::get_setting('header_phone'), 'header_phone' ) ) ); ?>"><strong><?php echo esc_html( Translator::translate_string( Functions::get_setting('header_phone'), 'header_phone' ) ); ?></strong></a>
							<?php endif; ?>
							<?php if( Functions::get_setting('header_email') ) : ?>
								<a href="mailto:<?php echo esc_attr( Translator::translate_string( Functions::get_setting('header_email'), 'header_email' ) ); ?>"><?php echo esc_html( Translator::translate_string( Functions::get_setting('header_email'), 'header_email' ) ); ?></a>
							<?php endif; ?>
						</div>
						<div class="tmw-whatsapp-active-attendant-info tmw-hide">
							<a href="#" class="tmw-whatsapp-active-attendant-info-back">
								<i class="tmw-fas tmw-fa-arrow-left"></i>
							</a>
							<img class="tmw-whatsapp-attendant-info-image" src="<?php echo esc_url( TMWC_PLUGIN_URL ); ?>/img/user-placeholder.png" width="50" height="50" alt="John Doe" />
							<div class="tmw-whatsapp-attedant-info-title">
								<h2><?php echo esc_html( Translator::translate_string( 'John Doe Junior', 'default_attendant_info_title' ) ) ?></h2>
								<p><?php echo esc_html( Translator::translate_string( 'online', 'status_online_lowercase' ) ); ?></p>
							</div>
						</div>
					<?php 
					// If has none attendant registered, show none attendants message
					else : ?>
						<div class="tmw-whatsapp-presentation-info">
						
							<p><?php echo esc_html( Translator::translate_string( Functions::get_setting('header_no_attendants_registered'), 'header_no_attendants_registered', false, __( 'Sorry! But we have no attendants at this moment! In this mean time, you can contact us trough the phone or email below:', 'master-whats-chat' ) ) ); ?></p>
							<?php if( Functions::get_setting('header_phone') ) : ?>
								<a href="tel:<?php echo esc_attr( $this->format_phone_number( Translator::translate_string( Functions::get_setting('header_phone'), 'header_phone' ) ) ) ?>"><strong><?php echo esc_html( Translator::translate_string( Functions::get_setting('header_phone'), 'header_phone' ) ); ?></strong></a>
							<?php endif; ?>
							<?php if( Functions::get_setting('header_email') ) : ?>
								<a href="mailto:<?php echo esc_attr( Translator::translate_string( Functions::get_setting('header_email'), 'header_email' ) ); ?>"><?php echo esc_html( Translator::translate_string( Functions::get_setting('header_email'), 'header_email' ) ); ?></a>
							<?php endif; ?>
						</div>
					<?php endif; ?>
					
				</div>

				<div class="tmw-whatsapp-card-body"<?php echo ( Functions::get_setting('chat_image_background') ? 'style="background-image: url('. esc_url( wp_get_attachment_url( Functions::get_setting('chat_image_background') ) ) .')"' : '' ); ?>>

					<?php if( isset($settings['attendants']) && Functions::get_setting('attendants') && is_array(Functions::get_setting('attendants')) ) : ?>
						<?php foreach( Functions::get_setting('attendants') as $attendantObj ) : 

							// Attendant Availability Days and Hours
							$attendantAvailability = base64_encode( wp_json_encode( $attendantObj['availability'] ) ); ?>

							<a href="#" class="tmw-whatsapp-attendant" data-start-message="<?php echo esc_attr( Translator::translate_string( esc_attr( $attendantObj['start_message'] ), 'attendant_'. esc_attr( $attendantObj['id'] ) .'_start_message' ) ); ?>" data-phone="<?php echo esc_attr( Translator::translate_string( esc_attr( $attendantObj['phone'] ), 'attendant_'. esc_attr( $attendantObj['id'] ) .'_phone' ) ); ?>" data-availability="<?php echo esc_attr( $attendantAvailability ) ?>" data-default-timezone="<?php echo esc_attr( $attendantObj['default_timezone'] ); ?>">
								<div class="tmw-whatsapp-attendant-image">
									<?php if( isset($attendantObj['image']) && !empty($attendantObj['image']['attendant-image']) ) : ?>
										<img src="<?php echo esc_url( wp_get_attachment_url( $attendantObj['image']['attendant-image'] ) ); ?>" width="<?php echo esc_attr( $attendantObj['image']['attendant-image_width'] ); ?>" height="<?php echo esc_attr( $attendantObj['image']['attendant-image_height'] ); ?>" alt="" />
									<?php else : ?>

										<img src="<?php echo esc_url( TMWC_PLUGIN_URL ); ?>/img/user-placeholder.png" width="150" height="151" alt="<?php echo esc_attr( $attendantObj['name'] ); ?>" />

									<?php endif; ?>
								</div>
								<div class="tmw-whatsapp-attendant-info">
									<h3><?php echo esc_html( Translator::translate_string( $attendantObj['name'], 'attendant_'. $attendantObj['id'] .'_name' ) ); ?> </h3>
									<p><?php echo esc_html( Translator::translate_string( $attendantObj['description'], 'attendant_'. $attendantObj['id'] .'_description' ) ); ?></p>
									<?php if( isset( $attendantObj['offline_message'] ) && !empty( $attendantObj['offline_message'] ) ) : ?>
										<p class="tmw-whastapp-attendant-info-offline-message"><strong><?php echo esc_html( Translator::translate_string( $attendantObj['offline_message'], 'attendant_'. $attendantObj['id'] .'_offline_message', false ) ); ?></strong></p>
									<?php endif; ?>
									<?php if( isset( $attendantObj['interval_message'] ) && !empty( $attendantObj['interval_message'] ) ) : ?>
										<p class="tmw-whastapp-attendant-info-offline-message is-interval"><strong><?php echo esc_html( Translator::translate_string( $attendantObj['interval_message'], 'attendant_'. $attendantObj['id'] .'_interval_message', false ) ); ?></strong></p>
									<?php endif; ?>
								</div>
								<div class="tmw-whatsapp-attendant-status">
									<p class="tmw-whatsapp-attendant-status-online tmw-d-none"><?php echo esc_html( Translator::translate_string( __( 'Online', 'master-whats-chat' ), 'status_online' ) ); ?></p>
									<p class="tmw-whatsapp-attendant-status-offline tmw-d-none"><?php echo esc_html( Translator::translate_string( __( 'Offline', 'master-whats-chat' ), 'status_offline' ) ); ?></p>
									<p class="tmw-whatsapp-attendant-status-interval tmw-d-none"><?php echo esc_html( Translator::translate_string( __( 'Interval', 'master-whats-chat' ), 'status_interval' ) ); ?></p>
								</div>
							</a>

						<?php endforeach; ?>
					<?php endif; ?>

					<!-- Attendants Chat Window -->
					<div class="tmw-whatsapp-attendant-chat-window">
						<p class="tmw-whatsapp-attendant-chat-message">
							<?php echo esc_html( Translator::translate_string( __( 'Hello! How can I help you ?', 'master-whats-chat' ), 'default_start_message' ) ); ?>
						</p>
						<div class="tmw-whatsapp-attendant-chat-window-footer">
							<input type="text" class="tmw-whatsapp-attendant-chat-input-message" value="" placeholder="<?php echo esc_attr( Translator::translate_string( __( 'Type a message...', 'master-whats-chat' ), 'type_a_message' ) ); ?>" />
							<a href="#" class="tmw-whatsapp-attendant-chat-send-button">
								<i class="tmw-fas tmw-fa-paper-plane"></i>
							</a>
						</div>
					</div>
				</div>
				<?php if( isset($settings['footer_show']) && Functions::get_setting('footer_show') == 'on' ) : ?>
					<div class="tmw-whatsapp-card-footer">
						<?php if( Functions::get_setting('footer_message') ) : ?>
							<p><?php echo esc_html( Translator::translate_string( Functions::get_setting('footer_message'), 'footer_message' ) ); ?></p>
						<?php endif; ?>
						<?php if( Functions::get_setting('footer_phone') || Functions::get_setting('footer_email') ) : ?>
						<p>
							<?php if( Functions::get_setting('footer_phone') ) : ?>
							<a href="tel:<?php echo esc_attr( $this->format_phone_number( Translator::translate_string( Functions::get_setting('footer_phone'), 'footer_phone' ) ) ) ?>"><?php echo esc_html( Translator::translate_string( Functions::get_setting('footer_phone'), 'footer_phone' ) ); ?></a>
							<?php endif; ?>
							<?php if( Functions::get_setting('footer_email') ) : ?>
							 / 
							<a href="mailto:<?php echo esc_attr( Translator::translate_string( Functions::get_setting('footer_email'), 'footer_email' ) ); ?>"><?php echo esc_html( Translator::translate_string( Functions::get_setting('footer_email'), 'footer_email' ) ); ?></a>
							<?php endif; ?>
						</p>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		
        <?php 
        
        // Render the button to open the chat.
        OpenChatButton::instance();
	}
}
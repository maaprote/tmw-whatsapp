<?php

/**
 * WooCommerce Metabox.
 * 
 * @package Master_Whats_Chat
 */

namespace TMWC\Master_Whats_Chat\Integration\WooCommerce\Admin;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class Metabox {

    /**
     * Constructor.
     * 
     */
    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
        add_action( 'save_post', array( $this, 'save_metabox' ) );
    }

    /**
     * Add metabox.
     * 
     * @param object $post
     */
    public function add_meta_box( $post_type ) {
        $post_types = array( 'product' );
 
        if ( in_array( $post_type, $post_types ) ) {
            add_meta_box(
                'tmwc_woocommerce_button',
                esc_html__( 'TM WhatsApp Button', 'master-whats-chat' ),
                array( $this, 'render_woocommerce_metabox_content' ),
                $post_type,
                'side',
                'low'
            );
        }
	}

    /**
     * Render the metabox.
     * 
     * @param object $post
     * 
     * @return void
     */
    public function render_woocommerce_metabox_content( $post ) {
        wp_nonce_field( 'tmwc_side_metabox', 'tmwc_custom_security_nonce' );
 
        // Use get_post_meta to retrieve an existing value from the database.
        $attendant_id                 = get_post_meta( $post->ID, 'tmwc_woocommerce_button_attendant_id', true );
		$button_layout                = get_post_meta( $post->ID, 'tmwc_woocommerce_button_layout', true );
		$attendant_photo_or_icon      = get_post_meta( $post->ID, 'tmwc_woocommerce_button_attendant_photo_or_icon', true );
		$attendant_title              = get_post_meta( $post->ID, 'tmwc_woocommerce_button_attendant_title', true );
		$attendant_description        = get_post_meta( $post->ID, 'tmwc_woocommerce_button_attendant_description', true );
		$button_position              = get_post_meta( $post->ID, 'tmwc_woocommerce_button_position', true );
		$button_position_shop_archive = get_post_meta( $post->ID, 'tmwc_woocommerce_button_position_shop_archive', true );
		$show_woo_button              = get_post_meta( $post->ID, 'tmwc_show_woocommerce_button', true );

        // Display the form, using the current value.
        ?>

		<p><?php echo esc_html__( 'Select an attendant to show along with WooCommerce product buy button.', 'master-whats-chat' ); ?></p>
        <p>
			<label>
				<strong><?php echo esc_html__( 'Show Button?', 'master-whats-chat' ); ?></strong>
				<input type="checkbox" name="tmwc_show_woocommerce_button" <?php checked( $show_woo_button, 'on', true ); ?> /> 
			</label>
			
		</p>
		<p>
			<label class="tmw-label"><?php echo esc_html__( 'Attendant', 'master-whats-chat' ); ?></label>
			<?php if( isset($this->get_field['attendants']) && $this->get_field['attendants'] ) : ?>
				<select class="tmw-input" name="tmwc_woocommerce_button_attendant_id">
					<?php foreach( $this->get_field['attendants'] as $attendant ) : ?>

						<option value="<?php echo esc_attr( $attendant['id'] ); ?>"<?php selected( $attendant['id'], $attendant_id, true ); ?>><?php echo esc_html( $attendant['name'] ); ?></option>

					<?php endforeach; ?>
				</select>
			<?php else : ?>

				<?php echo esc_html__( 'None attendant registered for select here.', 'master-whats-chat' ); ?>

			<?php endif; ?>
		</p>
		<p>
			<label class="tmw-label"><?php echo esc_html__( 'Button Layout', 'master-whats-chat' ); ?></label>
			<select class="tmw-input" name="tmwc_woocommerce_button_layout">
				<?php 
				// WooCommerce Hooks Positions
				$button_layouts = array(
					esc_html__( 'Rounded', 'master-whats-chat' ) => 'tmw-whatsapp-elementor-wrapper-style-1',
					esc_html__( 'Squared', 'master-whats-chat' ) => 'tmw-whatsapp-elementor-wrapper-style-1 tmw-whatsapp-elementor-wrapper-style-1-rounded',
				);
				
				foreach( $button_layouts as $label => $value ) : ?>
					<option value="<?php echo esc_attr( $value ) ?>"<?php selected( $value, $button_layout, true ); ?>><?php echo esc_html( $label ); ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<p>
			<label class="tmw-label"><?php echo esc_html__( 'Attendant Image', 'master-whats-chat' ); ?></label>
			<select class="tmw-input" name="tmwc_woocommerce_button_attendant_photo_or_icon">
				<?php 
				// WooCommerce Hooks Positions
				$attendant_image_types = array(
					esc_html__( 'Attendant Image', 'master-whats-chat' ) => 'image',
					esc_html__( 'Whatsapp Icon', 'master-whats-chat' ) => 'icon',
				);
				
				foreach( $attendant_image_types as $label => $value ) : ?>
					<option value="<?php echo esc_attr( $value ) ?>"<?php selected( $value, $attendant_photo_or_icon, true ); ?>><?php echo esc_html( $label ); ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<p>
			<label class="tmw-label"><?php echo esc_html__( 'Button Title', 'master-whats-chat' ); ?></label>
			<input type="type" class="tmw-input" name="tmwc_woocommerce_button_attendant_title" value="<?php echo esc_attr( wp_unslash( $attendant_title ) ); ?>" /> 
			<small><?php echo esc_html__( 'Leave this field empty if you want to show the attendant name as it is registered in the plugin options', 'master-whats-chat' ); ?></small>
		</p>
		<p>
			<label class="tmw-label"><?php echo esc_html__( 'Button Description', 'master-whats-chat' ); ?></label>
			<input type="type" class="tmw-input" name="tmwc_woocommerce_button_attendant_description" value="<?php echo esc_attr( wp_unslash( $attendant_description ) ); ?>" /> 
			<small><?php echo esc_html__( 'Leave this field empty if you want to show the attendant description as it is registered in the plugin options', 'master-whats-chat' ); ?></small>
		</p>
		<p>
			<label class="tmw-label"><?php echo esc_html__( 'Product Single Page - Button Position', 'master-whats-chat' ); ?></label>
			<select class="tmw-input" name="tmwc_woocommerce_button_position">
				<?php 
				// WooCommerce Hooks Positions
				$positions = array(
					esc_html__( 'None', 'master-whats-chat' ) => 'none',
					esc_html__( 'Before Add To Cart Button', 'master-whats-chat' ) => 'woocommerce_before_add_to_cart_button',
					esc_html__( 'After Add To Cart Button', 'master-whats-chat' ) => 'woocommerce_after_add_to_cart_button',
					esc_html__( 'Before Add To Cart Quantity', 'master-whats-chat' ) => 'woocommerce_before_add_to_cart_quantity',
					esc_html__( 'After Add To Cart Quantity', 'master-whats-chat' ) => 'woocommerce_after_add_to_cart_quantity',
					esc_html__( 'Before Add To Cart Form', 'master-whats-chat' ) => 'woocommerce_before_add_to_cart_form',
					esc_html__( 'After Add To Cart Form', 'master-whats-chat' ) => 'woocommerce_after_add_to_cart_form',
				);
				
				foreach( $positions as $label => $value ) : ?>
					<option value="<?php echo esc_attr( $value ) ?>"<?php selected( $value, $button_position, true ); ?>><?php echo esc_html( $label ); ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<p>
			<label class="tmw-label"><?php echo esc_html__( 'Shop Archive Page - Button Position', 'master-whats-chat' ); ?></label>
			<select class="tmw-input" name="tmwc_woocommerce_button_position_shop_archive">
				<?php 
				// WooCommerce Hooks Positions
				$positions = array(
					esc_html__( 'None', 'master-whats-chat' ) => 'none',
					esc_html__( 'Before Product Title', 'master-whats-chat' ) => 'woocommerce_before_shop_loop_item_title',
					esc_html__( 'After Product Title', 'master-whats-chat' ) => 'woocommerce_shop_loop_item_title',
					esc_html__( 'After Product Price', 'master-whats-chat' ) => 'woocommerce_after_shop_loop_item_title',
					esc_html__( 'After Add To Cart Button', 'master-whats-chat' ) => 'woocommerce_after_shop_loop_item',
				);
				
				foreach( $positions as $label => $value ) : ?>
					<option value="<?php echo esc_attr( $value ) ?>"<?php selected( $value, $button_position_shop_archive, true ); ?>><?php echo esc_html( $label ); ?></option>
				<?php endforeach; ?>
			</select>
		</p>

        <?php
    }

    /**
     * Save metabox.
     * 
     * @param int $post_id
     * 
     * @return void
     */
    public function save_metabox( $post_id ) {
        if ( ! isset( $_POST['tmwc_custom_security_nonce'] ) ) {
            return $post_id;
        }
 
        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['tmwc_custom_security_nonce'] ) ), 'tmwc_side_metabox' ) ) {
            return $post_id;
        }
 
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }
 
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		}

        // Sanitize the user input.
        $attendant_id                 = isset( $_POST['tmwc_woocommerce_button_attendant_id'] ) ? sanitize_text_field( wp_unslash( $_POST['tmwc_woocommerce_button_attendant_id'] ) ) : '';
		$button_layout                = isset( $_POST['tmwc_woocommerce_button_layout'] ) ? sanitize_text_field( wp_unslash( $_POST['tmwc_woocommerce_button_layout'] ) ) : '';
		$attendant_photo_or_icon      = isset( $_POST['tmwc_woocommerce_button_attendant_photo_or_icon'] ) ? sanitize_text_field( wp_unslash( $_POST['tmwc_woocommerce_button_attendant_photo_or_icon'] ) ) : '';;
		$attendant_title              = isset( $_POST['tmwc_woocommerce_button_attendant_title'] ) ? sanitize_text_field( wp_unslash( $_POST['tmwc_woocommerce_button_attendant_title'] ) ) : '';;
		$attendant_description        = isset( $_POST['tmwc_woocommerce_button_attendant_description'] ) ? sanitize_text_field( wp_unslash( $_POST['tmwc_woocommerce_button_attendant_description'] ) ) : '';;
		$button_position              = isset( $_POST['tmwc_woocommerce_button_position'] ) ? sanitize_text_field( wp_unslash( $_POST['tmwc_woocommerce_button_position'] ) ) : '';;
		$button_position_shop_archive = isset( $_POST['tmwc_woocommerce_button_position_shop_archive'] ) ? sanitize_text_field( wp_unslash( $_POST['tmwc_woocommerce_button_position_shop_archive'] ) ) : '';;
		$show_woo_button              = isset( $_POST['tmwc_show_woocommerce_button'] ) ? sanitize_text_field( wp_unslash( $_POST['tmwc_show_woocommerce_button'] ) ) : '';
 
        // Update the meta field.
        update_post_meta( $post_id, 'tmwc_woocommerce_button_attendant_id', $attendant_id );
		update_post_meta( $post_id, 'tmwc_woocommerce_button_layout', $button_layout );
		update_post_meta( $post_id, 'tmwc_woocommerce_button_attendant_photo_or_icon', $attendant_photo_or_icon );
		update_post_meta( $post_id, 'tmwc_woocommerce_button_attendant_title', $attendant_title );
		update_post_meta( $post_id, 'tmwc_woocommerce_button_attendant_description', $attendant_description );
		update_post_meta( $post_id, 'tmwc_woocommerce_button_position', $button_position );
		update_post_meta( $post_id, 'tmwc_woocommerce_button_position_shop_archive', $button_position_shop_archive );
		update_post_meta( $post_id, 'tmwc_show_woocommerce_button', $show_woo_button );
	}
}
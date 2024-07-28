<?php

/**
 * Plugin functions.
 * 
 */

namespace TM\Master_Whats_Chat;

if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

use TM\Master_Whats_Chat\Translator;

class Functions {

    /**
     * Filter output.
     * 
     * @param string $output
     * 
     * @return string
     */
    public static function filter_output( $output ) {
        return $output;
    }

    /**
     * Get i18n data.
     * 
     * @return array
     */
    public static function get_i18n_data() {
        return array(
            'attendant_online_text' => esc_html( Translator::translate_string( 'online', 'status_online_lowercase' ) ),
            'attendant_offline_text' => esc_html( Translator::translate_string( 'offline', 'status_offline_lowercase' ) ),
            'admin' => array(
                'add_new_attendant' => array(
                    'attendant_id_label' => esc_html__( 'ATTENDANT ID:', 'tmw-whatsapp' ),
                    'attendant_name' => esc_html__( 'Attendant Name:', 'tmw-whatsapp' ),
                    'attendant_name_desc' => esc_html__( 'The name of attendant', 'tmw-whatsapp' ),
                    'attendant_description' => esc_html__( 'Attendant Description:', 'tmw-whatsapp' ),
                    'attendant_description_desc' => esc_html__( 'The description of attendant', 'tmw-whatsapp' ),
                    'attendant_start_message' => esc_html__( 'Attendant Start Message:', 'tmw-whatsapp' ),
                    'attendant_start_message_desc' => esc_html__( 'The start message of attendant', 'tmw-whatsapp' ),
                    'attendant_phone' => esc_html__( 'Attendant Phone:', 'tmw-whatsapp' ),
                    'attendant_phone_desc' => esc_html__( 'The attendant phone. Do not add "+" before the number', 'tmw-whatsapp' ),
                    'attendant_offline_message' => esc_html__( 'Attendant Offline Message:', 'tmw-whatsapp' ),
                    'attendant_offline_message_desc' => esc_html__( 'The message when attendat is not available for chat', 'tmw-whatsapp' ),
                    'attendant_interval_message' => esc_html__( 'Attendant Interval Message:', 'tmw-whatsapp' ),
                    'attendant_interval_message_desc' => esc_html__( 'The message when attendat is not available for chat during interval', 'tmw-whatsapp' ),
                    'attendant_image' => esc_html__( 'Attendant Image:', 'tmw-whatsapp' ),
                    'attendant_image_desc' => esc_html__( 'The image of attendant', 'tmw-whatsapp' ),
                    'attendant_image_alt' => esc_html__( 'Image Uploaded', 'tmw-whatsapp' ),
                    'attendant_timezone' => esc_html__( 'Timezone:', 'tmw-whatsapp' ),
                    'attendant_timezone_desc' => esc_html__( 'Controls the timezone', 'tmw-whatsapp' ),
                    'attendant_setup_availability' => esc_html__( 'Setup Availability:', 'tmw-whatsapp' ),
                    'attendant_setup_availability_days' => array(
                        'monday' => esc_html__( 'monday', 'tmw-whatsapp' ),
                        'tuesday' => esc_html__( 'tuesday', 'tmw-whatsapp' ),
                        'wednesday' => esc_html__( 'wednesday', 'tmw-whatsapp' ),
                        'thursday' => esc_html__( 'thursday', 'tmw-whatsapp' ),
                        'friday' => esc_html__( 'friday', 'tmw-whatsapp' ),
                        'saturday' => esc_html__( 'saturday', 'tmw-whatsapp' ),
                        'sunday' => esc_html__( 'sunday', 'tmw-whatsapp' ),
                    ),
                    'attendant_remove_attendant' => esc_html__( 'Remove Attendant', 'tmw-whatsapp' ),
                    'attendant_enable_all_days' => esc_html__( 'Enable all days', 'tmw-whatsapp' ),
                ),
                'weekday_popup_status' => array(
                    'online' => esc_html__( 'Online all the time in this day', 'tmw-whatsapp' ),
                    'offline' => esc_html__( 'Offline all the time in this day', 'tmw-whatsapp' ),
                    'hours' => esc_html__( 'Online in the available hours below', 'tmw-whatsapp' ),
                ),
                'reset_settings_alert' => esc_html__( 'Do you make sure want to reset ALL settings to default ? This way you will lost all your current defined settings.', 'tmw-whatsapp' ),
                'media_upload' => array(
                    'title' => esc_html__( 'Select a image to upload', 'tmw-whatsapp' ),
                    'button_text' => esc_html__( 'Use this image', 'tmw-whatsapp' ),
                ),
            ),
        );
    }

    /**
     * Get settings data.
     * 
     */
    public static function get_settings() {
        return get_option( 'tmw_whatsapp_settings_data' );
    }

    /**
     * Get setting by id.
     * 
     */
    public static function get_setting( $setting_id ) {
        $settings = self::get_settings();

        if( ! isset($settings[ $setting_id ]) ) {
            return '';
        }

        return $settings[ $setting_id ];
    }
    
    /**
	 * Get Google Fonts Family 
	 *
     * @param array $settings
     * 
     * @return string
	 */
	public static function get_google_fonts_family( $settings ) {
		if( !isset($settings['skin_font_family']) || isset($settings['skin_font_family']) && empty($settings['skin_font_family']) ) {
			return '//fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;1,400&display=swap';
		}

		return '//fonts.googleapis.com/css2?family='. wp_kses_post( $settings['skin_font_family'] ) .'&display=swap';
	}

    /**
     * Get attendants list.
     * 
     * @return array
     */
    public static function get_attendants_list() {
        $settings = self::get_settings();
        $attendants_list = array();

        if( isset($settings['attendants']) && $settings['attendants'] ) {
            foreach( $settings['attendants'] as $attendantObj ) {
                $attendants_list[ $attendantObj['name'] ] = $attendantObj['id'];
            }
        }

        return $attendants_list;
    }

    /**
     * Get list with TM WhatsApp attendants
     *
     * @return array
     */
    public static function get_attendants() {
        $settings = self::get_settings();

        if( isset($settings['attendants']) && $settings['attendants'] ) {
            return $settings['attendants'];
        }
    }
}
<?php

/**
 * Settings fields.
 * 
 * @package Master_Whats_Chat
 */

namespace TMWC\Master_Whats_Chat\Admin;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

class SettingsFields {

    /**
     * Get the conditional class
     * Useful for conditional fields
     * 
     */
    public static function conditional_class( $field_val ) {
        if( isset($field_val['condition']) ) {
            return ' tmw-conditional-field tmw-conditional-field-hide';
        } else {
            return '';
        }
    }

    /**
     * Get the conditional class
     * Useful for conditional fields
     * 
     */
    public static function conditional_atts( $field_val ) {
        if( isset($field_val['condition']) ) {
            return ' data-cond-target="'. esc_attr( $field_val['condition']['target'] ) .'" data-cond-cond="'. esc_attr( $field_val['condition']['cond'] ) .'" data-cond-value="'. ( isset($field_val['condition']['value']) ? ( is_array( $field_val['condition']['value'] ) ? esc_attr( implode( ',', $field_val['condition']['value'] ) ) : esc_attr( $field_val['condition']['value'] ) ) : '' ) .'"';
        } else {
            return '';
        }
    }

    /**
     * Render the media upload field
     * 
     */
    public static function media_upload( $field_val = array(), $inputName = '' ) {
        if( !is_array($field_val) ) {
            $image_id = $field_val;
            $image_metadata = wp_get_attachment_metadata($image_id);

            $field_val = array();

            $field_val['image'] = array(
                $inputName => $image_id,
                $inputName . '_type' => 'image',
                $inputName . '_width' => isset( $image_metadata['width'] ) ? $image_metadata['width'] : 0,
                $inputName . '_height' => isset( $image_metadata['height'] ) ? $image_metadata['height'] : 0,
                $inputName . '_title' => '',
                $inputName . '_icon' => '',
            );
        } elseif( !isset($field_val['image']) ) {
                return;
        }

        $imageObj = $field_val['image'];

        $image_src = TMWC_PLUGIN_URL . '/img/img-placeholder.png';
        if( isset($imageObj[$inputName]) && ! empty($imageObj[$inputName]) ) {
            $image_src = wp_get_attachment_image_url( $imageObj[$inputName], 'thumbnail', false );
        }

        $type = isset($imageObj[$inputName . '_type']) ? $imageObj[$inputName . '_type'] : '';
        $width = isset($imageObj[$inputName . '_width']) ? $imageObj[$inputName . '_width'] : '';
        $height = isset($imageObj[$inputName . '_height']) ? $imageObj[$inputName . '_height'] : '';
        $title = isset($imageObj[$inputName . '_title']) ? $imageObj[$inputName . '_title'] : '';
        $icon = isset($imageObj[$inputName . '_icon']) ? $imageObj[$inputName . '_icon'] : '';

        ?>

        <div class="tmw-media-uploader<?php ( isset($imageObj[$inputName]) && !empty($imageObj[$inputName]) ? ' remove-state' : '' ); ?>">
            <img class="tmw-metabox-image-field-preview tmw-media-uploader-upload-btn" src="<?php echo esc_url( $image_src ); ?>" alt="<?php echo esc_attr__( 'Image Uploaded', 'master-whats-chat' ); ?>" width="100" height="" data-post-id="" />
            <span class="tmw-media-uploader-remove-btn dashicons dashicons-dismiss"></span>
            <input class="tmw-media-uploader-media-image" type="hidden" name="<?php echo esc_attr( $inputName ); ?>" value="<?php echo esc_attr( $imageObj[$inputName] ); ?>">
            <input class="tmw-media-uploader-media-type" type="hidden" name="<?php echo esc_attr( $inputName ); ?>_type" value="<?php echo esc_attr( $type ); ?>">
            <input class="tmw-media-uploader-media-width" type="hidden" name="<?php echo esc_attr( $inputName ); ?>_width" value="<?php echo esc_attr( $width ); ?>">
            <input class="tmw-media-uploader-media-height" type="hidden" name="<?php echo esc_attr( $inputName ); ?>_height" value="<?php echo esc_attr( $height ); ?>">
            <input class="tmw-media-uploader-media-title" type="hidden" name="<?php echo esc_attr( $inputName ); ?>_title" value="<?php echo esc_attr( $title ); ?>">
            <input class="tmw-media-uploader-media-icon" type="hidden" name="<?php echo esc_attr( $inputName ); ?>_icon" value="<?php echo esc_attr( $icon ); ?>">
        </div>

        <?php
    }

    /**
     * Render the padding/margin field
     * 
     */
    public static function padding_margin( $field_val, $field_name ) {
        if( ! $field_val ) {
            echo esc_html__( 'No values defined for this input', 'master-whats-chat' );

            return;
        } ?>

        <div class="tmw-control-padding-margin">
            <div class="tmw-control-padding-margin-input-wrapper">
                <span class="icon"><i class="tmw-fas tmw-fa-arrows-alt-v"></i></span>
                <input class="tmw-padding-top tmw-form-control tmw-form-control-100" name="<?php echo esc_attr( $field_name ); ?>-top-bottom" type="number" min="-999" max="999" value="<?php echo esc_attr( $field_val['top-bottom'] ); ?>" />
            </div>
            <div class="tmw-control-padding-margin-input-wrapper">
                <span class="icon"><i class="tmw-fas tmw-fa-arrows-alt-h"></i></span>
                <input class="tmw-padding-left tmw-form-control tmw-form-control-100" type="number" name="<?php echo esc_attr( $field_name ); ?>-left-right" min="-999" max="999" value="<?php echo esc_attr( $field_val['left-right'] ); ?>" />
            </div>
        </div>

        <?php
    }

    /**
     * Return HTML select list with all countries
     * 
     * @param string $name
     * @param string $value
     * @param string $form_control_extra_class
     * 
     * @return string
     */
    public static function timezone_html_select( $name, $value, $form_control_extra_class = ' tmw-form-control-100' ) { ?>
        <select name="<?php echo esc_attr( $name ); ?>" class="tmw-form-control tmw-form-control-select<?php echo esc_attr( $form_control_extra_class ); ?>">
            <?php 
            $timeZoneList = \DateTimeZone::listIdentifiers(\DateTimeZone::ALL);
            foreach( $timeZoneList as $timezone ) : ?>
                <option value="<?php echo esc_attr( $timezone ); ?>"<?php selected( $value, $timezone, true ); ?>>
                    <?php echo esc_html( $timezone ); ?>
                </option>';
            <?php endforeach; ?>
        </select>

        <?php
    }

    /**
     * Sanitize data.
     * 
     * @param array $data
     * 
     * @return array
     */
    public static function sanitize_data( $data ) {
        $sanitized_data = array();

        foreach( $data as $key => $value ) {
            if ( is_array($value) ) {
                $sanitized_data[$key] = self::sanitize_data( $value );
            } elseif ( is_object($value) ) { 
                $sanitized_data[$key] = self::sanitize_data( $value );
            } else {
                $sanitized_data[$key] = sanitize_text_field( $value );
            }
        }

        return $sanitized_data;
    }
}
<?php

/**
 * Settings fields.
 * 
 * @package Master_Whats_Chat
 */

namespace TM\Master_Whats_Chat\Admin;

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
                $inputName . '_icon' => ''
            );
        } else {
            if( !isset($field_val['image']) ) {
                return;
            }
        }

        $imageObj = $field_val['image'];

        $output = '';

        $image_src = TM_MASTER_WHATS_CHAT_URL . '/img/img-placeholder.png';
        if( isset($imageObj[ $inputName ]) && !empty($imageObj[ $inputName ]) ) {
            $image_src = wp_get_attachment_image_url( $imageObj[ $inputName ], 'thumbnail', false );
        }

        $output .= '<div class="tmw-media-uploader'. ( isset($imageObj[ $inputName ]) && !empty($imageObj[ $inputName ]) ? ' remove-state' : '' ) .'">';
            $output .= '<img class="tmw-metabox-image-field-preview tmw-media-uploader-upload-btn" src="'. esc_url( $image_src ) .'" alt="'. esc_attr__( 'Image Uploaded', 'tmw-whasapp' ) .'" width="100" height="" data-post-id="" />';
            $output .= '<span class="tmw-media-uploader-remove-btn dashicons dashicons-dismiss"></span>';
            $output .= '<input class="tmw-media-uploader-media-image" type="hidden" name="'. esc_attr( $inputName ) .'" value="'. esc_attr( $imageObj[ $inputName ] ) .'">';
            $output .= '<input class="tmw-media-uploader-media-type" type="hidden" name="'. esc_attr( $inputName ) .'_type" value="'. esc_attr( $imageObj[ $inputName . '_type' ] ) .'">';
            $output .= '<input class="tmw-media-uploader-media-width" type="hidden" name="'. esc_attr( $inputName ) .'_width" value="'. esc_attr( $imageObj[ $inputName . '_width' ] ) .'">';
            $output .= '<input class="tmw-media-uploader-media-height" type="hidden" name="'. esc_attr( $inputName ) .'_height" value="'. esc_attr( $imageObj[ $inputName . '_height' ] ) .'">';
            $output .= '<input class="tmw-media-uploader-media-title" type="hidden" name="'. esc_attr( $inputName ) .'_title" value="'. esc_attr( $imageObj[ $inputName . '_title' ] ) .'">';
            $output .= '<input class="tmw-media-uploader-media-icon" type="hidden" name="'. esc_attr( $inputName ) .'_icon" value="'. esc_attr( $imageObj[ $inputName . '_icon' ] ) .'">';
        $output .= '</div>';

        return $output;
    }

    /**
     * Render the padding/margin field
     * 
     */
    public static function padding_margin( $field_val, $field_name ) {
        if( !$field_val ) {
            return esc_html__( 'No values defined for this input', 'tmw-whatsapp' );
        }

        $output = '';

        $output .= '<div class="tmw-control-padding-margin">';
            $output .= '<div class="tmw-control-padding-margin-input-wrapper">';
                $output .= '<span class="icon"><i class="tmw-fas tmw-fa-arrows-alt-v"></i></span>';
                $output .= '<input class="tmw-padding-top tmw-form-control tmw-form-control-100" name="'. esc_attr( $field_name ) .'-top-bottom" type="number" min="-999" max="999" value="'. esc_attr( $field_val['top-bottom'] ) .'" />';
            $output .= '</div>';
            $output .= '<div class="tmw-control-padding-margin-input-wrapper">';
                $output .= '<span class="icon"><i class="tmw-fas tmw-fa-arrows-alt-h"></i></span>';
                $output .= '<input class="tmw-padding-left tmw-form-control tmw-form-control-100" type="number" name="'. esc_attr( $field_name ) .'-left-right" min="-999" max="999" value="'. esc_attr( $field_val['left-right'] ) .'" />';
            $output .= '</div>';
        $output .= '</div>';

        return $output;
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
    public static function timezone_html_select( $name, $value, $form_control_extra_class = ' tmw-form-control-100' ) {
        $output = '';
        $output .= '<select name="'. esc_attr( $name ) .'" class="tmw-form-control tmw-form-control-select'. esc_attr( $form_control_extra_class ) .'">';
        $timeZoneList = \DateTimeZone::listIdentifiers(\DateTimeZone::ALL);
        foreach( $timeZoneList as $timezone ) {
                $output .= '<option value="'. esc_attr( $timezone ) .'"'. selected( $value, $timezone, false ) .'>'. esc_html( $timezone ) .'</option>';
            }
        $output .= '</select>';

        return $output;
    }
}
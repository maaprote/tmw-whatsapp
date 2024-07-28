<?php

/*
 * The default settings data
 * This will mount the fields at settings admin page
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

// Default Options
$defaults = array(
	'fields' => array(
		'tab-start-general' => array(
			'label' => esc_html__( 'General', 'tmw-whasapp' ),
			'type' => 'tab_start',
			'tab_id' => 'tabGeneral',
		),

		'rtl_layout' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'RTL Layout', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Right To Left layout. This is good for languages like arabic, hebrew, etc...', 'tmw-whatsapp' ),
			'type' => 'switch_onoff',
			'value' => ''
		),
		'position' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Position', 'tmw-whasapp' ),
			'desc' => esc_html__( 'Controls the position of whatsapp chat on screen', 'tmw-whatsapp' ),
			'type' => 'select',
			'value' => 'bottom-right',
			'opts' => array(
				'top-right' => esc_html__( 'Top Right', 'tmw-whatsapp' ),
				'top-left' => esc_html__( 'Top Left', 'tmw-whatsapp' ),
				'bottom-right' => esc_html__( 'Bottom Right', 'tmw-whatsapp' ),
				'bottom-left' => esc_html__( 'Bottom Left', 'tmw-whatsapp' )
			)
		),

		'header_title' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Header Title', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls the text for chat window header title', 'tmw-whatsapp' ),
			'type' => 'text',
			'value' => ''
		),
		'header_description' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Header Description', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls the text for chat window header description', 'tmw-whatsapp' ),
			'type' => 'text',
			'value' => ''
		),
		'header_phone' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Header Phone', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls the phone number on header', 'tmw-whatsapp' ),
			'type' => 'text',
			'placeholder' => esc_html__( '(800) 123-4567', 'tmw-whatsapp' ),
			'value' => esc_html__( '(800) 123-4567', 'tmw-whatsapp' )
		),
		'header_email' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Header Email', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls the email on header', 'tmw-whatsapp' ),
			'type' => 'text',
			'placeholder' => esc_html__( 'mail@domain.com', 'tmw-whatsapp' ),
			'value' => esc_html__( 'mail@domain.com', 'tmw-whatsapp' )
		),
		'header_no_attendants_registered' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'No Attendants Registered Message', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'The message when has none attendat registered', 'tmw-whatsapp' ),
			'type' => 'text',
			'value' => ''
		),

		'chat_image_background' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Chat Image Background', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls the chat image background', 'tmw-whatsapp' ),
			'type' => 'image_upload',
			'value' => ''
		),

		'footer_show' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Show Footer', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Check to show the chat footer', 'tmw-whatsapp' ),
			'type' => 'switch_onoff',
			'value' => ''
		),
		'footer_message' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Footer Message', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls the text for chat window footer message', 'tmw-whatsapp' ),
			'type' => 'text',
			'value' => ''
		),
		'footer_phone' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Footer Phone', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls the phone in the chat window footer', 'tmw-whatsapp' ),
			'type' => 'text',
			'placeholder' => esc_html__( '(800) 123-4567', 'tmw-whatsapp' ),
			'value' => ''
		),
		'footer_email' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Footer Email', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls the email in the chat window footer', 'tmw-whatsapp' ),
			'type' => 'text',
			'placeholder' => esc_html__( 'mail@domain.com', 'tmw-whatsapp' ),
			'value' => ''
		),

		'call_to_action_show' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Show Call To Action', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Show text next to floating button', 'tmw-whatsapp' ),
			'type' => 'switch_onoff',
			'value' => 'on'
		),
		'call_to_action_text' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Call To Action Text', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls the text of call to action', 'tmw-whatsapp' ),
			'type' => 'text',
			'placeholder' => esc_html__( 'Need Help?', 'tmw-whatsapp' ),
			'value' => ''
		),

		'open_whatsapp_type' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Open WhatsApp Web Chat When', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Control when the WhatsApp Web new window should open', 'tmw-whatsapp' ),
			'type' => 'switch',
			'opts' => array(
				'click-icon' => esc_html__( 'Click Icon', 'tmw-whatsapp' ),
				'select-attendant' => esc_html__( 'Select Attendant', 'tmw-whatsapp' ),
				'click-chat-send' => esc_html__( 'Click Chat Send', 'tmw-whatsapp' ),
			),
			'value' => 'click-chat-send'
		),
		'whatsapp_initial_message' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Whatsapp Web Start Message', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'The initial message to send. You can use template strings. Eg: {{woo_product_title:12}}', 'tmw-whatsapp' ),
			'type' => 'text',
			'value' => '',
			'condition' => array(
				'target' => 'open_whatsapp_type',
				'cond'   => 'include',
				'value' => array( 'click-icon', 'select-attendant' )
            ),
            'tooltip' => true,
            'tooltip_title' => esc_html__( 'See all markups', 'tmw-whatsapp' ),
            'tooltip_content' => array(
                '{{woo_product_title:__ID__}}' => esc_html__( 'Product title:', 'tmw-whatsapp' ),
                '{{woo_product_link:__ID__}}' => esc_html__( 'Product link:', 'tmw-whatsapp' ),
                '{{post_title:__ID__}}' => esc_html__( 'Post title:', 'tmw-whatsapp' ),
                '{{post_link:__ID__}}' => esc_html__( 'Post link:', 'tmw-whatsapp' ),
                '{{page_title:__ID__}}' => esc_html__( 'Page title:', 'tmw-whatsapp' ),
                '{{page_link:__ID__}}' => esc_html__( 'Page link:', 'tmw-whatsapp' ),
                'explain' => esc_html__( 'OBS: Replace "__ID__" with the product/post/page ID', 'tmw-whatsapp' )
            )
		),
		'whatsapp_move_button' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Button Position Offsets', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Moves the posiion to top/bottom/left/right', 'tmw-whatsapp' ),
			'type' => 'padding_margin',
			'value' => array(
				'top-bottom' => 0,
				'left-right' => 0
			)
		),
		'whatsapp_open_chat_with_attendant' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Open chat with attendant on page first load', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'On the first load of page, the attendant chat window will automatically open', 'tmw-whatsapp' ),
			'type' => 'switch_onoff',
			'value' => ''
		),
		'whatsapp_open_chat_with_attendant_id' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Attendant ID to Open the Chat', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Get the ID in the "Attendants" tab of this settings page', 'tmw-whatsapp' ),
			'type' => 'number',
			'value' => '',
			'condition' => array(
				'target' => 'whatsapp_open_chat_with_attendant',
				'cond' => 'equal',
				'value' => true
			)
		),
		'whatsapp_open_chat_with_attendant_delay' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Delay Time to Open the Chat', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'The delay time in seconds to open the chat when first load the page', 'tmw-whatsapp' ),
			'type' => 'number',
			'value' => '',
			'condition' => array(
				'target' => 'whatsapp_open_chat_with_attendant',
				'cond' => 'equal',
				'value' => true
			)
		),
		'whatsapp_hide_from_pages' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Hide From Specific Pages ID', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Do not show whatsapp button/chat in specific pages ID. Eg: 13,22,44 (comma separate)', 'tmw-whatsapp' ),
			'type' => 'text',
			'value' => '',
			'condition' => array(
				'target' => 'whatsapp_show_on_pages',
				'cond'   => 'empty'
			)
		),
		'whatsapp_show_on_pages' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Show In Specific Pages ID', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Show whatsapp button/chat in specific pages ID. Eg: 13,22,44 (comma separate)', 'tmw-whatsapp' ),
			'type' => 'text',
			'value' => '',
			'condition' => array(
				'target' => 'whatsapp_hide_from_pages',
				'cond'   => 'empty'
			)
		),
		'debug' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Enable Debug', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'The purpose of this options is support help if you need. Keep it disabled. Enable only if someone of our support team ask to enable.', 'tmw-whatsapp' ),
			'type' => 'switch_onoff',
			'value' => ''
		),

		'tab-close-general' => array(
			'label' => esc_html__( 'General', 'tmw-whasapp' ),
			'type' => 'tab_close',
			'value' => '',
		),

		'tab-start-attendants' => array(
			'label' => esc_html__( 'Attendants', 'tmw-whasapp' ),
			'type' => 'tab_start',
			'tab_id' => 'tabAttendants',
		),

		'attendants' => array(
			'label' => esc_html__( 'Attendants', 'tmw-whasapp' ),
			'type'  => 'multi',
			'value' => array()
		),

		'tab-close-attendants' => array(
			'label' => esc_html__( 'General', 'tmw-whasapp' ),
			'type' => 'tab_close',
			'value' => '',
		),

		'tab-start-skin' => array(
			'label' => esc_html__( 'Skin', 'tmw-whatsapp' ),
			'type' => 'tab_start',
			'tab_id' => 'tabSkin',
			'prepend_html' => '<a href="#" class="tmw-skin-clear-all-fields">'. esc_html__( 'Clear All Fields', 'tmw-whasapp' ) .'</a>'
		),

		'heading-typography' => array(
			'label' => esc_html__( 'Typography', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls the typography of the plugin', 'tmw-whatsapp' ),
			'type' => 'heading',
			'value' => '',
		),

		'skin_font_family' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Font Family (Google Fonts)', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls the font family of all texts of the plugin. The default value is: Poppins:ital,wght@0,400;0,700;1,400', 'tmw-whatsapp' ),
			'type' => 'text',
			'placeholder' => esc_html__( 'Poppins:ital,wght@0,400;0,700;1,400', 'tmw-whatsapp' ),
			'value' => '',
			'tooltip' => true,
            'tooltip_title' => esc_html__( 'How to change', 'tmw-whatsapp' ),
            'tooltip_content' => array(
				'explain' => sprintf( __( 'Go to <a href="%s" target="_blank">%s</a> and select your desired font. Once you have selected, a right sidebar will open and you should get the code from there. See the image example: <img src="%s" class="tmw-img-fluid" alt="Font family code" />', 'tmw-whatsapp' ), esc_url( 'https://fonts.google.com' ), esc_url( 'https://fonts.google.com' ), esc_url( TM_MASTER_WHATS_CHAT_URL . '/img/font-family-1.jpg' ) )
            )
		),
		'skin_font_family_name' => array(
			'filter_output' => true,
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Font Family Name (Google Fonts)', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls the font family name of all texts of the plugin. The default value is: "Poppins", sans-serif;', 'tmw-whatsapp' ),
			'type' => 'text',
			'placeholder' => esc_html__( '"Poppins", sans-serif;', 'tmw-whatsapp' ),
			'value' => '',
			'tooltip' => true,
            'tooltip_title' => esc_html__( 'How to change', 'tmw-whatsapp' ),
            'tooltip_content' => array(
				'explain' => sprintf( __( 'Go to <a href="%s" target="_blank">%s</a> and select your desired font. Once you have selected, a right sidebar will open and you should get the font family name from there. See the image example: <img src="%s" class="tmw-img-fluid" alt="Font family name" />', 'tmw-whatsapp' ), esc_url( 'https://fonts.google.com' ), esc_url( 'https://fonts.google.com' ), esc_url( TM_MASTER_WHATS_CHAT_URL . '/img/font-family-2.jpg' ) )
            )
		),

		'heading-skin-button' => array(
			'label' => esc_html__( 'Open Chat Button', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Control skin of whatsapp chat button', 'tmw-whatsapp' ),
			'type' => 'heading',
			'value' => '',
		),

		'skin_open_chat_button_background' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Button Background', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls open chat button background color', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#20ab54',
			'target' => '.tmw-whatsapp-trigger-button > a',
			'cssProp' => 'backgroundColor' 		
		),
		'skin_open_chat_button_icon_color' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Button Icon', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls open chat button icon color', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#FFF',
			'target' => '.tmw-whatsapp-trigger-button > a',
			'cssProp' => 'color' 		
		),
		'skin_call_to_action_background_color' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Call To Action Background Color', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls the call to action background color', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#e4e4e4',
			'target' => '.tmw-whatsapp-trigger-button .tmw-whatsapp-call-to-action > a',
			'cssProp' => 'backgroundColor' 		
		),
		'skin_call_to_action_text_color' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Call To Action Text Color', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls the call to action text color', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#616161',
			'target' => '.tmw-whatsapp-trigger-button .tmw-whatsapp-call-to-action > a',
			'cssProp' => 'color' 		
		),

		'space-after-skin-button' => array(
			'type' => 'space',
			'value' => '30px'
		),

		'heading-skin-chat-list-view' => array(
			'label' => esc_html__( 'Chat List View', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Control skin of whatsapp chat list view (the view with attendants list). ', 'tmw-whatsapp' ),
			'type' => 'heading',
			'value' => '',
		),

		'skin_header_bg' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Header Background', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls header background color', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#20ab54',
			'target' => '.tmw-whatsapp-card-header',
			'cssProp' => 'backgroundColor' 		
		),
		'skin_header_title' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Header Title Color', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls header title color', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#FFF',
			'target' => '.tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-header .tmw-whatsapp-presentation-info > h2',
			'cssProp' => 'color' 		
		),
		'skin_header_description' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Header Description Color', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls header description color', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#FFF',
			'target' => '.tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-header .tmw-whatsapp-presentation-info > p',
			'cssProp' => 'color' 		
		),
		'skin_header_phone' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Header Phone Color', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls header phone color', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#FFF',
			'target' => '.tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-header .tmw-whatsapp-presentation-info > a > strong',
			'cssProp' => 'color' 		
		),
		'skin_header_email' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Header Email Color', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls header email color', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#FFF',
			'target' => '.tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-header .tmw-whatsapp-presentation-info > a',
			'cssProp' => 'color' 		
		),
		'skin_attendants_list' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Attendants List Background', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls attendants list background color', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#f7f7f7',
			'target' => '.tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-body .tmw-whatsapp-attendant',
			'cssProp' => 'backgroundColor' 		
		),
		'skin_attendants_list_hover' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Attendants List Background on Hover', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls attendants list background color on hover', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#f7f7f7',
			'target' => '',
			'cssProp' => 'color',
			'pseudo' => '.tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-body .tmw-whatsapp-attendant:hover',
			'pseudo_prop' => 'background-color'	
		),
		'skin_attendants_list_title' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Attendants List Title', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls attendants list title color', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#212121',
			'target' => '.tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-body .tmw-whatsapp-attendant .tmw-whatsapp-attendant-info h3',
			'cssProp' => 'color' 		
		),
		'skin_attendants_list_description' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Attendants List Description', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls attendants list description color', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#777',
			'target' => '.tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-body .tmw-whatsapp-attendant .tmw-whatsapp-attendant-info p',
			'cssProp' => 'color' 		
		),
		'skin_attendants_list_status_badge' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Attendants List Status Badge', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls attendants list status badge color', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#20ab54',
			'target' => '.tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-body .tmw-whatsapp-attendant .tmw-whatsapp-attendant-status p',
			'cssProp' => 'backgroundColor' 		
		),
		'skin_attendants_list_status_text' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Attendants List Status Text', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls attendants list status text color', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#FFF',
			'target' => '.tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-body .tmw-whatsapp-attendant .tmw-whatsapp-attendant-status p',
			'cssProp' => 'color' 		
		),
		'skin_attendants_list_offline_status_badge' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Attendants List Offline Badge', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls attendants list offline badge color', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#dedede',
			'target' => '.tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-body .tmw-whatsapp-attendant .tmw-whatsapp-attendant-info .tmw-whastapp-attendant-info-offline-message, .tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-body .tmw-whatsapp-attendant.tmw-attendant-is-offline .tmw-whatsapp-attendant-status p.tmw-whatsapp-attendant-status-offline',
			'cssProp' => 'backgroundColor' 		
		),
		'skin_attendants_list_offline_status_badge_text' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Attendants List Offline Badge Text', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls attendants list offline badge text color', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#000',
			'target' => '.tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-body .tmw-whatsapp-attendant .tmw-whatsapp-attendant-info .tmw-whastapp-attendant-info-offline-message, .tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-body .tmw-whatsapp-attendant.tmw-attendant-is-offline .tmw-whatsapp-attendant-status p.tmw-whatsapp-attendant-status-offline',
			'cssProp' => 'color' 		
		),
		'skin_attendants_list_interval_status_badge' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Attendants List Interval Badge', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls attendants list interval badge color', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#e2c80c',
			'target' => '.tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-body .tmw-whatsapp-attendant .tmw-whatsapp-attendant-info .tmw-whastapp-attendant-info-offline-message.is-interval, .tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-body .tmw-whatsapp-attendant.tmw-attendant-is-offline .tmw-whatsapp-attendant-status p.tmw-whatsapp-attendant-status-interval',
			'cssProp' => 'backgroundColor' 		
		),
		'skin_attendants_list_interval_status_badge_text' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Attendants List Interval Badge Text', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls attendants list interval badge text color', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#000',
			'target' => '.tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-body .tmw-whatsapp-attendant .tmw-whatsapp-attendant-info .tmw-whastapp-attendant-info-offline-message.is-interval, .tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-body .tmw-whatsapp-attendant.tmw-attendant-is-offline .tmw-whatsapp-attendant-status p.tmw-whatsapp-attendant-status-interval',
			'cssProp' => 'color' 		
		),
		'skin_footer_bg' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Footer Background', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls footer background color', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#20ab54',
			'target' => '.tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-footer',
			'cssProp' => 'backgroundColor' 		
		),
		'skin_footer_message' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Footer Message', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls footer message color', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#FFF',
			'target' => '.tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-footer p:nth-child(1)',
			'cssProp' => 'color' 		
		),
		'skin_footer_phone_email' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Footer Phone & Email', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls footer phone and email color', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#FFF',
			'target' => '.tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-footer p:nth-child(2), .tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-footer a',
			'cssProp' => 'color' 		
		),

		'space-after-skin-chat-list-view' => array(
			'type' => 'space',
			'value' => '30px'
		),

		'heading-skin-chat-attendant-view' => array(
			'label' => esc_html__( 'Chat Attendant View', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Control skin of whatsapp chat attendant view (the view when select attendant). ', 'tmw-whatsapp' ),
			'type' => 'heading',
			'value' => '',
		),

		'skin_attendant_title' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Attendant Name', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls attendant name color', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#FFF',
			'target' => '.tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-header .tmw-whatsapp-attedant-info-title h2',
			'cssProp' => 'color' 		
		),
		'skin_attendant_status' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Attendant Status', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls attendant status color', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#FFF',
			'target' => '.tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-header .tmw-whatsapp-attedant-info-title p',
			'cssProp' => 'color' 		
		),
		'skin_attendant_back_icon' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Attendant Back Icon', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls attendant back icon color', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#FFF',
			'target' => '.tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-header .tmw-whatsapp-active-attendant-info .tmw-whatsapp-active-attendant-info-back',
			'cssProp' => 'color' 		
		),
		'skin_attendant_chat_message' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Chat Message Baloon Background', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls attendant chat message background color', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#FFF',
			'target' => '.tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-body .tmw-whatsapp-attendant-chat-window .tmw-whatsapp-attendant-chat-message',
			'cssProp' => 'backgroundColor',
			'pseudo' => '.tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-body .tmw-whatsapp-attendant-chat-window .tmw-whatsapp-attendant-chat-message:before',
			'pseudo_prop' => 'border-right-color'	
		),
		'skin_attendant_chat_message_hour' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Chat Message Baloon Hour Color', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls attendant chat message hour text color', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#9a9a9a',
			'target' => '.tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-body .tmw-whatsapp-attendant-chat-window .tmw-whatsapp-attendant-chat-message .tmw-whatsapp-attendant-chat-message-time',
			'cssProp' => 'color'
		),
		'skin_attendant_chat_message_text' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Chat Message Baloon Text', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls attendant chat message text color', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#777',
			'target' => '.tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-body .tmw-whatsapp-attendant-chat-window .tmw-whatsapp-attendant-chat-message',
			'cssProp' => 'color' 		
		),
		'skin_attendant_chat_message_input_wrapper' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Chat Message Input Wrapper', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls attendant chat message input wrapper background color', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#f0f0f0',
			'target' => '.tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-body .tmw-whatsapp-attendant-chat-window .tmw-whatsapp-attendant-chat-window-footer',
			'cssProp' => 'backgroundColor' 		
		),
		'skin_attendant_chat_message_input' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Chat Message Input', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls attendant chat message input background color', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#FFF',
			'target' => '.tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-body .tmw-whatsapp-attendant-chat-window .tmw-whatsapp-attendant-chat-window-footer > input',
			'cssProp' => 'backgroundColor' 		
		),
		'skin_attendant_chat_message_input_placeholder' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Chat Message Input Placeholder', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls attendant chat message input placeholder color', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#CCC',
			'target' => '',
			'cssProp' => 'color',
			'pseudo' => '.tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-body .tmw-whatsapp-attendant-chat-window .tmw-whatsapp-attendant-chat-window-footer > input::-webkit-input-placeholder,
.tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-body .tmw-whatsapp-attendant-chat-window .tmw-whatsapp-attendant-chat-window-footer > input::placeholder',
			'pseudo_prop' => 'color'	
		),
		'skin_attendant_chat_message_input_text' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Chat Message Input Text', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls attendant chat message input text color', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#777',
			'target' => '.tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-body .tmw-whatsapp-attendant-chat-window .tmw-whatsapp-attendant-chat-window-footer > input',
			'cssProp' => 'color' 		
		),
		'skin_attendant_chat_send_button_background' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Chat Send Button Background', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls attendant chat send button background color', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#f0f0f0',
			'target' => '.tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-body .tmw-whatsapp-attendant-chat-window .tmw-whatsapp-attendant-chat-window-footer .tmw-whatsapp-attendant-chat-send-button',
			'cssProp' => 'backgroundColor' 		
		),
		'skin_attendant_chat_send_button_icon' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Chat Send Button Icon', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls attendant chat send button icon color', 'tmw-whatsapp' ),
			'type' => 'colorpicker',
			'value' => '#9a9a9a',
			'target' => '.tmw-whatsapp-wrapper .tmw-whatsapp-card .tmw-whatsapp-card-body .tmw-whatsapp-attendant-chat-window .tmw-whatsapp-attendant-chat-window-footer .tmw-whatsapp-attendant-chat-send-button',
			'cssProp' => 'color' 		
		),

		'tab-close-skin' => array(
			'label' => esc_html__( 'Skin', 'tmw-whatsapp' ),
			'type' => 'tab_close',
			'value' => '',
		),

		'tab-start-performance' => array(
			'label' => esc_html__( 'Performance', 'tmw-whatsapp' ),
			'type' => 'tab_start',
			'tab_id' => 'tabPerformance'
		),

		'heading-performance-tab' => array(
			'label' => esc_html__( 'Performance', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'These settings controls how the TM Whatsapp should be initialized/loaded. By using one of these options, the plugin will not affect your rating in page performance tools like Google Page Speed, GTMetrix, Webpagetest, etc...', 'tmw-whatsapp' ),
			'type' => 'heading',
			'value' => '',
		),

		'performance_how_plugin_init' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'How TM Whatsapp Plugin should be initialized?', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Controls when the JS code of the plugin will run', 'tmw-whatsapp' ),
			'type' => 'select',
			'value' => 'first-load',
			'opts' => array(
				'on-first-load' => esc_html__( 'On Load of the Page', 'tmw-whatsapp' ),
				'on-first-scroll' => esc_html__( 'On First Scroll of the Page', 'tmw-whatsapp' ),
				'on-first-mouseover' => esc_html__( 'On First movement of Mouse on the Page', 'tmw-whatsapp' ),
				'after-few-seconds' => esc_html__( 'After few seconds (not recommeded for some page performance tools)', 'tmw-whatsapp' )
			)
		),
		'performance_after_few_seconds_delay' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Delay Time to Run/Initialize the Plugin', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'The delay time in seconds to run/initialize the plugin on first load the page', 'tmw-whatsapp' ),
			'type' => 'number',
			'value' => '',
			'condition' => array(
				'target' => 'performance_how_plugin_init',
				'cond' => 'equal',
				'value' => 'after-few-seconds'
			)
		),

		'heading-performance-tab-information' => array(
			'label' => esc_html__( 'Important', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'These settings can not be preview on this page. To see this working, please open the frontend of your website.', 'tmw-whatsapp' ),
			'type' => 'heading',
			'value' => '',
		),

		'tab-close-performance' => array(
			'label' => esc_html__( 'Performance', 'tmw-whatsapp' ),
			'type' => 'tab_close',
			'value' => '',
		),

		'tab-start-reset-settings' => array(
			'label' => esc_html__( 'Reset', 'tmw-whatsapp' ),
			'type' => 'tab_start',
			'tab_id' => 'tabReset'
		),

		'reset_settings' => array(
			'form_group_class' => 'tmw-form-group-mobile-md',
			'label' => esc_html__( 'Reset Settings To Default', 'tmw-whatsapp' ),
			'desc' => esc_html__( 'Warning: This will reset all plugin settings to it´s default', 'tmw-whatsapp' ),
			'type' => 'switch_onoff',
			'value' => ''
		),

		'tab-close-reset-settings' => array(
			'label' => esc_html__( 'Reset', 'tmw-whatsapp' ),
			'type' => 'tab_close',
			'value' => '',
		),
	)
);
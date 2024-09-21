<?php

/**
 * Elementor Button Widget.
 * 
 * @package Master_Whats_Chat
 */

namespace TM\Master_Whats_Chat\Integration\Elementor;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

use TM\Master_Whats_Chat\Functions;
use TM\Master_Whats_Chat\Translator;

class Button extends \Elementor\Widget_Base {
    /**
     * Constructor.
     * 
     */
    public function __construct($data = array(), $args = null) {
		parent::__construct($data, $args);

	    wp_register_script( 'tmw-whatsapp-widgets-js', TM_MASTER_WHATS_CHAT_URL . '/js/tmw-whatsapp-widgets.js', array( 'elementor-frontend', 'elementor-backend', 'elementor-editor' ), '1.0.0', true );
	}

    public function get_script_depends() {
	    return array( 'tmw-whatsapp-widgets-js' );
	}

	/**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'tmwhatsappwidget';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'TM Whatsapp Button', 'master-whats-chat' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'dashicons dashicons-whatsapp';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'general' );
	}

	/**
	 * Get list with TM WhatsApp attendants in a format for widget field
	 *
	 * Retrieve the list of TM Whatsapp Attendants with ID => Attendant Name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array
	 */
	protected function get_attendants_list() {
        $settings = Functions::get_settings();
		$attendants_list = array();

		if( isset($settings['attendants']) && $settings['attendants'] ) {
			foreach( $settings['attendants'] as $attendantObj ) {
				$attendants_list[ $attendantObj['id'] ] = $attendantObj['name'];
			}
		}
		return $attendants_list;
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'general_section',
			array(
				'label' => esc_html__( 'General', 'master-whats-chat' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'attendant',
			array(
				'label' => esc_html__( 'Select Attendant', 'master-whats-chat' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 0,
				'options' => $this->get_attendants_list(),
			)
		);

		$this->add_control(
			'layout-style',
			array(
				'label' => esc_html__( 'Layout Style', 'master-whats-chat' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'tmw-whatsapp-elementor-wrapper-style-1',
				'options' => array(
					'tmw-whatsapp-elementor-wrapper-style-1'  => esc_html__( 'Style 1', 'master-whats-chat' ),
					'tmw-whatsapp-elementor-wrapper-style-1 tmw-whatsapp-elementor-wrapper-style-1-rounded' => esc_html__( 'Style 2', 'master-whats-chat' ),
				),
			)
		);

		$this->add_control(
			'title',
			array(
				'label' => esc_html__( 'Title', 'master-whats-chat' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'text',
				'placeholder' => esc_html__( 'Type title here...', 'master-whats-chat' ),
			)
		);

		$this->add_control(
			'description',
			array(
				'label' => esc_html__( 'Description', 'master-whats-chat' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'text',
				'placeholder' => esc_html__( 'Description here...', 'master-whats-chat' ),
			)
		);

		$this->add_control(
			'photo_or_icon',
			array(
				'label' => esc_html__( 'Attendant Image', 'master-whats-chat' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'description' => esc_html__( 'Default size for "Attendant Image" is 50x50', 'master-whats-chat' ),
				'default' => 'icon',
				'options' => array(
					'icon'  => esc_html__( 'Whatsapp Icon', 'master-whats-chat' ),
					'image' => esc_html__( 'Attendant Image', 'master-whats-chat' ),
				),
			)
		);

		$this->add_control(
			'alignment',
			array(
				'label' => esc_html__( 'Alignment', 'master-whats-chat' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => array(
					'full-width' => array(
						'title' => esc_html__( 'Full Width', 'master-whats-chat' ),
						'icon' => 'fa fa-align-justify',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'master-whats-chat' ),
						'icon' => 'fa fa-align-center',
					),
					'left' => array(
						'title' => esc_html__( 'Left', 'master-whats-chat' ),
						'icon' => 'fa fa-align-left',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'master-whats-chat' ),
						'icon' => 'fa fa-align-right',
					),
				),
				'default' => 'left',
				'toggle' => true,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'skin_section',
			array(
				'label' => esc_html__( 'Skin', 'master-whats-chat' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'background-color',
			array(
				'label' => esc_html__( 'Background Color', 'master-whats-chat' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#20ab54',
				'selectors' => array(
					'{{WRAPPER}} .tmw-whatsapp-elementor-wrapper.tmw-whatsapp-elementor-wrapper-style-1 .tmw-whatsapp-elementor-body' => 'background: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'background-hover-color',
			array(
				'label' => esc_html__( 'Background Hover Color', 'master-whats-chat' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#38bd6a',
				'selectors' => array(
					'{{WRAPPER}} .tmw-whatsapp-elementor-wrapper:hover .tmw-whatsapp-elementor-body' => 'background: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'icon-color',
			array(
				'label' => esc_html__( 'Icon Color', 'master-whats-chat' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFF',
				'selectors' => array(
					'{{WRAPPER}} .tmw-whatsapp-elementor-wrapper .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-icon' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'icon-hover-color',
			array(
				'label' => esc_html__( 'Icon Hover Color', 'master-whats-chat' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFF',
				'selectors' => array(
					'{{WRAPPER}} .tmw-whatsapp-elementor-wrapper:hover .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-icon' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'title-color',
			array(
				'label' => esc_html__( 'Attendant Name Color', 'master-whats-chat' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFF',
				'selectors' => array(
					'{{WRAPPER}} .tmw-whatsapp-elementor-wrapper .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-title h5' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'title-hover-color',
			array(
				'label' => esc_html__( 'Attendant Name Hover Color', 'master-whats-chat' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFF',
				'selectors' => array(
					'{{WRAPPER}} .tmw-whatsapp-elementor-wrapper:hover .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-title h5' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'description-color',
			array(
				'label' => esc_html__( 'Description Color', 'master-whats-chat' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFF',
				'selectors' => array(
					'{{WRAPPER}} .tmw-whatsapp-elementor-wrapper .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-description p' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'description-hover-color',
			array(
				'label' => esc_html__( 'Description Hover Color', 'master-whats-chat' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFF',
				'selectors' => array(
					'{{WRAPPER}} .tmw-whatsapp-elementor-wrapper:hover .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-description p' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'status-background-color',
			array(
				'label' => esc_html__( 'Status Background Color', 'master-whats-chat' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#61c386',
				'selectors' => array(
					'{{WRAPPER}} .tmw-whatsapp-elementor-wrapper .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-title .tmw-whatsapp-elementor-title-status' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'status-text-color',
			array(
				'label' => esc_html__( 'Status Text Color', 'master-whats-chat' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFF',
				'selectors' => array(
					'{{WRAPPER}} .tmw-whatsapp-elementor-wrapper .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-title .tmw-whatsapp-elementor-title-status' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'badge-offline-message-background',
			array(
				'label' => esc_html__( 'Interval Badge Background', 'master-whats-chat' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ebebeb',
				'selectors' => array(
					'{{WRAPPER}} .tmw-whatsapp-elementor-wrapper.tmw-whatsapp-elementor-wrapper-style-1 .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-info-offline-message' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'badge-offline-message-text',
			array(
				'label' => esc_html__( 'Offline Message Badge Text', 'master-whats-chat' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => array(
					'{{WRAPPER}} .tmw-whatsapp-elementor-wrapper.tmw-whatsapp-elementor-wrapper-style-1 .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-info-offline-message' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'badge-interval-background',
			array(
				'label' => esc_html__( 'Interval Badge Background', 'master-whats-chat' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#e2c80c',
				'selectors' => array(
					'{{WRAPPER}} .tmw-whatsapp-elementor-wrapper.tmw-whatsapp-elementor-wrapper-style-1 .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-info-offline-message.is-interval' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'badge-interval-text',
			array(
				'label' => esc_html__( 'Interval Badge Text', 'master-whats-chat' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => array(
					'{{WRAPPER}} .tmw-whatsapp-elementor-wrapper.tmw-whatsapp-elementor-wrapper-style-1 .tmw-whatsapp-elementor-body .tmw-whatsapp-elementor-info .tmw-whatsapp-elementor-info-offline-message.is-interval' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Attendant Status Output
	 *
	 */
	public function get_attendant_status_html( $settings, $attendants ) {
		$output = '';

		$html_tag = 'span';
		$classes = array( 'tmw-whatsapp-elementor-title-status' );
		$attributes = array();

		$status_text = esc_html__( 'Online', 'master-whats-chat' );

		// Mount Class
		$attributes[] = 'class="'. esc_attr( implode( ' ', $classes ) ) .'"';

		// Output
		$output .= '<'. $html_tag .' '. implode( ' ', $attributes ) .'>';
			$output .= esc_html( $status_text );
		$output .= '</'. $html_tag .'>';

		return $output;
	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$attendants = Functions::get_attendants();
		if( $attendants === NULL ) {
			echo esc_html__( 'None attendant is registered to show in this widget. Please register at least one attendant to render the widget.', 'master-whats-chat' );

			return;
		}

		// Attendant ID
		$attendant_id = $settings['attendant'];

		// Attendant Availability
		$attendantAvailability = base64_encode( wp_json_encode( $attendants[ $attendant_id ]['availability'] ) );

		// Attendant Title
		$title = !empty( $settings['title'] ) ? $settings['title'] : $attendants[ $attendant_id ]['name'];

		// Attendant Description
		$description = !empty( $settings['description'] ) ? $settings['description'] : $attendants[ $attendant_id ]['description'];

		$wrapper_classes = array( 'tmw-whatsapp-elementor-wrapper' );
		$wrapper_atts = array(); 

		// Layout Style
		$wrapper_classes[] = $settings['layout-style'];

		// Alignment
		switch ( $settings['alignment'] ) {
			case 'full-width':
				$wrapper_classes[] = 'tmw-whatsapp-elementor-wrapper-full-width';
				break;

			case 'center':
				$wrapper_classes[] = 'tmw-whatsapp-elementor-wrapper-align-center';
				break;

			case 'right':
				$wrapper_classes[] = 'tmw-whatsapp-elementor-wrapper-align-right';
				break;

			case 'left':
			default:
				$wrapper_classes[] = 'tmw-whatsapp-elementor-wrapper-align-left';
				break;
		}

		// Mount Class
		$wrapper_atts[] = 'class="'. esc_attr( implode( ' ', $wrapper_classes ) ) .'"';

		$output = '';

		$output .= '<a href="#" class="tmw-whatsapp-button tmw-fadeIn tmw-d-block" data-phone-number="'. esc_attr( Translator::translate_string( $attendants[ $attendant_id ]['phone'], 'atendant_'. array( $attendant_id ) .'_phone' ) ) .'" data-availability="'. esc_attr( $attendantAvailability ) .'" data-default-timezone="'. esc_attr( $attendants[ $attendant_id ]['default_timezone'] ) .'"'. ( empty($attendants[ $attendant_id ]['phone'] ) ? ' disabled' : '' ) .'>';
			$output .= '<div '. implode( ' ', $wrapper_atts ) .'>';
				$output .= '<div class="tmw-whatsapp-elementor-body">';
					$output .= '<div class="tmw-whatsapp-elementor-icon">';
					if( $settings['photo_or_icon'] == 'icon' ) {
						$output .= '<i class="tmw-fab tmw-fa-whatsapp"></i>';
					} else {
						$image = array(
							'image' => $attendants[ $attendant_id ]['image']['attendant-image'] ? wp_get_attachment_url( $attendants[ $attendant_id ]['image']['attendant-image'] ) : TM_MASTER_WHATS_CHAT_URL . '/img/user-placeholder.png',
							'width' => 150,
							'height' => 150,
						);

						$output .= '<img src="'. esc_url( $image['image'] ) .'" width="'. esc_attr( $image['width'] ) .'" height="'. esc_attr( $image['height'] ) .'" alt="" />';
					}
					$output .= '</div>';
					$output .= '<div class="tmw-whatsapp-elementor-info">';
						$output .= '<span class="tmw-whatsapp-elementor-info-offline-message">'. esc_html( Translator::translate_string( $attendants[ $attendant_id ]['offline_message'], 'atendant_'. array( $attendant_id ) .'_offline_message' ) ) .'</span>';
						$output .= '<span class="tmw-whatsapp-elementor-info-offline-message is-interval">'. esc_html( Translator::translate_string( $attendants[ $attendant_id ]['interval_message'], 'atendant_'. array( $attendant_id ) .'_interval_message' ) ) .'</span>';
						$output .= '<div class="tmw-whatsapp-elementor-title">';
							$output .= '<h5>'. esc_html( $title ) .'</h5>';
							$output .= $this->get_attendant_status_html( $settings, $attendants );
						$output .= '</div>';
						if( !empty($description) ) {
							$output .= '<div class="tmw-whatsapp-elementor-description">';
								$output .= '<p>'. esc_html( $description ) .'</p>';
							$output .= '</div>';
						}
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</a>';

		echo '<div class="tmw-whatsapp-elementor-widget">';
			echo wp_kses_post( $output );
		echo '</div>';
	}
}
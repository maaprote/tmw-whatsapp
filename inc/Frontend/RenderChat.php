<?php

/**
 * Render the chat.
 * 
 * @package Master_Whats_Chat
 */

namespace TMWC\Master_Whats_Chat\Frontend;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

use TMWC\Master_Whats_Chat\Views\ChatWidget;

class RenderChat {

    /**
     * Constructor.
     * 
     */
    public function __construct() {
        add_action( 'wp_footer', array( $this, 'render' ) );
    }

    /**
     * Render.
     *
     * @return void 
     */
    public function render() {
        ChatWidget::instance();
    }
}
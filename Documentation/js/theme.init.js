// Commom Plugins
(function($) {

	'use strict';

	// Scroll to Top Button.
	if (typeof theme.PluginScrollToTop !== 'undefined') {
		theme.PluginScrollToTop.initialize();
	}

	// Tooltips
	if ($.isFunction($.fn['tooltip']) && ( $('[data-tooltip]').length || $('[data-plugin-tooltip]').length )) {
		$('[data-tooltip]:not(.manual), [data-plugin-tooltip]:not(.manual)').tooltip();
	}

	// Popover
	if ($.isFunction($.fn['popover']) && $('[data-plugin-popover]').length) {
		$(function() {
			$('[data-plugin-popover]:not(.manual)').each(function() {
				var $this = $(this),
					opts;

				var pluginOptions = theme.fn.getOptions($this.data('plugin-options'));
				if (pluginOptions)
					opts = pluginOptions;

				$this.popover(opts);
			});
		});
	}

	// Validations
	if ( $.isFunction($.validator) && typeof theme.PluginValidation !== 'undefined') {
		theme.PluginValidation.initialize();
	}

}).apply(this, [jQuery]);

// Animate
(function($) {

	'use strict';

	if ($.isFunction($.fn['themePluginAnimate']) && $('[data-appear-animation]').length) {
		theme.fn.dynIntObsInit( '[data-appear-animation], [data-appear-animation-svg]', 'themePluginAnimate', theme.PluginAnimate.defaults );
	}

}).apply(this, [jQuery]);

// Animated Letters
(function($) {

	'use strict';

	if ($.isFunction($.fn['themePluginAnimatedLetters']) && ( $('[data-plugin-animated-letters]').length || $('.animated-letters').length )) {
		theme.fn.intObsInit( '[data-plugin-animated-letters]:not(.manual), .animated-letters', 'themePluginAnimatedLetters' );
	}

}).apply(this, [jQuery]);

// Before / After
(function($) {

	'use strict';

	if ($.isFunction($.fn['themePluginBeforeAfter']) && $('[data-plugin-before-after]').length) {
		theme.fn.intObsInit( '[data-plugin-before-after]:not(.manual)', 'themePluginBeforeAfter' );
	}

}).apply(this, [jQuery]);

// Carousel Light
(function($) {

	'use strict';

	if ($.isFunction($.fn['themePluginCarouselLight']) && $('.owl-carousel-light').length) {
		theme.fn.intObsInit( '.owl-carousel-light', 'themePluginCarouselLight' );
	}

}).apply(this, [jQuery]);

// Carousel
(function($) {

	'use strict';

	if ($.isFunction($.fn['themePluginCarousel']) && $('[data-plugin-carousel]:not(.manual), .owl-carousel:not(.manual)').length) {
		theme.fn.intObsInit( '[data-plugin-carousel]:not(.manual), .owl-carousel:not(.manual)', 'themePluginCarousel' );
	}

}).apply(this, [jQuery]);

// Chart.Circular
(function($) {

	'use strict';

	if ($.isFunction($.fn['themePluginChartCircular']) && ( $('[data-plugin-chart-circular]').length || $('.circular-bar-chart').length )) {
		theme.fn.dynIntObsInit( '[data-plugin-chart-circular]:not(.manual), .circular-bar-chart:not(.manual)', 'themePluginChartCircular', theme.PluginChartCircular.defaults );
	}

}).apply(this, [jQuery]);

// Countdown
(function($) {

	'use strict';

	if ($.isFunction($.fn['themePluginCountdown']) && ( $('[data-plugin-countdown]').length || $('.countdown').length )) {
		theme.fn.intObsInit( '[data-plugin-countdown]:not(.manual), .countdown', 'themePluginCountdown' );
	}

}).apply(this, [jQuery]);

// Counter
(function($) {

	'use strict';

	if ($.isFunction($.fn['themePluginCounter']) && ( $('[data-plugin-counter]').length || $('.counters [data-to]').length )) {
		theme.fn.dynIntObsInit( '[data-plugin-counter]:not(.manual), .counters [data-to]', 'themePluginCounter', theme.PluginCounter.defaults );
	}

}).apply(this, [jQuery]);

// Cursor Effect
(function($) {

	'use strict';

	if ($.isFunction($.fn['themePluginCursorEffect']) && $('[data-plugin-cursor-effect]').length ) {
		theme.fn.intObsInit( '[data-plugin-cursor-effect]:not(.manual)', 'themePluginCursorEffect' );
	}

}).apply(this, [jQuery]);

// Float Element
(function($) {

	'use strict';

	if ($.isFunction($.fn['themePluginFloatElement']) && $('[data-plugin-float-element]').length) {
		theme.fn.intObsInit( '[data-plugin-float-element], [data-plugin-float-element-svg]', 'themePluginFloatElement' );
	}

}).apply(this, [jQuery]);

// GDPR
(function($) {

	'use strict';

	if ($.isFunction($.fn['themePluginGDPR']) && $('[data-plugin-gdpr]').length) {

		$(function() {
			$('[data-plugin-gdpr]:not(.manual)').each(function() {
				var $this = $(this),
					opts;

				var pluginOptions = theme.fn.getOptions($this.data('plugin-options'));
				if (pluginOptions)
					opts = pluginOptions;

				$this.themePluginGDPR(opts);
			});
		});

	}

}).apply(this, [jQuery]);

// GDPR Wrapper
(function($) {

	'use strict';

	if ($.isFunction($.fn['themePluginGDPRWrapper']) && $('[data-plugin-gdpr-wrapper]').length) {

		$(function() {
			$('[data-plugin-gdpr-wrapper]:not(.manual)').each(function() {
				var $this = $(this),
					opts;

				var pluginOptions = theme.fn.getOptions($this.data('plugin-options'));
				if (pluginOptions)
					opts = pluginOptions;

				$this.themePluginGDPRWrapper(opts);
			});
		});

	}

}).apply(this, [jQuery]);

// Animated Icon
(function($) {

	'use strict';

	if ($.isFunction($.fn['themePluginIcon']) && $('[data-icon]').length) {
		theme.fn.intObsInit( '[data-icon]:not(.svg-inline--fa)', 'themePluginIcon' );
	}

}).apply(this, [jQuery]);

// Lightbox
(function($) {

	'use strict';

	if ($.isFunction($.fn['themePluginLightbox']) && ( $('[data-plugin-lightbox]').length || $('.lightbox').length )) {
		theme.fn.execOnceTroughEvent( '[data-plugin-lightbox]:not(.manual), .lightbox:not(.manual)', 'mouseover.trigger.lightbox', function(){
			var $this = $(this),
				opts;

			var pluginOptions = theme.fn.getOptions($this.data('plugin-options'));
			if (pluginOptions)
				opts = pluginOptions;

			$this.themePluginLightbox(opts);
		});
	}

}).apply(this, [jQuery]);

// Masonry
(function($) {

	'use strict';

	if ($.isFunction($.fn['themePluginMasonry']) && $('[data-plugin-masonry]').length) {

		$(function() {
			$('[data-plugin-masonry]:not(.manual)').each(function() {
				var $this = $(this),
					opts;

				var pluginOptions = theme.fn.getOptions($this.data('plugin-options'));
				if (pluginOptions)
					opts = pluginOptions;

				$this.themePluginMasonry(opts);
			});
		});

	}

}).apply(this, [jQuery]);

// Match Height
(function($) {

	'use strict';

	if ($.isFunction($.fn['themePluginMatchHeight']) && $('[data-plugin-match-height]').length) {

		$(function() {
			$('[data-plugin-match-height]:not(.manual)').each(function() {
				var $this = $(this),
					opts;

				var pluginOptions = theme.fn.getOptions($this.data('plugin-options'));
				if (pluginOptions)
					opts = pluginOptions;

				$this.themePluginMatchHeight(opts);
			});
		});

	}

}).apply(this, [jQuery]);

// Parallax
(function($) {

	'use strict';

	if ($.isFunction($.fn['themePluginParallax']) && $('[data-plugin-parallax]').length) {
		theme.fn.intObsInit( '[data-plugin-parallax]:not(.manual)', 'themePluginParallax' );
	}

}).apply(this, [jQuery]);

// Progress Bar
(function($) {

	'use strict';

	if ($.isFunction($.fn['themePluginProgressBar']) && ( $('[data-plugin-progress-bar]') || $('[data-appear-progress-animation]').length )) {
		theme.fn.dynIntObsInit( '[data-plugin-progress-bar]:not(.manual), [data-appear-progress-animation]', 'themePluginProgressBar', theme.PluginProgressBar.defaults );
	}

}).apply(this, [jQuery]);

// Read More
(function($) {

	'use strict';

	if ($.isFunction($.fn['themePluginReadMore']) && $('[data-plugin-readmore]').length) {
		theme.fn.intObsInit( '[data-plugin-readmore]:not(.manual)', 'themePluginReadMore' );
	}

}).apply(this, [jQuery]);

// Revolution Slider
(function($) {

	'use strict';

	if ($.isFunction($.fn['themePluginRevolutionSlider']) && ( $('[data-plugin-revolution-slider]').length || $('.slider-container .slider').length )) {

		$(function() {
			$('[data-plugin-revolution-slider]:not(.manual), .slider-container .slider:not(.manual)').each(function() {
				var $this = $(this),
					opts;

				var pluginOptions = theme.fn.getOptions($this.data('plugin-options'));
				if (pluginOptions)
					opts = pluginOptions;

				$this.themePluginRevolutionSlider(opts);
			});
		});

	}

}).apply(this, [jQuery]);

// Scrollable
(function($) {

	'use strict';

	if ( $.isFunction($.fn[ 'nanoScroller' ]) && $('[data-plugin-scrollable]').length ) {
		theme.fn.intObsInit( '[data-plugin-scrollable]', 'themePluginScrollable' );
	}

}).apply(this, [jQuery]);

// Section Scroll
(function($) {

	'use strict';

	if ($.isFunction($.fn['themePluginSectionScroll']) && $('[data-plugin-section-scroll]').length) {

		$(function() {
			$('[data-plugin-section-scroll]:not(.manual)').each(function() {
				var $this = $(this),
					opts;

				var pluginOptions = theme.fn.getOptions($this.data('plugin-options'));
				if (pluginOptions)
					opts = pluginOptions;

				$this.themePluginSectionScroll(opts);
			});
		});

	}

}).apply(this, [jQuery]);

// Sort
(function($) {

	'use strict';

	if ($.isFunction($.fn['themePluginSort']) && ( $('[data-plugin-sort]').length || $('.sort-source').length )) {
		theme.fn.intObsInit( '[data-plugin-sort]:not(.manual), .sort-source:not(.manual)', 'themePluginSort' );
	}

}).apply(this, [jQuery]);

// Star Rating
(function($) {

	'use strict';

	if ($.isFunction($.fn['themePluginStarRating']) && $('[data-plugin-star-rating]').length) {
		theme.fn.intObsInit( '[data-plugin-star-rating]:not(.manual)', 'themePluginStarRating' );
	}

}).apply(this, [jQuery]);

// Sticky
(function($) {

	'use strict';

	if ($.isFunction($.fn['themePluginSticky']) && $('[data-plugin-sticky]').length) {
		theme.fn.execOnceTroughWindowEvent( window, 'scroll.trigger.sticky', function(){
			$('[data-plugin-sticky]:not(.manual)').each(function() {
				var $this = $(this),
					opts;

				var pluginOptions = theme.fn.getOptions($this.data('plugin-options'));
				if (pluginOptions)
					opts = pluginOptions;

				$this.themePluginSticky(opts);
			});
		});
	}

}).apply(this, [jQuery]);

// Toggle
(function($) {

	'use strict';

	if ($.isFunction($.fn['themePluginToggle']) && $('[data-plugin-toggle]').length) {
		theme.fn.intObsInit( '[data-plugin-toggle]:not(.manual)', 'themePluginToggle' );
	}

}).apply(this, [jQuery]);

// Tweets
(function($) {

	'use strict';

	if ($.isFunction($.fn['themePluginTweets']) && $('[data-plugin-tweets]').length) {

		$(function() {
			$('[data-plugin-tweets]:not(.manual)').each(function() {
				var $this = $(this),
					opts;

				var pluginOptions = theme.fn.getOptions($this.data('plugin-options'));
				if (pluginOptions)
					opts = pluginOptions;

				$this.themePluginTweets(opts);
			});
		});

	}

}).apply(this, [jQuery]);

// Video Background
(function($) {

	'use strict';

	if ($.isFunction($.fn['themePluginVideoBackground']) && $('[data-plugin-video-background]').length) {
		theme.fn.intObsInit( '[data-plugin-video-background]:not(.manual)', 'themePluginVideoBackground' );
	}

}).apply(this, [jQuery]);

// Commom Partials
(function($) {

	'use strict';

	// Sticky Header
	if (typeof theme.StickyHeader !== 'undefined') {
		theme.StickyHeader.initialize();
	}

	// Nav Menu
	if (typeof theme.Nav !== 'undefined') {
		theme.Nav.initialize();
	}

	// Search
	if (typeof theme.Search !== 'undefined' && ( $('#searchForm').length || $('.header-nav-features-search-reveal').length )) {
		theme.Search.initialize();
	}

	// Newsletter
	if (typeof theme.Newsletter !== 'undefined' && $('#newsletterForm').length) {
		theme.fn.intObs( '#newsletterForm', 'theme.Newsletter.initialize();', {} );
	}

	// Account
	if (typeof theme.Account !== 'undefined' && ( $('#headerAccount').length || $('#headerSignUp').length || $('#headerSignIn').length || $('#headerRecover').length || $('#headerRecoverCancel').length )) {
		theme.Account.initialize();
	}

}).apply(this, [jQuery]);
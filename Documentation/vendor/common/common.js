/*
Plugin Name: 	BrowserSelector
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version:	8.0.0
*/

(function($) {
	$.extend({

		browserSelector: function() {

			// jQuery.browser.mobile (http://detectmobilebrowser.com/)
			(function(a){(jQuery.browser=jQuery.browser||{}).mobile=/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))})(navigator.userAgent||navigator.vendor||window.opera);

			// Touch
			var hasTouch = 'ontouchstart' in window || navigator.msMaxTouchPoints;

			var u = navigator.userAgent,
				ua = u.toLowerCase(),
				is = function (t) {
					return ua.indexOf(t) > -1;
				},
				g = 'gecko',
				w = 'webkit',
				s = 'safari',
				o = 'opera',
				h = document.documentElement,
				b = [(!(/opera|webtv/i.test(ua)) && /msie\s(\d)/.test(ua)) ? ('ie ie' + parseFloat(navigator.appVersion.split("MSIE")[1])) : is('firefox/2') ? g + ' ff2' : is('firefox/3.5') ? g + ' ff3 ff3_5' : is('firefox/3') ? g + ' ff3' : is('gecko/') ? g : is('opera') ? o + (/version\/(\d+)/.test(ua) ? ' ' + o + RegExp.jQuery1 : (/opera(\s|\/)(\d+)/.test(ua) ? ' ' + o + RegExp.jQuery2 : '')) : is('konqueror') ? 'konqueror' : is('chrome') ? w + ' chrome' : is('iron') ? w + ' iron' : is('applewebkit/') ? w + ' ' + s + (/version\/(\d+)/.test(ua) ? ' ' + s + RegExp.jQuery1 : '') : is('mozilla/') ? g : '', is('j2me') ? 'mobile' : is('iphone') ? 'iphone' : is('ipod') ? 'ipod' : is('mac') ? 'mac' : is('darwin') ? 'mac' : is('webtv') ? 'webtv' : is('win') ? 'win' : is('freebsd') ? 'freebsd' : (is('x11') || is('linux')) ? 'linux' : '', 'js'];

			c = b.join(' ');

			if ($.browser.mobile) {
				c += ' mobile';
			}

			if (hasTouch) {
				c += ' touch';
			}

			h.className += ' ' + c;

			// Edge Detect
			var isEdge = /Edge/.test(navigator.userAgent);

			if(isEdge) {
				$('html').removeClass('chrome').addClass('edge');
			}

			// IE11 Detect
			var isIE11 = !(window.ActiveXObject) && "ActiveXObject" in window;

			if (isIE11) {
				$('html').removeClass('gecko').addClass('ie ie11');
				return;
			}

			// Dark and Boxed Compatibility
			if($('body').hasClass('dark')) {
				$('html').addClass('dark');
			}

			if($('body').hasClass('boxed')) {
				$('html').addClass('boxed');
			}

		}

	});

	$.browserSelector();

	/*
	Global Variable For Screen Size
	*/
	theme.globalWindowWidth = $(window).width();
	var globalWindowWidth = $(window).width();
	window.onresize = function() {
		theme.globalWindowWidth = $(window).width();
	}

	/*
	Browser Workarounds
	*/
	if (/iPad|iPhone|iPod/.test(navigator.platform)) {

		// iPad/Iphone/iPod Hover Workaround
		$(document).ready(function($) {
			$('.thumb-info').attr('onclick', 'return true');
		});
	}

	/*
	Tooltip and Popover
	*/
	$(window).on('load', function() {
		if( $('[data-toggle="tooltip"]').length ) {
			$('[data-toggle="tooltip"]').tooltip();
		}
		if( $('[data-toggle="popover"]').length ) {
			$('[data-toggle="popover"]').popover();
		}
	});

	/*
	Tabs
	*/
	if( $('a[data-toggle="tab"]').length ) {
		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
			$(this).parents('.nav-tabs').find('.active').removeClass('active');
			$(this).addClass('active').parent().addClass('active');
		});	
	}

	if( window.location.hash ) {
		$(window).on('load', function(){
			if( $( window.location.hash ).get(0) ) {
				$('a.nav-link[href="'+ window.location.hash +'"]:not([data-hash])').trigger('click');
			}
		});
	}

	if( $('a[data-toggle="tab"]').length ) {
		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
			var $tabPane = $($(e.target).attr('href'));

			if($tabPane.length) {

				// Carousel Refresh
				$tabPane.find('.owl-carousel').trigger('refresh.owl.carousel');
			}
		});
	}

	/*
	On Load Scroll
	*/
	if( !$('html').hasClass('disable-onload-scroll') && window.location.hash && !['#*'].includes( window.location.hash ) ) {

		window.scrollTo(0, 0);

		$(window).on('load', function() {
			setTimeout(function() {

				var target = window.location.hash,
					offset = ( $(window).width() < 768 ) ? 180 : 90;

				if (!$(target).length) {
					return;
				}

				if ( $("a[href$='" + window.location.hash + "']").is('[data-hash-offset]') ) {
					offset = parseInt( $("a[href$='" + window.location.hash + "']").first().attr('data-hash-offset') );
				} else if ( $("html").is('[data-hash-offset]') ) {
					offset = parseInt( $("html").attr('data-hash-offset') );
				}

				if (isNaN(offset)) {
					offset = 0;
				}

				$('body').addClass('scrolling');

				$('html, body').animate({
					scrollTop: $(target).offset().top - offset
				}, 600, 'easeOutQuad', function() {
					$('body').removeClass('scrolling');
				});

			}, 1);
		});
	}

	/*
	* Text Rotator
	*/
	$.fn.extend({
		textRotator: function(options) {

			var defaults = {
				fadeSpeed: 500,
				pauseSpeed: 100,
				child: null
			};

			var options = $.extend(defaults, options);

			return this.each(function() {
				var o = options;
				var obj = $(this);
				var items = $(obj.children(), obj);
				items.each(function() {
					$(this).hide();
				})
				if (!o.child) {
					var next = $(obj).children(':first');
				} else {
					var next = o.child;
				}
				$(next).fadeIn(o.fadeSpeed, function() {
					$(next).delay(o.pauseSpeed).fadeOut(o.fadeSpeed, function() {
						var next = $(this).next();
						if (next.length == 0) {
							next = $(obj).children(':first');
						}
						$(obj).textRotator({
							child: next,
							fadeSpeed: o.fadeSpeed,
							pauseSpeed: o.pauseSpeed
						});
					})
				});
			});
		}
	});

	/*
	* Notice Top bar
	*/
	var $noticeTopBar = {
		$wrapper: $('.notice-top-bar'),
		$closeBtn: $('.notice-top-bar-close'),
		$header: $('#header'),
		$body: $('.body'),
		init: function() {
			var self = this;

			if( !$.cookie('portoNoticeTopBarClose') ) {
				self
					.build()
					.events();
			} else {
				self.$wrapper.parent().prepend( '<!-- Notice Top Bar removed by cookie -->' );
				self.$wrapper.remove();
			}

			return this;
		},
		build: function(){
			var self = this;

			$(window).on('load', function(){
				setTimeout(function(){
					self.$body.css({
						'margin-top': self.$wrapper.outerHeight(),
						'transition': 'ease margin 300ms'
					});

					$('#noticeTopBarContent').textRotator({
						fadeSpeed: 500,
						pauseSpeed: 5000
					});

					if( ['absolute', 'fixed'].includes( self.$header.css('position') ) ) {
						self.$header.css({
							'top': self.$wrapper.outerHeight(),
							'transition': 'ease top 300ms'
						});
					}

					$(window).trigger('notice.top.bar.opened');

				}, 1000);
			});

			return this;
		},
		events: function() {
			var self = this;

			self.$closeBtn.on('click', function(e){
				e.preventDefault();

				self.$body.animate({
					'margin-top': 0,
				}, 300, function(){
					self.$wrapper.remove();
					self.saveCookie();
				});

				if( ['absolute', 'fixed'].includes( self.$header.css('position') ) ) {
					self.$header.animate({
						top: 0
					}, 300);
				}

				// When header has shrink effect
				if( self.$header.hasClass('header-effect-shrink') ) {
					self.$header.find('.header-body').animate({
						top: 0
					}, 300);
				}

				$(window).trigger('notice.top.bar.closed');
			});

			return this;
		},
		checkCookie: function(){
			var self = this;

			if( $.cookie('portoNoticeTopBarClose') ) {
				return true;
			} else {
				return false;
			}

			return this;
		},
		saveCookie: function() {
			var self = this;

			$.cookie('portoNoticeTopBarClose', true);

			return this;
		}
	}

	if( $('.notice-top-bar').length ) {
		$noticeTopBar.init();
	}

	/*
	* Image Hotspots
	*/
	if( $('.image-hotspot').length ) {
		$('.image-hotspot')
			.append('<span class="ring"></span>')
			.append('<span class="circle"></span>');
	}

	/*
	* Page Transition
	*/
	if( $('body[data-plugin-page-transition]').length ) {
		
		var link_click = false;

		$(document).on('click', 'a', function(e){
			link_click = $(this);
		});

		$(window).on("beforeunload", function(e) {
			if( typeof link_click === 'object' ) {
				var href = link_click.attr('href');

				if( href.indexOf('mailto:') != 0 && href.indexOf('tel:') != 0 && !link_click.data('rm-from-transition') ) {
					$('body').addClass('page-transition-active');
				}
			}
		});

		$(window).on("pageshow", function(e){
			if( e.persisted ) {
				if( $('html').hasClass('safari') ) {
					window.location.reload();
				}
				
		        $('body').removeClass('page-transition-active');
		    }
		});
	}

	/*
	* Thumb Info Floating Caption
	*/
	if( $('.thumb-info-floating-caption').length ) {

		$('.thumb-info-floating-caption').on('mouseenter', function(){
			if( !$('.thumb-info-floating-caption-title').length ) {
				$('.body').append( '<div class="thumb-info-floating-caption-title">'+ $(this).data('title') +'</div>' );

				if( $(this).data('type') ) {
					$('.thumb-info-floating-caption-title')
						.append( '<div class="thumb-info-floating-caption-type">'+ $(this).data('type') +'</div>' )
						.css({
							'padding-bottom' : 22
						});
				}

				if( $(this).hasClass('thumb-info-floating-caption-clean') ) {
					$('.thumb-info-floating-caption-title').addClass('bg-transparent');
				}
			}
		}).on('mouseout', function(){
			$('.thumb-info-floating-caption-title').remove();
		});

		$(document).on('mousemove', function(e){
			$('.thumb-info-floating-caption-title').css({
				position: 'fixed',
				left: e.clientX - 20,
				top: e.clientY + 20
			});
		});

	}

	/*
	* Toggle Text Click
	*/
	$('[data-toggle-text-click]').on('click', function () {
		$(this).text(function(i, text){
			return text === $(this).attr('data-toggle-text-click') ? $(this).attr('data-toggle-text-click-alt') : $(this).attr('data-toggle-text-click');
		});
	});

	/*
	* Shape Divider Aspect Ratio
	*/
	if( $('.shape-divider').length ) {
		aspectRatioSVG();
		$(window).on('resize', function(){
			aspectRatioSVG();
		});
	}

	/*
	* Shape Divider Animated
	*/
	if( $('.shape-divider-horizontal-animation').length ) {
		theme.fn.intObs('.shape-divider-horizontal-animation', function(){
			for( var i = 0; i <= 1; i++ ) {
				var svgClone = $(this).find('svg:nth-child(1)').clone();

				$(this).append( svgClone )
			}

			$(this).addClass('start');
		}, {});
	}

	/*
	* Toggle Class
	*/
	$('[data-porto-toggle-class]').on('click', function (e) {
		e.preventDefault();

		$(this).toggleClass( $(this).data('porto-toggle-class') );
	});

	/*
	* Dynamic Height
	*/
	var $window = $(window);
	$window.on('resize dynamic.height.resize', function(){
		$('[data-dynamic-height]').each(function(){
			var $this = $(this),
				values = JSON.parse($this.data('dynamic-height').replace(/'/g,'"').replace(';',''))

			// XS
			if( $window.width() < 576 ) {
				$this.height( values[4] );
			}

			// SM
			if( $window.width() > 575 && $window.width() < 768 ) {
				$this.height( values[3] );
			}

			// MD
			if( $window.width() > 767 && $window.width() < 992 ) {
				$this.height( values[2] );
			}

			// LG
			if( $window.width() > 991 && $window.width() < 1200 ) {
				$this.height( values[1] );
			}

			// XS
			if( $window.width() > 1199 ) {
				$this.height( values[0] );
			}
		});
	});

	// Mobile First Load
	if( $window.width() < 992 ) {
		$window.trigger('dynamic.height.resize');
	}

	/* Video - Trigger Play */
	if( $('[data-trigger-play-video]').length ) {
		theme.fn.execOnceTroughEvent( '[data-trigger-play-video]', 'mouseover.trigger.play.video', function(){
			var $video = $( $(this).data('trigger-play-video') );

			$(this).on('click', function(e){
				e.preventDefault();

				if( $(this).data('trigger-play-video-remove') == 'yes' ) {
					$(this).animate({
						opacity: 0
					}, 300, function(){
						$video[0].play();

						$(this).remove();
					});
				} else {
					setTimeout(function(){
						$video[0].play();
					},300);
				}
			});
		});
	}

	/* Video - Custom Auto Play */
	if( $('video[data-auto-play]').length ) {
		$(window).on('load', function(){
			$('video[data-auto-play]').each(function(){
				var $video = $(this);

				setTimeout(function(){
					if( $( '#' + $video.attr('id') ).length ) {
						if( $( '[data-trigger-play-video="#' + $video.attr('id') + '"]' ).data('trigger-play-video-remove') == 'yes' ) {
							$( '[data-trigger-play-video="#' + $video.attr('id') + '"]' ).animate({
								opacity: 0
							}, 300, function(){
								$video[0].play();

								$( '[data-trigger-play-video="#' + $video.attr('id') + '"]' ).remove();
							});
						} else {
							setTimeout(function(){
								$video[0].play();
							},300);
						}
					}
				}, 100);

			});
		});
	}

	/*
	* Remove min height after the load of page
	*/
	if( $('[data-remove-min-height]').length ) {
		$(window).on('load', function(){
			$('[data-remove-min-height]').each(function(){
				$(this).css({
					'min-height': 0
				});
			});
		});
	}

	/*
	* Style Switcher Open Loader Button
	*/
	if( $('.style-switcher-open-loader').length ) {

		$('.style-switcher-open-loader').on('click', function(e){
			e.preventDefault();

			var $this = $(this);

			// Add Spinner to icon
			$this.addClass('style-switcher-open-loader-loading');

			var	basePath = $(this).data('base-path'),
				skinSrc = $(this).data('skin-src');

			var script1 = document.createElement("script");
		  	script1.src = basePath + "master/style-switcher/style.switcher.localstorage.js";

		  	var script2 = document.createElement("script");
		  	script2.src = basePath + "master/style-switcher/style.switcher.js";
		  	script2.id = "styleSwitcherScript";
		  	script2.setAttribute('data-base-path', basePath);
		  	script2.setAttribute('data-skin-src', skinSrc);

		  	script2.onload = function() {
		  		setTimeout(function(){
		  			// Trigger a click to open the style switcher sidebar
			  		function checkIfReady() {
					    if( !$('.style-switcher-open').length ) {
					       window.setTimeout(checkIfReady, 100);
					    } else {
					      $('.style-switcher-open').trigger('click');
					    }
					}
					checkIfReady();

		  		}, 500);
		  	}

		  	document.body.appendChild(script1);
		  	document.body.appendChild(script2);	

		});

	}

	})(jQuery);

/*
* Scroll and Focus
*/
function scrollAndFocus($this, scrollTarget, focusTarget, scrollOffset, scrollAgain) {
	(function($) {

		$('body').addClass('scrolling');

		// if it's inside a header menu
		if( $($this).closest('#mainNav').length ) {
			$($this).parents('.collapse.show').collapse('hide');
		}

		$('html, body').animate({
			scrollTop: $(scrollTarget).offset().top - (scrollOffset ? scrollOffset : 0)
		}, 300, function() {
			$('body').removeClass('scrolling');

			setTimeout(function(){
				$(focusTarget).focus();
			}, 500);

			if( scrollAgain ) {
				$('html, body').animate({
					scrollTop: $(scrollTarget).offset().top - (scrollOffset ? scrollOffset : 0)
				});
			}
		});
	})(jQuery);
}

/*
* Shape Divider - SVG Aspect Ratio
*/
function aspectRatioSVG() {
	if( $(window).width() < 1950 ) {
		$('.shape-divider svg[preserveAspectRatio]').each(function(){
			if( !$(this).parent().hasClass('shape-divider-horizontal-animation') ) {
				$(this).attr('preserveAspectRatio', 'xMinYMin');
			} else {
				$(this).attr('preserveAspectRatio', 'none');
			}
		});
	} else {
		$('.shape-divider svg[preserveAspectRatio]').each(function(){
			$(this).attr('preserveAspectRatio', 'none');
		});
	}
}

/*
* Lazy Load Background Images (with lazySizes plugin)
*/
document.addEventListener('lazybeforeunveil', function(e){
    var bg = e.target.getAttribute('data-bg-src');
    if(bg){
        e.target.style.backgroundImage = 'url(' + bg + ')';
    }
});
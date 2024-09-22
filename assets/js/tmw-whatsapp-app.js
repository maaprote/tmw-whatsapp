"use strict";

(function ($) {
  'use strict';

  var MasterWhatsChatApp = window || {};
  MasterWhatsChatApp = {
    initialize: function initialize() {
      this.$wrapper = $('.tmw-whatsapp-wrapper');
      this.$attendant = $('.tmw-whatsapp-attendant');
      this.$presentationInfo = $('.tmw-whatsapp-presentation-info');
      this.$attendantHeaderInfo = $('.tmw-whatsapp-active-attendant-info');
      this.$attendantHeaderImage = $('.tmw-whatsapp-attendant-info-image');
      this.$chatWindow = $('.tmw-whatsapp-attendant-chat-window');
      this.$chatSendButton = $('.tmw-whatsapp-attendant-chat-send-button');
      this.$chatInputMessage = $('.tmw-whatsapp-attendant-chat-input-message');
      this.$attendantInfoBack = $('.tmw-whatsapp-active-attendant-info-back');
      this.$triggerButton = $('.tmw-whatsapp-trigger-button');
      this.$closeButton = $('.tmw-whatsapp-close-button');
      this.$openWhatsappChatType = $('.tmw-whatsapp-wrapper').data('tmw-open-whatsapp-chat-type');
      this.build().events();
      return this;
    },
    build: function build() {
      var _self = this;

      // Available Hours (Attendant is Online ?)
      _self.$attendant.each(function () {
        var $attendant = $(this),
          attendantAvailability = JSON.parse(atob($(this).data('availability'))),
          weekDayToday = new Date().toLocaleString('en-us', {
            weekday: 'long',
            timezone: $(this).data('default-timezone')
          }).toLowerCase(),
          attendantIsAvailableNow = false;
        if (attendantAvailability[weekDayToday].available == 'no') {
          $attendant.addClass('tmw-attendant-is-offline');
        } else {
          if (attendantAvailability[weekDayToday].available == 'yes') {
            $attendant.addClass('tmw-attendant-is-online');
            attendantIsAvailableNow = true;
            if (attendantAvailability[weekDayToday].start != '' && attendantAvailability[weekDayToday].end != '') {
              var attendantTimezone = attendantAvailability[weekDayToday].timezone == '' || attendantAvailability[weekDayToday].timezone == $(this).data('default-timezone') ? $(this).data('default-timezone') : attendantAvailability[weekDayToday].timezone,
                attendantStartTime = moment(new Date().getFullYear() + '-' + ("0" + (new Date().getMonth() + 1)).slice(-2) + '-' + ("0" + new Date().getDate()).slice(-2) + 'T' + attendantAvailability[weekDayToday].start + ':00').tz(attendantTimezone).format(),
                attendantEndTime = moment(new Date().getFullYear() + '-' + ("0" + (new Date().getMonth() + 1)).slice(-2) + '-' + ("0" + new Date().getDate()).slice(-2) + 'T' + attendantAvailability[weekDayToday].end + ':00').tz(attendantTimezone).format(),
                attendantIntervalStartTime = moment(new Date().getFullYear() + '-' + ("0" + (new Date().getMonth() + 1)).slice(-2) + '-' + ("0" + new Date().getDate()).slice(-2) + 'T' + attendantAvailability[weekDayToday].interval_start + ':00').tz(attendantTimezone).format(),
                attendantInvervalEndTime = moment(new Date().getFullYear() + '-' + ("0" + (new Date().getMonth() + 1)).slice(-2) + '-' + ("0" + new Date().getDate()).slice(-2) + 'T' + attendantAvailability[weekDayToday].interval_end + ':00').tz(attendantTimezone).format(),
                clientTime = moment().tz(attendantTimezone).format(),
                attendantIsAvailableNow = moment(clientTime).isBetween(attendantStartTime, attendantEndTime),
                attendantIsAtInterval = moment(clientTime).isBetween(attendantIntervalStartTime, attendantInvervalEndTime);
            } else {
              $attendant.removeClass('tmw-attendant-is-offline').addClass('tmw-attendant-is-online');
              $attendant.find('.tmw-whatsapp-attendant-status .tmw-whatsapp-attendant-status-online').removeClass('tmw-d-none');
              $attendant.find('.tmw-whatsapp-attendant-info .tmw-whastapp-attendant-info-offline-message').addClass('tmw-d-none');
            }
          }
        }
        if (attendantIsAtInterval) {
          attendantIsAvailableNow = false;
        }
        if (attendantIsAvailableNow) {
          $attendant.removeClass('attendant-is-offline').addClass('tmw-attendant-is-online');
          $attendant.find('.tmw-whatsapp-attendant-status .tmw-whatsapp-attendant-status-online').removeClass('tmw-d-none');
          $attendant.find('.tmw-whatsapp-attendant-info .tmw-whastapp-attendant-info-offline-message').addClass('tmw-d-none');
        } else {
          if (attendantIsAtInterval) {
            $attendant.removeClass('attendant-is-online').addClass('tmw-attendant-is-offline tmw-attendant-is-interval');
            $attendant.find('.tmw-whatsapp-attendant-status .tmw-whatsapp-attendant-status-interval').removeClass('tmw-d-none');
            $attendant.find('.tmw-whatsapp-attendant-info .tmw-whastapp-attendant-info-offline-message:not(.is-interval)').addClass('tmw-d-none');
          } else {
            if (attendantAvailability[weekDayToday].available == 'no') {
              $attendant.removeClass('attendant-is-online').addClass('tmw-attendant-is-offline');
              $attendant.find('.tmw-whatsapp-attendant-status .tmw-whatsapp-attendant-status-offline').removeClass('tmw-d-none');
              $attendant.find('.tmw-whatsapp-attendant-info .tmw-whastapp-attendant-info-offline-message.is-interval').addClass('tmw-d-none');
            } else {
              if (attendantIsAvailableNow) {
                $attendant.removeClass('attendant-is-offline').addClass('tmw-attendant-is-online');
                $attendant.find('.tmw-whatsapp-attendant-status .tmw-whatsapp-attendant-status-online').removeClass('tmw-d-none');
              } else {
                $attendant.removeClass('attendant-is-online').addClass('tmw-attendant-is-offline');
                $attendant.find('.tmw-whatsapp-attendant-status .tmw-whatsapp-attendant-status-offline').removeClass('tmw-d-none');
                $attendant.find('.tmw-whatsapp-attendant-info .tmw-whastapp-attendant-info-offline-message.is-interval').addClass('tmw-d-none');
              }
            }
          }
        }
      });

      // If only one attedant is registered should open the chat window with message directly
      if (_self.$attendant.length === 1 && _self.$attendant.hasClass('tmw-attendant-is-online') && _self.$attendant.hasClass('tmw-attendant-is-interval') == false) {
        setTimeout(function () {
          _self.$attendant.trigger('click');
          _self.$attendantInfoBack.remove();
        }, 300);
      }

      // Removes overflow-y if number of attendant is less or equal 4 (the limit)
      if (_self.$attendant.length <= 4) {
        _self.$wrapper.find('.tmw-whatsapp-card-body').css('overflow-y', 'hidden');
      }

      // Open Attendant Chat Conversation on Fisrt Load of Page
      if (_self.$wrapper.data('open-chat-with')) {
        var delay = _self.$wrapper.data('open-chat-with-delay') == '' ? 0 : _self.$wrapper.data('open-chat-with-delay') * 1000;
        setTimeout(function () {
          _self.$attendant.eq(_self.$wrapper.data('open-chat-with')).trigger('click');
          _self.$triggerButton.trigger('click');
        }, delay);
      }
      return this;
    },
    events: function events() {
      var _self = this,
        presentationInfoInitialHeight = _self.$presentationInfo.height();
      _self.$attendant.off('click').on('click', function (e) {
        e.preventDefault();
        var attendantImage = $(this).find('.tmw-whatsapp-attendant-image > img'),
          attendantTitle = $(this).find('.tmw-whatsapp-attendant-info > h3').text(),
          attendantIsOnline = $(this).hasClass('tmw-attendant-is-online') ? tmwc_data.i18n.attendant_online_text : tmwc_data.i18n.attendant_offline_text;

        // Open Whatsapp Web Chat Window	
        if (_self.$openWhatsappChatType == 'select-attendant') {
          _self.openWhatsappWebChat($(this).data('phone'), _self.$wrapper.data('tmw-whatsapp-web-start-message'));
          return;
        }

        // Header Attendant Info
        _self.$attendantHeaderImage.attr('src', attendantImage.attr('src'));
        _self.$attendantHeaderInfo.find('.tmw-whatsapp-attedant-info-title > h2').text(attendantTitle);
        _self.$attendantHeaderInfo.find('.tmw-whatsapp-attedant-info-title > p').text(attendantIsOnline);

        // Start Message
        if ($(this).data('start-message') != '') {
          $('.tmw-whatsapp-attendant-chat-message').text($(this).data('start-message')).append('<span class="tmw-whatsapp-attendant-chat-message-time">' + _self.getTimeNow() + '</span>');
        }

        // Phone
        _self.$chatSendButton.data('messageToPhone', $(this).data('phone'));

        // Hide Attendants
        var delay = 200;
        _self.$attendant.each(function () {
          var $this = $(this);
          setTimeout(function () {
            $this.addClass('tmw-hide');
          }, delay);
          delay = delay + 100;
        });

        // Set Height For Card Body
        $('.tmw-whatsapp-card-body').animate({
          height: 230
        }, 300, function () {
          $('.tmw-whatsapp-card-body').scrollTop(0);
        });

        // Remove display none (prevent chat window no animation)
        _self.$wrapper.find('.tmw-whatsapp-attendant-chat-window').css('display', 'block');
        setTimeout(function () {
          _self.$wrapper.find('.tmw-whatsapp-attendant-chat-window').css('display', '');
        }, _self.$attendant.length * 150);

        // Show Chat Window
        setTimeout(function () {
          _self.$chatWindow.addClass('tmw-show');
        }, _self.$attendant.length * 150);

        // Show Header Attendant Info
        _self.$presentationInfo.addClass('tmw-hide');
        setTimeout(function () {
          _self.$attendantHeaderInfo.removeClass('tmw-hide');
        }, 150);
        _self.$presentationInfo.animate({
          height: _self.$attendantHeaderInfo.height()
        });
        _self.$wrapper.addClass('tmw-whatsapp-attendant-chat-opened');
      });
      _self.$attendantInfoBack.off('click').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();

        // Hide Chat Window
        _self.$chatWindow.removeClass('tmw-show');

        // Get Height
        var attendants_height = 0;
        $('.tmw-whatsapp-attendant').each(function () {
          attendants_height = attendants_height + $(this).outerHeight();
        });
        $('.tmw-whatsapp-card-body').animate({
          height: attendants_height
        });

        // Show Attendants List
        var delay = 200;
        _self.$attendant.each(function () {
          var $this = $(this);
          setTimeout(function () {
            $this.removeClass('tmw-hide');
          }, delay);
          delay = delay + 100;
        });

        // Show Header Presentation Info
        _self.$attendantHeaderInfo.addClass('tmw-hide');
        setTimeout(function () {
          _self.$presentationInfo.removeClass('tmw-hide');
        }, 150);
        _self.$presentationInfo.animate({
          height: presentationInfoInitialHeight
        });
        _self.$wrapper.removeClass('tmw-whatsapp-attendant-chat-opened');
      });

      /*
       * Open whatsapp when click in the chat send button
       */
      _self.$chatSendButton.off('click').on('click', function (e) {
        e.preventDefault();

        // Open Whatsapp Web Chat Window	
        _self.openWhatsappWebChat($(this).data('messageToPhone'), _self.$chatInputMessage.val());
      });

      /*
       * Trigger Button To Open the Chat Window
       */
      _self.$triggerButton.off('click').on('click', function (e) {
        e.preventDefault();
        var $this = $(this);

        // Open Whatsapp Web Chat Window	
        if (_self.$openWhatsappChatType == 'click-icon') {
          var $firstAttendant = $('.tmw-whatsapp-attendant').eq(0),
            phone = $firstAttendant.data('phone');
          _self.openWhatsappWebChat(phone, _self.$wrapper.data('tmw-whatsapp-web-start-message'));
          return;
        }
        if (!$this.data('opened')) {
          $this.data('opened', true).addClass('tmw-whatsapp-chat-opened');
          setTimeout(function () {
            _self.$wrapper.removeClass('tmw-hide');
            if ($(window).width() < 768) {
              $('html, body').css({
                'overflow-y': 'hidden'
              });
            }
          }, 250);
        } else {
          _self.$wrapper.addClass('tmw-hide');
          $this.data('opened', false).removeClass('tmw-whatsapp-chat-opened');
          setTimeout(function () {
            _self.$triggerButton.removeClass('tmw-hide');
            if ($(window).width() < 768) {
              $('html, body').css({
                'overflow-y': 'auto'
              });
            }
          }, 250);
        }
      });

      /*
       * Close Button To Close the Chat Window
       */
      _self.$closeButton.off('click').on('click', function (e) {
        e.preventDefault();
        _self.$wrapper.addClass('tmw-hide');
        setTimeout(function () {
          _self.$triggerButton.removeClass('tmw-hide');
        }, 250);
      });

      /*
       * Send On Key Press "Enter" 
       */
      $('.tmw-whatsapp-attendant-chat-input-message').off('keyup').on('keyup', function (e) {
        if (e.keyCode === 13) {
          e.preventDefault();
          _self.$chatSendButton.trigger('click');
        }
      });

      /*
       * Initialize plugin in the save settings complete event
       */
      $('.tmw-whatsapp-admin-settings').off('tm.whatsapp.settings.saved').on('tm.whatsapp.settings.saved', function () {
        _self.initialize();
      });
      return this;
    },
    openWhatsappWebChat: function openWhatsappWebChat(phone, message) {
      var _self = this;
      if (phone.toString().indexOf('chat.whatsapp.com') > 0) {
        window.open(phone, '_blank');
      } else {
        window.open('https://wa.me/' + phone + '/?text=' + message, '_blank');
      }
      return this;
    },
    getTimeNow: function getTimeNow() {
      var d = new Date();
      var hr = d.getHours();
      var min = d.getMinutes();
      if (min < 10) {
        min = "0" + min;
      }
      var ampm = "am";
      if (hr > 12) {
        hr -= 12;
        ampm = "pm";
      }
      return hr + ":" + min;
    }
  };

  // How the plugin should be intialized
  // Based on user settings
  var init_method = $('.tmw-whatsapp-wrapper').data('init-method'),
    init_delay = $('.tmw-whatsapp-wrapper').data('init-method-delay') ? $('.tmw-whatsapp-wrapper').data('init-method-delay') : 0;
  switch (init_method) {
    case 'on-first-load':
      MasterWhatsChatApp.initialize();
      break;
    case 'on-first-scroll':
      var plugin_intialized = false;
      $(window).on('scroll', function () {
        MasterWhatsChatApp.initialize();
        plugin_intialized = true;
      });
      break;
    case 'on-first-mouseover':
      var plugin_intialized = false;
      $(document).on('mouseover', function () {
        MasterWhatsChatApp.initialize();
        plugin_intialized = true;
      });
      break;
    case 'after-few-seconds':
      setTimeout(function () {
        MasterWhatsChatApp.initialize();
      }, init_delay * 1000);
      break;
    default:
      MasterWhatsChatApp.initialize();
      break;
  }
})(jQuery);
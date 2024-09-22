"use strict";

(function ($) {
  'use strict';

  var MasterWhatsChatWidgets = window || {};
  MasterWhatsChatWidgets = {
    $tmw_whatsapp_widget_button: $('.tmw-whatsapp-button'),
    initialize: function initialize($elementorElement) {
      if ($elementorElement.length > 0) {
        this.$tmw_whatsapp_widget_button = $elementorElement.find('.tmw-whatsapp-button');
      }
      this.build().events();
      if (window.location.search.indexOf('vc_action=vc_inline') > 0 || window.location.search.indexOf('vc_editable=true')) {
        this.wpBakeryFrontEndEditorEvents();
      }
      return this;
    },
    build: function build() {
      var _self = this;

      // Available Hours (Attendant is Online ?)
      _self.$tmw_whatsapp_widget_button.each(function () {
        var $attendant = $(this),
          attendantAvailability = JSON.parse(atob($(this).data('availability'))),
          weekDayToday = new Date().toLocaleString('en-us', {
            weekday: 'long',
            timezone: $(this).data('default-timezone')
          }).toLowerCase(),
          attendantIsAvailableNow = false,
          alwaysAvailable = false;
        if (attendantAvailability[weekDayToday].available == 'no') {
          $attendant.addClass('tmw-attendant-is-offline').attr('disabled', true);
        } else {
          if (attendantAvailability[weekDayToday].available == 'yes') {
            if (attendantAvailability[weekDayToday].start != '' && attendantAvailability[weekDayToday].end != '') {
              var attendantTimezone = attendantAvailability[weekDayToday].timezone == '' || attendantAvailability[weekDayToday].timezone == $(this).data('default-timezone') ? $(this).data('default-timezone') : attendantAvailability[weekDayToday].timezone,
                attendantStartTime = moment(new Date().getFullYear() + '-' + ("0" + (new Date().getMonth() + 1)).slice(-2) + '-' + ("0" + new Date().getDate()).slice(-2) + 'T' + attendantAvailability[weekDayToday].start + ':00').tz(attendantTimezone).format(),
                attendantEndTime = moment(new Date().getFullYear() + '-' + ("0" + (new Date().getMonth() + 1)).slice(-2) + '-' + ("0" + new Date().getDate()).slice(-2) + 'T' + attendantAvailability[weekDayToday].end + ':00').tz(attendantTimezone).format(),
                attendantIntervalStartTime = moment(new Date().getFullYear() + '-' + ("0" + (new Date().getMonth() + 1)).slice(-2) + '-' + ("0" + new Date().getDate()).slice(-2) + 'T' + attendantAvailability[weekDayToday].interval_start + ':00').tz(attendantTimezone).format(),
                attendantInvervalEndTime = moment(new Date().getFullYear() + '-' + ("0" + (new Date().getMonth() + 1)).slice(-2) + '-' + ("0" + new Date().getDate()).slice(-2) + 'T' + attendantAvailability[weekDayToday].interval_end + ':00').tz(attendantTimezone).format(),
                clientTime = moment().tz(attendantTimezone).format(),
                attendantIsAtInterval = moment(clientTime).isBetween(attendantIntervalStartTime, attendantInvervalEndTime);
            } else {
              alwaysAvailable = true;
            }
          }
        }
        if (attendantIsAtInterval) {
          attendantIsAvailableNow = false;
        } else {
          if (alwaysAvailable) {
            attendantIsAvailableNow = true;
          } else {
            attendantIsAvailableNow = moment(clientTime).isBetween(attendantStartTime, attendantEndTime);
          }
          // $attendant.find('..').addClass('tmw-d-none');
        }
        if (attendantIsAvailableNow) {
          $attendant.removeClass('attendant-is-offline').addClass('tmw-attendant-is-online').attr('disabled', false);
          $attendant.find('.tmw-whatsapp-elementor-title-status').addClass('tmw-whatsapp-elementor-title-status-online').text(tmwc_data.i18n.attendant_online_text);
          $attendant.find('.tmw-whatsapp-elementor-info-offline-message').addClass('tmw-d-none');
        } else {
          if (attendantIsAtInterval) {
            $attendant.removeClass('attendant-is-online').addClass('tmw-attendant-is-offline').attr('disabled', true);
            $attendant.find('.tmw-whatsapp-elementor-title-status').addClass('tmw-whatsapp-elementor-title-status-offline').text(tmwc_data.i18n.attendant_offline_text);
            $attendant.find('.tmw-whatsapp-elementor-info-offline-message:not(.is-interval)').addClass('tmw-d-none');
          } else {
            if (attendantAvailability[weekDayToday].available == 'no') {
              $attendant.removeClass('attendant-is-online').addClass('tmw-attendant-is-offline').attr('disabled', true);
              $attendant.find('.tmw-whatsapp-elementor-title-status').addClass('tmw-whatsapp-elementor-title-status-offline').text(tmwc_data.i18n.attendant_offline_text);
              $attendant.find('.tmw-whatsapp-elementor-info-offline-message.is-interval').addClass('tmw-d-none');
            } else {
              if (attendantIsAvailableNow) {
                $attendant.removeClass('attendant-is-offline').addClass('tmw-attendant-is-online').attr('disabled', false);
                $attendant.find('.tmw-whatsapp-elementor-title-status').addClass('tmw-whatsapp-elementor-title-status-online').text(tmwc_data.i18n.attendant_online_text);
                // $attendant.find('.tmw-whatsapp-elementor-info-offline-message').addClass('tmw-d-none');
              } else {
                $attendant.removeClass('attendant-is-online').addClass('tmw-attendant-is-offline').attr('disabled', true);
                $attendant.find('.tmw-whatsapp-elementor-title-status').addClass('tmw-whatsapp-elementor-title-status-offline').text(tmwc_data.i18n.attendant_offline_text);
                $attendant.find('.tmw-whatsapp-elementor-info-offline-message.is-interval').addClass('tmw-d-none');
              }
            }
          }
        }
      });
      return this;
    },
    events: function events() {
      var _self = this;
      $(document).on('click', '.tmw-whatsapp-button', function (e) {
        e.preventDefault();

        // If it's inside Elementor editing page
        if (window.location.search.indexOf('elementor-preview') >= 0 || $(this).hasClass('tmw-attendant-is-offline')) {
          return;
        }
        var phone_number = $(this).data('phone-number'),
          start_message = $(this).data('start-message');
        _self.openWhatsappWebChat(phone_number, start_message);
      });
      _self.$tmw_whatsapp_widget_button.on('animationend', function () {
        $(this).trigger('tmw.whatsapp.button.loaded');
      });
      return this;
    },
    wpBakeryFrontEndEditorEvents: function wpBakeryFrontEndEditorEvents() {
      var _self = this;
      $(document).ready(function () {
        $('#vc_inline-frame').on('load', function () {
          _self.$tmw_whatsapp_widget_button.on('tmw.whatsapp.button.loaded', function () {
            vc.events.on('shortcodes:tmw_whatsapp_button:add shortcodes:tmw_whatsapp_button:clone', function (e) {
              setTimeout(function () {
                MasterWhatsChatWidgets.initialize(vc.$frame[0].contentWindow.jQuery('.vc_element[data-model-id="' + e.id + '"]').find('.tmw-whatsapp-wpbakery-widget'));
              }, 1000);
            });
          });
        });
      });
      return this;
    },
    openWhatsappWebChat: function openWhatsappWebChat(phone, message) {
      var _self = this;
      if (phone.toString().indexOf('chat.whatsapp.com') > 0) {
        window.open(phone, '_blank');
      } else {
        if (message) {
          window.open('https://wa.me/' + phone + '/?text=' + message, '_blank');
        } else {
          window.open('https://wa.me/' + phone, '_blank');
        }
      }
      return this;
    }
  };
  $(window).on('elementor/frontend/init', function () {
    var addHandler = function addHandler($element) {
      MasterWhatsChatWidgets.initialize($element);
    };
    elementorFrontend.hooks.addAction('frontend/element_ready/tmwhatsappwidget.default', addHandler);
  });
  if ($('#vc_inline-frame').get(0)) {
    $('#vc_inline-frame').on('load', function () {
      setTimeout(function () {
        if (vc.$frame[0].contentWindow.jQuery('.tmw-whatsapp-wpbakery-widget')) {
          vc.$frame[0].contentWindow.jQuery('.tmw-whatsapp-wpbakery-widget').each(function () {
            MasterWhatsChatWidgets.initialize(vc.$frame[0].contentWindow.jQuery('.tmw-whatsapp-wpbakery-widget'));
            jQuery(this).find('p').each(function () {
              if (jQuery(this).text() == '') {
                jQuery(this).remove();
              }
            });
          });
          vc.events.on('shortcodes:tmw_whatsapp_button:add shortcodeView:updated shortcodes:tmw_whatsapp_button:clone', function (e) {
            setTimeout(function () {
              if (e.attributes.shortcode == 'tmw_whatsapp_button') {
                MasterWhatsChatWidgets.initialize(vc.$frame[0].contentWindow.jQuery('.vc_element[data-model-id="' + e.id + '"]').find('.tmw-whatsapp-wpbakery-widget'));
              }
            }, 3000);
          });
          vc.events.on('shortcodes:add shortcodeView:updated shortcodes:clone', function (e) {
            setTimeout(function () {
              if (e.attributes.params.content.indexOf('tmw_whatsapp_button_wp') > 0) {
                MasterWhatsChatWidgets.initialize(vc.$frame[0].contentWindow.jQuery('.vc_element[data-model-id="' + e.id + '"]').find('.tmw-whatsapp-wpbakery-widget'));
              }
            }, 3000);
          });
        }
      }, 0);
    });
  }
  MasterWhatsChatWidgets.initialize(false);
})(jQuery);
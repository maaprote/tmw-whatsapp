"use strict";

function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
(function ($) {
  'use strict';

  /*
  * Tabs
  */
  $("#tmwWhatsappTab").tabs();

  /*
  * Show Settings
  */
  $('.tmw-whatsapp-admin-settings').addClass('tmw-whatsapp-admin-settings-show');

  /*
  * Conditional Fields
  */
  $('.tmw-conditional-field').each(function () {
    var $this = $(this),
      target = $this.data('cond-target'),
      cond = $this.data('cond-cond'),
      value = $this.data('cond-value') ? ![0, 1].includes($this.data('cond-value')) ? $this.data('cond-value').split(',') : $this.data('cond-value') : '';
    if (value === 1) {
      value = true;
    } else if (value === 0) {
      value = false;
    }
    switch (cond) {
      case 'equal':
        if (typeof value === 'boolean') {
          // First Load
          if ($('input[name="' + target + '"]').is(':checked') == value) {
            $this.removeClass('tmw-conditional-field-hide');
          } else {
            $this.addClass('tmw-conditional-field-hide');
          }

          // Switch On Off
          $('input[name="' + target + '"]').on('change', function () {
            if ($('input[name="' + target + '"]').is(':checked') == value) {
              $this.removeClass('tmw-conditional-field-hide');
            } else {
              $this.find('input').val('');
              $this.addClass('tmw-conditional-field-hide');
            }
          });
        } else {
          // First Load
          if ($this.find('input').val() != '') {
            $this.removeClass('tmw-conditional-field-hide');
          } else if ($('select[name="' + target + '"]').val() != 'after-few-seconds') {
            $('select[name="' + target + '"]').closest('.tmw-conditional-field').removeClass('tmw-conditional-field-hide');
          }

          // Select
          $('select[name="' + target + '"]').on('change', function () {
            if ($('select[name="' + target + '"]').val() == value[0]) {
              $this.removeClass('tmw-conditional-field-hide');
            } else {
              $this.find('input').val('');
              $this.addClass('tmw-conditional-field-hide');
            }
          });
        }
        break;
      case 'include':
        // First Load
        if (value.includes($('input[name="' + target + '"]:checked')[0].value)) {
          $this.removeClass('tmw-conditional-field-hide');
        }

        // Checkbox / Radio
        $('input[name="' + target + '"]').on('change', function () {
          if (value.includes($(this)[0].value)) {
            $this.removeClass('tmw-conditional-field-hide');
          } else {
            $this.find('input').val('');
            $this.addClass('tmw-conditional-field-hide');
          }
        });
        break;
      case 'empty':
        // First Load
        if ($this.find('input').val() != '') {
          $this.removeClass('tmw-conditional-field-hide');
        } else if ($('input[name="' + target + '"]').val() == '') {
          $('input[name="' + target + '"]').closest('.tmw-conditional-field').removeClass('tmw-conditional-field-hide');
        }
        $this.find('input').on('keyup', function () {
          if ($(this).val() == '') {
            $('input[name="' + target + '"]').closest('.tmw-conditional-field').removeClass('tmw-conditional-field-hide');
          } else {
            $('input[name="' + target + '"]').closest('.tmw-conditional-field').addClass('tmw-conditional-field-hide');
          }
        });
        break;
    }
  });

  /*
  * RTL Layout
  */
  $('input[name="rtl_layout"]').on('change', function () {
    if ($(this).is(':checked')) {
      $('.tmw-whatsapp-admin-settings').addClass('tmw-direction-rtl');
      $('.tmw-whatsapp-wrapper').addClass('tmw-direction-rtl');
      $('.tmw-whatsapp-trigger-button').addClass('tmw-direction-rtl');
    } else {
      $('.tmw-whatsapp-admin-settings').removeClass('tmw-direction-rtl');
      $('.tmw-whatsapp-wrapper').removeClass('tmw-direction-rtl');
      $('.tmw-whatsapp-trigger-button').removeClass('tmw-direction-rtl');
    }
  });

  /*
  * Setup Availability Enable All Days Button
  */
  $(document).on('click', '.tmw-setup-availability-trigger-all-days', function (e) {
    e.preventDefault();
    var $attendant = $(this).closest('.attendant'),
      $attendantTriggerAllDays = $attendant.find('.tmw-setup-availability-trigger-all-days');
    if ($attendantTriggerAllDays.data('toggle') == true || typeof $attendantTriggerAllDays.data('toggle') == 'undefined') {
      $attendant.find('.tmw-setup-availability-button').each(function () {
        $(this).prop('checked', true).data('available', 'yes');
      });
      $attendant.find('.tmw-setup-availability-button').addClass('active');
      $attendantTriggerAllDays.data('toggle', false);
      $attendantTriggerAllDays.text($(this).data('toggle-text-disable'));
    } else {
      $attendant.find('.tmw-setup-availability-button').each(function () {
        $(this).prop('checked', false).data('available', 'no');
      });
      $attendant.find('.tmw-setup-availability-button').removeClass('active');
      $attendantTriggerAllDays.data('toggle', true);
      $attendantTriggerAllDays.text($(this).data('toggle-text-enable'));
    }
  });

  // Manage Toggle Availability Button State
  $(document).ready(function () {
    setTimeout(function () {
      var flag = false;
      $('.tmw-setup-availability-button').each(function (i) {
        var $attendant = $(this).closest('.attendant'),
          $attendantTriggerAllDays = $attendant.find('.tmw-setup-availability-trigger-all-days');
        if ($(this).hasClass('active') == false) {
          $attendantTriggerAllDays.data('toggle', true);
          $attendantTriggerAllDays.text($attendantTriggerAllDays.data('toggle-text-enable'));
          flag = true;
        } else {
          if (flag == false) {
            $attendantTriggerAllDays.data('toggle', false);
            $attendantTriggerAllDays.text($attendantTriggerAllDays.data('toggle-text-disable'));
          }
        }
        if ($(this).data('day') == 'sunday') {
          flag = false;
        }
      });
    }, 500);
  });

  /*
  * Popup / Setup Availability
  */
  var daySelected = '',
    daySelectedEl = '';

  // When Open The Popup
  $(document).on('click', '.tmw-setup-availability-button', function (e) {
    e.preventDefault();
    var $this = $(this),
      $popup = $('.tmw-setup-availability-popup-wrapper');
    daySelected = $this.data('day');
    daySelectedEl = $this;

    // -- Reset All Fields
    var $status = $('.tmw-setup-availability-weekday-status');

    // Availability
    if (daySelectedEl.data('available') == 'yes') {
      $('.availability-day-switch').prop('checked', true);
      setTimeout(function () {
        if ($('.tmw-timepicker[name="start"]').val() !== '' || $('.tmw-timepicker[name="end"]').val() !== '') {
          $status.text(tmwc_data.i18n.admin.weekday_popup_status.hours);
        } else {
          $status.text(tmwc_data.i18n.admin.weekday_popup_status.online);
        }
      }, 500);
    } else {
      $('.availability-day-switch').prop('checked', false);
      $status.text(tmwc_data.i18n.admin.weekday_popup_status.offline);
    }

    // Start, End, Interval Start and Interval End
    var dataopts = ['start', 'end', 'interval-start', 'interval-end'];
    for (var i = 0; i < dataopts.length; i++) {
      if (daySelectedEl.data(dataopts[i])) {
        $('.tmw-timepicker[name="' + dataopts[i] + '"]')[0]._flatpickr.setDate(daySelectedEl.data(dataopts[i]));
      } else {
        $('.tmw-timepicker[name="' + dataopts[i] + '"]')[0]._flatpickr.setDate('');
      }
    }
    if ($('.tmw-timepicker[name="end"]')[0]._flatpickr.selectedDates.length == 0 && $('.tmw-timepicker[name="start"]')[0]._flatpickr.selectedDates.length > 0) {
      $('.tmw-timepicker[name="end"]')[0]._flatpickr.setDate('12:00PM');
    }
    if ($('.tmw-timepicker[name="start"]')[0]._flatpickr.selectedDates.length == 0 && $('.tmw-timepicker[name="end"]')[0]._flatpickr.selectedDates.length > 0) {
      $('.tmw-timepicker[name="start"]')[0]._flatpickr.setDate('00:00AM');
    }

    // Timezone
    if (daySelectedEl.data('timezone')) {
      $('.tmw-form-control[name="timezone"]').val(daySelectedEl.data('timezone')).trigger('change');
    }
    $popup.removeClass('tmw-hide');
  });

  // Close Popup and Bind Availability Options
  $(document).on('click', function (e) {
    if ($(e.target).hasClass('tmw-setup-availability-popup-wrapper')) {
      // Available Day Switch
      if ($('.availability-day-switch').is(':checked')) {
        daySelectedEl.data('available', 'yes').addClass('active');
      } else {
        daySelectedEl.data('available', 'no').removeClass('active');
      }

      // Clear Timepickers
      $('.tmw-timepicker').val('');

      // Timezone
      daySelectedEl.data('timezone', $('.tmw-form-control[name="timezone"]').val());

      // Close The Popup
      $('.tmw-setup-availability-popup-wrapper').addClass('tmw-hide');
    }
  });

  /*
   * Timepicker
   */
  if ($('.tmw-timepicker').length) {
    $('.tmw-timepicker').each(function () {
      $(this).flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: false,
        onChange: function onChange(selectedDates, dateStr, instance) {
          switch (instance.element.name) {
            case 'start':
              daySelectedEl.data('start', dateStr);
              break;
            case 'end':
              daySelectedEl.data('end', dateStr);
              break;
            case 'interval-start':
              daySelectedEl.data('interval-start', dateStr);
              break;
            case 'interval-end':
              daySelectedEl.data('interval-end', dateStr);
              break;
          }
        }
      });

      // Handling with timepicker change one time
      // The main reason is change the status message
      $('.tmw-timepicker').on('change', function () {
        if ($(this).val() != '') {
          var $status = $('.tmw-setup-availability-weekday-status');
          if ($('.availability-day-switch').is(':checked')) {
            $status.text(tmwc_data.i18n.admin.weekday_popup_status.online);
            if ($('.tmw-timepicker[name="start"]').val() != '' || $('.tmw-timepicker[name="end"]').val() != '') {
              $status.text(tmwc_data.i18n.admin.weekday_popup_status.hours);
            }
          } else {
            $status.text(tmwc_data.i18n.admin.weekday_popup_status.offline);
          }
        }
        if ($(this).attr('name') == 'start') {
          if ($('.tmw-timepicker[name="end"]').val() == '') {
            $('.tmw-timepicker[name="end"]')[0]._flatpickr.setDate('12:00PM');
          }
        }
        if ($(this).attr('name') == 'end') {
          if ($('.tmw-timepicker[name="start"]').val() == '') {
            $('.tmw-timepicker[name="start"]')[0]._flatpickr.setDate('00:00AM');
          }
        }
      });

      // Clear Timepicker Value
      $('.tmw-timepicker-clear').on('click', function (e) {
        e.preventDefault();

        // Clear the input value
        $(this).parent().next()[0]._flatpickr.setDate('');

        // Clear Data binded to days
        switch ($(this).parent().next().attr('name')) {
          case 'start':
            $('.tmw-setup-availability-day[data-day="' + daySelected + '"]').data('start', '');
            break;
          case 'end':
            $('.tmw-setup-availability-day[data-day="' + daySelected + '"]').data('end', '');
            break;
          case 'interval-start':
            $('.tmw-setup-availability-day[data-day="' + daySelected + '"]').data('intervalStart', '');
            break;
          case 'interval-end':
            $('.tmw-setup-availability-day[data-day="' + daySelected + '"]').data('intervalEnd', '');
            break;
        }

        // Change Status Description
        var $status = $('.tmw-setup-availability-weekday-status');
        if ($('.availability-day-switch').is(':checked')) {
          $status.text(tmwc_data.i18n.admin.weekday_popup_status.online);
          if ($('.tmw-timepicker[name="start"]').val() != '' || $('.tmw-timepicker[name="end"]').val() != '') {
            $status.text(tmwc_data.i18n.admin.weekday_popup_status.hours);
          }
        } else {
          $status.text(tmwc_data.i18n.admin.weekday_popup_status.offline);
        }
      });
    });
  }

  /*
  * Popup Setup Availability - Handling Online/Offline Status
  */
  $('.availability-day-switch').on('change', function () {
    var $status = $('.tmw-setup-availability-weekday-status');
    if ($(this).is(':checked')) {
      $status.text(tmwc_data.i18n.admin.weekday_popup_status.online);
      if ($('.tmw-timepicker[name="start"]').val() != '' || $('.tmw-timepicker[name="end"]').val() != '') {
        $status.text(tmwc_data.i18n.admin.weekday_popup_status.hours);
      }
    } else {
      $status.text(tmwc_data.i18n.admin.weekday_popup_status.offline);
    }
  });

  /*
  * Save Options
  */
  $(document).on('click', '.tmw-settings-save', function (e) {
    e.preventDefault();
    var $this = $(this),
      $form = $('#rm_settings'),
      formData = $form.serializeArray(),
      data = {};
    $this.text('Saving...');
    $(formData).each(function (index, obj) {
      if (obj.name.indexOf('attendant-image') < 0 && !['chat_image_background_type', 'chat_image_background_width', 'chat_image_background_height', 'chat_image_background_title', 'chat_image_background_icon'].includes(obj.name)) {
        if (data[obj.name]) {
          var arr = [];
          $('.attendant').each(function (index) {
            // Setup Image
            var imageObj = {};
            $(this).find('.tmw-media-uploader input').each(function () {
              var name = $(this).attr('name'),
                value = $(this).val();
              imageObj[name] = value;
            });

            // Setup Availability Data For Each Attendant
            var days = {};
            $(this).find('.tmw-setup-availability-day').each(function () {
              days[$(this).data('day')] = {
                available: $(this).data('available') ? $(this).data('available') : 'no',
                start: $(this).data('start') ? $(this).data('start') : null,
                end: $(this).data('end') ? $(this).data('end') : null,
                interval_start: $(this).data('interval-start') ? $(this).data('interval-start') : null,
                interval_end: $(this).data('interval-end') ? $(this).data('interval-end') : null,
                timezone: $(this).data('timezone') ? $(this).data('timezone') : null
              };
            });

            // Push data to array
            arr.push(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty(_defineProperty({
              id: index,
              name: $(this).find('.attendant-name').val(),
              phone: $(this).find('.attendant-phone').val(),
              description: $(this).find('.attendant-description').val(),
              start_message: $(this).find('.attendant-start_message').val()
            }, "phone", $(this).find('.attendant-phone').val()), "offline_message", $(this).find('.attendant-offline_message').val()), "interval_message", $(this).find('.attendant-interval_message').val()), "image", imageObj), "default_timezone", $(this).find('.attendant-default-timezone').val()), "availability", days));
          });

          // Push Array With Attendant Data
          data[obj.name] = arr;
        } else {
          data[obj.name] = obj.value;
        }
      }
    });

    // Skin
    var skinCSS = '';
    $('.tmw-colorpicker').each(function () {
      var $this = $(this),
        selector = $this.data('tmw-colorpicker-target'),
        cssProp = $this.data('tmw-colorpicker-css-prop'),
        pseudoSelector = $this.data('tmw-colorpicker-is-pseudo'),
        pseudoProp = $this.data('tmw-colorpicker-is-pseudo-prop');
      if (cssProp == 'backgroundColor') {
        cssProp = 'background-color';
      }
      skinCSS += selector + '{' + cssProp + ': ' + $this.val() + '}';
      if (typeof pseudoSelector !== 'undefined') {
        skinCSS += pseudoSelector + '{' + pseudoProp + ': ' + $this.val() + '}';
      }
    });
    data['css_skin'] = skinCSS;
    $.ajax({
      url: '../wp-admin/admin-ajax.php',
      type: 'post',
      data: {
        action: 'tmwc_save_settings',
        data: JSON.stringify(data),
        tmwc_nonce: $form.data('nonce')
      }
    }).done(function (data) {
      $('.tmw-settings-save-success').removeClass('d-none');
      setTimeout(function () {
        $('.tmw-settings-save-success').animate({
          opacity: 0
        }, 500, function () {
          $('.tmw-settings-save-success').css({
            opacity: 1
          }).addClass('d-none');
        });
      }, 2000);

      // If reset settings, we should reload the page
      if (data.reset_settings == true) {
        location.reload();
      }
      $('.tmw-whatsapp-admin-wrapper').html(data.app_html);

      // Append style tag with CSS skin on head on successful save
      if ($('#tmw-settings-skin-preview').length) {
        $('#tmw-settings-skin-preview').text(skinCSS);
      } else {
        var styleTagSkin = $('<style id="tmw-settings-skin-preview">' + skinCSS + '</style>');
        $('head').append(styleTagSkin);
      }
      $('.tmw-whatsapp-admin-settings').trigger('tm.whatsapp.settings.saved');

      // Hide Settings Changed Warning
      $('.tmw-settings-changed-warning').addClass('tmw-hide');
      $this.text('Save Settings');
    });
  });

  /*
   * Settings Changed Warning
   */
  $(document).on('change', '.tmw-form-control, .tmw-form-control-radio, .tmw-form-control-checkbox', function () {
    $('.tmw-settings-changed-warning').removeClass('tmw-hide');
  });

  /*
   * Attendant Add New
   */
  $(document).on('click', '.attendant-add-new', function (e) {
    e.preventDefault();

    // Attendant ID
    var attendant_id = 0;
    if ($('.attendant').length) {
      attendant_id = $('.attendant').length;
    }
    var html = '';
    html += '<div class="attendant col-md-12">';
    html += '<span class="attendant-id">' + tmwc_data.i18n.admin.add_new_attendant.attendant_id_label + ' <span class="id">' + attendant_id + '</span></span>';
    html += '<div class="row mt-4">';
    html += '<div class="tmw-form-group tmw-form-group-mobile-md col-lg-6">';
    html += '<label class="tmw-form-control-label">';
    html += '<strong>' + tmwc_data.i18n.admin.add_new_attendant.attendant_name + '</strong>';
    html += '<p class="tmw-form-control-description">' + tmwc_data.i18n.admin.add_new_attendant.attendant_name_desc + '</p>';
    html += '</label>';
    html += '<input class="tmw-form-control attendant-name" name="attendants" class="form-control" value="" type="text" />';
    html += '</div>';
    html += '<div class="tmw-form-group tmw-form-group-mobile-md col-lg-6">';
    html += '<label class="tmw-form-control-label">';
    html += '<strong>' + tmwc_data.i18n.admin.add_new_attendant.attendant_description + '</strong>';
    html += '<p class="tmw-form-control-description">' + tmwc_data.i18n.admin.add_new_attendant.attendant_description_desc + '</p>';
    html += '</label>';
    html += '<input class="tmw-form-control attendant-description" name="attendants" class="form-control" value="" type="text" />';
    html += '</div>';
    html += '</div>';
    html += '<div class="row mt-3">';
    html += '<div class="tmw-form-group tmw-form-group-mobile-md col-lg-6">';
    html += '<label class="tmw-form-control-label">';
    html += '<strong>' + tmwc_data.i18n.admin.add_new_attendant.attendant_start_message + '</strong>';
    html += '<p class="tmw-form-control-description">' + tmwc_data.i18n.admin.add_new_attendant.attendant_start_message_desc + '</p>';
    html += '</label>';
    html += '<input class="tmw-form-control attendant-start_message" name="attendants" class="form-control" value="" type="text" />';
    html += '</div>';
    html += '<div class="tmw-form-group tmw-form-group-mobile-md col-lg-6">';
    html += '<label class="tmw-form-control-label">';
    html += '<strong>' + tmwc_data.i18n.admin.add_new_attendant.attendant_phone + '</strong>';
    html += '<p class="tmw-form-control-description">' + tmwc_data.i18n.admin.add_new_attendant.attendant_phone_desc + '</p>';
    html += '</label>';
    html += '<input class="tmw-form-control attendant-phone" name="attendants" class="form-control" value="" type="text" />';
    html += '</div>';
    html += '</div>';
    html += '<div class="row mt-3">';
    html += '<div class="tmw-form-group tmw-form-group-mobile-md col-lg-6">';
    html += '<div class="row">';
    html += '<div class="tmw-form-group tmw-form-group-mobile-md col-12 d-flex">';
    html += '<label class="tmw-form-control-label">';
    html += '<strong>' + tmwc_data.i18n.admin.add_new_attendant.attendant_offline_message + '</strong>';
    html += '<p class="tmw-form-control-description">' + tmwc_data.i18n.admin.add_new_attendant.attendant_offline_message_desc + '</p>';
    html += '</label>';
    html += '<input class="tmw-form-control attendant-offline_message name="attendants" class="form-control" value="" type="text" />';
    html += '</div>';
    html += '<div class="tmw-form-group tmw-form-group-mobile-md col-12 d-flex mt-3">';
    html += '<label class="tmw-form-control-label">';
    html += '<strong>' + tmwc_data.i18n.admin.add_new_attendant.attendant_interval_message + '</strong>';
    html += '<p class="tmw-form-control-description">' + tmwc_data.i18n.admin.add_new_attendant.attendant_interval_message_desc + '</p>';
    html += '</label>';
    html += '<input class="tmw-form-control attendant-interval_message" name="attendants" class="form-control" value="" type="text" />';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '<div class="tmw-form-group tmw-form-group-mobile-md col-lg-6">';
    html += '<div class="row">';
    html += '<div class="tmw-form-group tmw-form-group-mobile-md col-12 d-flex">';
    html += '<label class="tmw-form-control-label">';
    html += '<strong>' + tmwc_data.i18n.admin.add_new_attendant.attendant_timezone + '</strong>';
    html += '<p class="tmw-form-control-description">' + tmwc_data.i18n.admin.add_new_attendant.attendant_timezone_desc + '</p>';
    html += '</label>';
    html += '<select name="attendants" class="attendant-default-timezone tmw-form-control tmw-form-control-select">';
    var timezone_list = moment.tz.names(),
      user_timezone = moment.tz.guess();
    for (var i = 0; i < timezone_list.length; i++) {
      html += '<option value="' + timezone_list[i] + '"' + (user_timezone == timezone_list[i] ? ' selected' : '') + '>' + timezone_list[i] + '</option>';
    }
    html += '</select>';
    html += '</div>';
    html += '<div class="tmw-form-group tmw-form-group-mobile-md col-12 d-flex mt-3">';
    html += '<label class="tmw-form-control-label">';
    html += '<strong>' + tmwc_data.i18n.admin.add_new_attendant.attendant_image + '</strong>';
    html += '<p class="tmw-form-control-description">' + tmwc_data.i18n.admin.add_new_attendant.attendant_image_desc + '</p>';
    html += '</label>';
    html += '<div class="tmw-media-uploader">';
    html += '<img class="tmw-metabox-image-field-preview tmw-media-uploader-upload-btn" src="' + tmwc_data.tmwc_uri + 'img/img-placeholder.png" alt="' + tmwc_data.i18n.admin.add_new_attendant.attendant_image_alt + '" width="100" height="" data-post-id="">';
    html += '<span class="tmw-media-uploader-remove-btn dashicons dashicons-dismiss"></span>';
    html += '<input class="tmw-media-uploader-media-image" type="hidden" name="attendant-image" value="">';
    html += '<input class="tmw-media-uploader-media-type" type="hidden" name="attendant-image_type" value="">';
    html += '<input class="tmw-media-uploader-media-width" type="hidden" name="attendant-image_width" value="">';
    html += '<input class="tmw-media-uploader-media-height" type="hidden" name="attendant-image_height" value="">';
    html += '<input class="tmw-media-uploader-media-title" type="hidden" name="attendant-image_title" value="">';
    html += '<input class="tmw-media-uploader-media-icon" type="hidden" name="attendant-image_icon" value="">';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '<div class="row">';
    html += '<div calss="col">';
    html += '<p><strong>' + tmwc_data.i18n.admin.add_new_attendant.attendant_setup_availability + '</strong></p>';
    html += '<div class="tmw-setup-availability-days-wrapper">';
    var daysArr = [tmwc_data.i18n.admin.add_new_attendant.attendant_setup_availability_days.monday, tmwc_data.i18n.admin.add_new_attendant.attendant_setup_availability_days.tuesday, tmwc_data.i18n.admin.add_new_attendant.attendant_setup_availability_days.wednesday, tmwc_data.i18n.admin.add_new_attendant.attendant_setup_availability_days.thursday, tmwc_data.i18n.admin.add_new_attendant.attendant_setup_availability_days.friday, tmwc_data.i18n.admin.add_new_attendant.attendant_setup_availability_days.saturday, tmwc_data.i18n.admin.add_new_attendant.attendant_setup_availability_days.sunday];
    for (var i = 0; i < daysArr.length; i++) {
      html += '<a href="#" class="tmw-setup-availability-day tmw-setup-availability-button" data-day="' + daysArr[i] + '" data-available="no" data-start="" data-end="" data-interval-start="" data-interval-end="" data-timezone="">';
      html += daysArr[i].toUpperCase();
      html += '</a>';
    }
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '<div class="row">';
    html += '<div class="col">';
    html += '<a href="#" class="tmw-setup-availability-trigger-all-days">' + tmwc_data.i18n.admin.add_new_attendant.attendant_enable_all_days + '</a>';
    html += '</div>';
    html += '</div>';
    html += '<div class="row justify-content-end mt-3">';
    html += '<div class="col-auto">';
    html += '<a href="#" class="attendant-remove">' + tmwc_data.i18n.admin.add_new_attendant.attendant_remove_attendant + '</a>';
    html += '</div>';
    html += '</div>';
    html += '</div>';

    // If has none attendant registered yet, change the availability popup timezone to the client
    if ($('.attendants-wrapper .attendant').length <= 0) {
      $('.tmw-setup-availability-popup-content select[name="timezone"]').val(moment.tz.guess()).trigger('change');
    }

    // Append the new attendant to DOM
    $('.attendants-wrapper').append(html);
  });

  /*
   * Attendant Remove
   */
  $(document).on('click', '.attendant-remove', function (e) {
    e.preventDefault();
    $(this).closest('.attendant').remove();

    // Re-Organize the ID's between agents
    $('.attendants-wrapper .attendant').each(function (index) {
      var attendant_id = $(this).find('.attendant-id > .id');
      attendant_id.text(index);
    });
  });
  $(document).ready(function () {
    /*
     * WordPress Media Gallery for Image Fields
     */
    $(document).on('click', '.tmw-media-uploader-upload-btn', function (event) {
      var $this = $(this),
        post_id = $this.data('post-id'),
        file_frame;
      event.preventDefault();

      // If the media frame already exists, reopen it.
      if (file_frame) {
        // Set the post ID to what we want
        file_frame.uploader.uploader.param('post_id', post_id);
        // Open frame
        file_frame.open();
        return;
      } else {
        // Set the wp.media post id so the uploader grabs the ID we want when initialised
        wp.media.model.settings.post.id = post_id;
      }

      // Create the media frame.
      file_frame = wp.media.frames.file_frame = wp.media({
        title: tmwc_data.i18n.admin.media_upload.title,
        button: {
          text: tmwc_data.i18n.admin.media_upload.button_text
        },
        multiple: false // Set to true to allow multiple files to be selected
      });

      // When an image is selected, run a callback.
      file_frame.on('select', function () {
        var attachment = file_frame.state().get('selection').first().toJSON();

        // Change the preview image
        $this.closest('.tmw-media-uploader').find('.tmw-media-uploader-upload-btn').attr('src', attachment.type == 'image' ? attachment.url : attachment.icon);

        // Set media type
        $this.closest('.tmw-media-uploader').find('.tmw-media-uploader-media-type').val(attachment.type);

        // Set image
        $this.closest('.tmw-media-uploader').find('.tmw-media-uploader-media-image').val(attachment.id);

        // Set width
        $this.closest('.tmw-media-uploader').find('.tmw-media-uploader-media-width').val(attachment.width);

        // Set height
        $this.closest('.tmw-media-uploader').find('.tmw-media-uploader-media-height').val(attachment.height);

        // Set title
        $this.closest('.tmw-media-uploader').find('.tmw-media-uploader-media-title').val(attachment.title);

        // Set icon
        $this.closest('.tmw-media-uploader').find('.tmw-media-uploader-media-icon').val(attachment.icon);

        // Activate the remove state
        $this.closest('.tmw-media-uploader').addClass('remove-state');

        // Restore the main post ID
        wp.media.model.settings.post.id = post_id;

        // If media upload it's inside a widget
        if ($this.closest('.widget').get(0)) {
          $this.closest('.widget').find('.widget-control-save').attr('disabled', false);
        }
      });

      // Finally, open the modal
      file_frame.open();
    });

    /*
     * Media Uploader Remove Button
     */
    $(document).on('click', '.tmw-media-uploader-remove-btn', function (event) {
      var $this = $(this),
        image = $this.closest('.tmw-media-uploader').find('.tmw-media-uploader-upload-btn'),
        image_field = $this.closest('.tmw-media-uploader').find('.tmw-media-uploader-media-image'),
        image_url = $this.closest('.tmw-media-uploader').find('.tmw-media-uploader-media-url'),
        image_width = $this.closest('.tmw-media-uploader').find('.tmw-media-uploader-media-width'),
        image_height = $this.closest('.tmw-media-uploader').find('.tmw-media-uploader-media-height'),
        image_title = $this.closest('.tmw-media-uploader').find('.tmw-media-uploader-media-title'),
        image_type = $this.closest('.tmw-media-uploader').find('.tmw-media-uploader-media-type'),
        image_icon = $this.closest('.tmw-media-uploader').find('.tmw-media-uploader-media-icon');
      event.preventDefault();
      image.attr('src', tmwc_data.tmw_uri + '/img/img-placeholder.png');
      image_field.val('');
      image_url.val('');
      image_width.val('');
      image_height.val('');
      image_title.val('');
      image_type.val('');
      image_icon.val('');
      $this.closest('.tmw-media-uploader').removeClass('remove-state');
    });

    /*
     * Colorpicker
     */
    $('.tmw-colorpicker').each(function () {
      var $this = $(this),
        target = $this.data('tmw-colorpicker-target'),
        cssProp = $this.data('tmw-colorpicker-css-prop'),
        pseudoTarget = $this.data('tmw-colorpicker-is-pseudo'),
        pseudoProp = $this.data('tmw-colorpicker-is-pseudo-prop');
      $this.wpColorPicker({
        change: function change(e, ui) {
          var rgbColor = ui.color.toCSS('rgb');
          if ($(target).length) {
            var prop = {};
            prop[cssProp] = rgbColor;
            $(target).css(prop);
          }
          if (typeof pseudoTarget !== 'undefined') {
            var pseudoCSS = pseudoTarget + ' { ' + pseudoProp + ': ' + rgbColor + '; }',
              head = document.head || document.getElementsByTagName('head')[0],
              style = document.createElement('style');
            style.id = 'tmw-whatsapp-admin-colorpicker-css-' + $this.attr('name');
            if ($('#tmw-whatsapp-admin-colorpicker-css-' + $this.attr('name')).length) {
              $('#tmw-whatsapp-admin-colorpicker-css-' + $this.attr('name')).text(pseudoCSS);
            } else {
              head.appendChild(style);
              style.type = 'text/css';
              if (style.styleSheet) {
                style.styleSheet.cssText = pseudoCSS;
              } else {
                style.appendChild(document.createTextNode(pseudoCSS));
              }
            }
          }

          // Show Settings Changed Warning Message
          $('.tmw-settings-changed-warning').removeClass('tmw-hide');
        }
      });
    });

    /*
     * Skin Clear All Fields Button
     */
    $('.tmw-skin-clear-all-fields').on('click', function (e) {
      e.preventDefault();
      $(this).parent().find('.tmw-colorpicker').val('').trigger('change');

      // Show Settings Changed Warning Message
      $('.tmw-settings-changed-warning').removeClass('tmw-hide');
    });

    /*
     * Reset Settings Alert
     */
    $('input[name="reset_settings"]').on('change', function () {
      if ($(this).is(':checked')) {
        var reset = confirm(tmwc_data.i18n.admin.reset_settings_alert);
        if (reset == false) {
          $(this).prop('checked', false);
        }
      }
    });
  });
})(jQuery);
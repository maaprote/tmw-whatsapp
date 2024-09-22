<?php

/**
 * Template for the admin settings page.
 * 
 * Available variables:
 * $rtl_direction_class - The RTL direction class.
 * $defaults - The default settings.
 * 
 * @package Master_Whats_Chat
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

use TMWC\Master_Whats_Chat\Functions;
use TMWC\Master_Whats_Chat\Admin\SettingsFields;
use TMWC\Master_Whats_Chat\Views\ChatWidget;

?>
<div class="tmw-whatsapp-admin-settings<?php echo esc_attr( $rtl_direction_class ); ?>">
	<div class="tmw-setup-availability-popup-wrapper tmw-hide">
		<div class="tmw-setup-availability-popup-content">
			<div class="row">
				<div class="col-12">
					<div class="tmw-setup-availability-weekday" data-day="monday">

						<div class="row align-items-center justify-content-between">
							<div class="col-auto">
								<p class="mt-0"><strong><?php echo esc_html__( 'Status:', 'master-whats-chat' ); ?></strong> <span class="tmw-setup-availability-weekday-status"><?php echo esc_html__( 'Offline all the time', 'master-whats-chat' ); ?></span></p>
							</div>
							<div class="col-auto">
								<input class="tmw-form-control-checkbox custom-checkbox-switch availability-day-switch" name="monday" value="" type="checkbox" />
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="row">
									<div class="col-12">
										<strong><?php echo esc_html__( 'Available Hours:', 'master-whats-chat' ); ?></strong>
										<p class="tmw-text-color-grey mt-0 mb-2"><?php echo esc_html__( 'When attendant is available for chat', 'master-whats-chat' ); ?></p>
									</div>
									<div class="col-lg-6">
										<label class="tmw-form-control-label d-flex justify-content-between w-100 tmw-mb-5px">
											<strong><?php echo esc_html__( 'Start:', 'master-whats-chat' ); ?></strong>
											<a href="#" class="tmw-timepicker-clear"><?php echo esc_html__( 'Clear', 'master-whats-chat' ); ?></a>
										</label>
										<input type="text" class="tmw-timepicker tmw-form-control tmw-form-control-100" name="start" value="00:00" />
									</div>
									<div class="col-lg-6">
										<label class="tmw-form-control-label d-flex justify-content-between w-100 tmw-mb-5px">
											<strong><?php echo esc_html__( 'End:', 'master-whats-chat' ); ?></strong>
											<a href="#" class="tmw-timepicker-clear"><?php echo esc_html__( 'Clear', 'master-whats-chat' ); ?></a>
										</label>
										<input type="text" class="tmw-timepicker tmw-form-control tmw-form-control-100" name="end" value="12:00" />
									</div>
								</div>
							</div>
							<div class="col-lg-6 mb-3">
								<div class="row">
									<div class="col-12">
										<strong><?php echo esc_html__( 'Interval:', 'master-whats-chat' ); ?></strong>
										<p class="tmw-text-color-grey mt-0 mb-2"><?php echo esc_html__( 'Time not available during the day. Eg: Lunch', 'master-whats-chat' ); ?></p>
									</div>
									<div class="col-lg-6">
										<label class="tmw-form-control-label d-flex justify-content-between w-100 tmw-mb-5px">
											<strong><?php echo esc_html__( 'Start:', 'master-whats-chat' ); ?></strong>
											<a href="#" class="tmw-timepicker-clear"><?php echo esc_html__( 'Clear', 'master-whats-chat' ); ?></a>
										</label>
										<input type="text" class="tmw-timepicker tmw-form-control tmw-form-control-100" name="interval-start" value="" />
									</div>
									<div class="col-lg-6">
										<label class="tmw-form-control-label d-flex justify-content-between w-100 tmw-mb-5px">
											<strong><?php echo esc_html__( 'End:', 'master-whats-chat' ); ?></strong>
											<a href="#" class="tmw-timepicker-clear"><?php echo esc_html__( 'Clear', 'master-whats-chat' ); ?></a>
										</label>
										<input type="text" class="tmw-timepicker tmw-form-control tmw-form-control-100" name="interval-end" value="" />
									</div>
								</div>
							</div>
							<div class="col-12">
								<label class="tmw-form-control-label">
									<strong><?php echo esc_html__( 'Timezone:', 'master-whats-chat' ); ?></strong>
								</label>
								<p class="tmw-text-color-grey mt-0 mb-2"><?php echo esc_html__( 'This option will overwrite the default timezone of the attendant in this specific day', 'master-whats-chat' ); ?></p>
								<?php SettingsFields::timezone_html_select( 'timezone', '' ); ?>
							</div>
						</div>

 					</div>
				</div>
				
			</div>
		</div>
	</div>
	<div class="container-fluid p-lg-5 py-4 py-lg-5">

		<div class="row">
			<div class="col-xl-9">
				<div id="tmwWhatsappTab" class="tmw-tab-wrapper">
					<ul class="tmw-tab-navigation">
					    <li><a href="#tabGeneral"><?php echo esc_html__( 'General', 'master-whats-chat' ); ?></a></li>
					    <li><a href="#tabAttendants"><?php echo esc_html__( 'Attendants', 'master-whats-chat' ); ?></a></li>
					    <li><a href="#tabSkin"><?php echo esc_html__( 'Skin', 'master-whats-chat' ); ?></a></li>
						<li><a href="#tabPerformance"><?php echo esc_html__( 'Performance', 'master-whats-chat' ); ?></a></li>
						<li><a href="#tabReset"><?php echo esc_html__( 'Reset', 'master-whats-chat' ); ?></a></li>
					</ul>
					<form id="rm_settings" class="tmw-bg-light p-4" data-nonce="<?php echo esc_attr( wp_create_nonce( 'tmw-save-plugin-settings-nonce' ) ); ?>">
						<div class="row">
							<?php foreach( $defaults['fields'] as $field_name => $field_val ) : ?>
								<?php if ( ! isset( $field_val['type'] ) ) {
									continue;
								} ?>

								<?php if( $field_val['type'] == 'multi' ) : ?>

									<div class="attendants-wrapper">

										<?php if( isset($field_val['value']) && !empty($field_val['value']) && is_array($field_val['value']) ) : ?>
											<?php foreach( $field_val['value'] as $multi_field_key => $multi_field_val ) : ?>
												<div class="attendant col-md-12">
													<span class="attendant-id"><?php echo esc_html__( 'ATTENDANT ID:', 'master-whats-chat' ); ?> <span class="id"><?php echo esc_html($multi_field_val['id']); ?></span></span> 
													<div class="row mt-4">
														<div class="tmw-form-group tmw-form-group-mobile-md col-lg-6">
															<label class="tmw-form-control-label">
																<strong><?php echo esc_html__( 'Attendant Name:', 'master-whats-chat' ); ?></strong>
																<p class="tmw-form-control-description"><?php echo esc_html__( 'The name of attendant', 'master-whats-chat' ); ?></p>
															</label>
															<input class="tmw-form-control attendant-name" name="<?php echo esc_attr( $field_name ); ?>" class="form-control" value="<?php echo esc_attr( wp_unslash($multi_field_val['name']) ); ?>" type="text" />
														</div>
														<div class="tmw-form-group tmw-form-group-mobile-md col-lg-6">
															<label class="tmw-form-control-label">
																<strong><?php echo esc_html__( 'Attendant Description:', 'master-whats-chat' ); ?></strong>
																<p class="tmw-form-control-description"><?php echo esc_html__( 'The description of attendant', 'master-whats-chat' ); ?></p>
															</label>
															<input class="tmw-form-control attendant-description" name="<?php echo esc_attr( $field_name ); ?>" class="form-control" value="<?php echo esc_attr( wp_unslash($multi_field_val['description']) ); ?>" type="text" />
														</div>
													</div>
													<div class="row mt-3">
														<div class="tmw-form-group tmw-form-group-mobile-md col-lg-6">
															<label class="tmw-form-control-label">
																<strong><?php echo esc_html__( 'Attendant Start Message:', 'master-whats-chat' ); ?></strong>
																<p class="tmw-form-control-description"><?php echo esc_html__( 'The start message of attendant', 'master-whats-chat' ); ?></p>
															</label>
															<input class="tmw-form-control attendant-start_message" name="<?php echo esc_attr( $field_name ); ?>" class="form-control" value="<?php echo esc_attr( wp_unslash($multi_field_val['start_message']) ); ?>" type="text" />
														</div>
														<div class="tmw-form-group tmw-form-group-mobile-md col-lg-6">
															<label class="tmw-form-control-label">
																<strong><?php echo esc_html__( 'Attendant Phone:', 'master-whats-chat' ); ?></strong>
																<p class="tmw-form-control-description"><?php echo esc_html__( 'The attendant phone. Do not add "+" before the number', 'master-whats-chat' ); ?></p>
																<span class="tmw-form-control-tooltip">
																<?php echo esc_html__( 'Group Invite Links', 'master-whats-chat' ) ?>
																	<span class="tmw-form-control-tooltip-popup">
																		<p><?php echo esc_html__( 'This field also accept group invite links. For example: https://chat.whatsapp.com/DZb5cMkpM9P6knck5mi34W', 'master-whats-chat' ); ?></p>
																	</span>
																</span>
															</label>
															<input class="tmw-form-control attendant-phone" name="<?php echo esc_attr( $field_name ); ?>" class="form-control" value="<?php echo esc_attr($multi_field_val['phone']); ?>" type="text" />
														</div>
													</div>
													<div class="row mt-3">
														<div class="tmw-form-group tmw-form-group-mobile-md col-lg-6">
															<div class="row">
																<div class="tmw-form-group tmw-form-group-mobile-md col-12 d-flex">
																	<label class="tmw-form-control-label">
																		<strong><?php echo esc_html__( 'Attendant Offline Message:', 'master-whats-chat' ); ?></strong>
																		<p class="tmw-form-control-description"><?php echo esc_html__( 'The message when attendat is not available for chat', 'master-whats-chat' ); ?></p>
																	</label>
																	<input class="tmw-form-control attendant-offline_message" name="<?php echo esc_attr( $field_name ); ?>" class="form-control" value="<?php echo esc_attr( wp_unslash($multi_field_val['offline_message']) ); ?>" type="text" />
																</div>
																<div class="tmw-form-group tmw-form-group-mobile-md col-12 d-flex mt-3">
																	<label class="tmw-form-control-label">
																		<strong><?php echo esc_html__( 'Attendant Interval Message:', 'master-whats-chat' ); ?></strong>
																		<p class="tmw-form-control-description"><?php echo esc_html__( 'The message when attendat is not available for chat during interval', 'master-whats-chat' ); ?></p>
																	</label>
																	<input class="tmw-form-control attendant-interval_message" name="<?php echo esc_attr( $field_name ); ?>" class="form-control" value="<?php echo esc_attr( ($multi_field_val['interval_message']) ); ?>" type="text" />
																</div>
															</div>
														</div>
														<div class="tmw-form-group tmw-form-group-mobile-md col-lg-6">
															<div class="row">
																<div class="tmw-form-group tmw-form-group-mobile-md col-12 d-flex">
																	<label class="tmw-form-control-label">
																		<strong><?php echo esc_html__( 'Attendant Timezone', 'master-whats-chat' ); ?>:</strong>
																		<p class="tmw-form-control-description"><?php echo esc_html__( 'The attendant timezone', 'master-whats-chat' ); ?></p>
																	</label>
																	<?php SettingsFields::timezone_html_select( $field_name, $multi_field_val['default_timezone'], ' attendant-default-timezone' ); ?>
																</div>
																<div class="tmw-form-group tmw-form-group-mobile-md col-12 d-flex mt-3">
																	<label class="tmw-form-control-label">
																		<strong><?php echo esc_html__( 'Attendant Image:', 'master-whats-chat' ); ?></strong>
																		<p class="tmw-form-control-description"><?php echo esc_html__( 'The attendant image. Default size: 50x50', 'master-whats-chat' ); ?></p>
																	</label>
																	<?php SettingsFields::media_upload( $multi_field_val, 'attendant-image' ); ?>
																</div>
															</div>
														</div>
													</div>

													<div class="row">
														<div calss="col">
															<p><strong><?php echo esc_html__( 'Setup Availability', 'master-whats-chat' ); ?></strong></p>
															<div class="tmw-setup-availability-days-wrapper">
																
																<?php foreach( $multi_field_val['availability'] as $dayString => $optsArray ) : ?>
																<a href="#" class="tmw-setup-availability-day tmw-setup-availability-button<?php echo esc_attr( ( $optsArray['available'] == 'yes' ? ' active' : '' ) ); ?>" data-day="<?php echo esc_attr( $dayString ); ?>" data-available="<?php echo esc_attr( $optsArray['available'] ); ?>" data-start="<?php echo esc_attr( $optsArray['start'] ); ?>" data-end="<?php echo esc_attr( $optsArray['end'] ); ?>" data-interval-start="<?php echo esc_attr( $optsArray['interval_start'] ); ?>" data-interval-end="<?php echo esc_attr( $optsArray['interval_end'] ); ?>" data-timezone="<?php echo esc_attr( $optsArray['timezone'] ); ?>">
																	<?php echo esc_html( $dayString ); ?>
																</a>
																<?php endforeach; ?>
																
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col">
															<a href="#" class="tmw-setup-availability-trigger-all-days" data-toggle-text-disable="<?php echo esc_attr__( 'Disable all days', 'master-whats-chat' ); ?>" data-toggle-text-enable="<?php echo esc_attr__( 'Enable all days', 'master-whats-chat' ); ?>"><?php echo esc_html__( 'Enable all days', 'master-whats-chat' ); ?></a>
														</div>
													</div>
													
													<div class="row justify-content-end mt-3">
														<div class="col-auto">
															<a href="#" class="attendant-remove"><?php echo esc_html__( 'Remove Attendant', 'master-whats-chat' ); ?></a>
														</div>
													</div>
												</div>

											<?php endforeach; ?>
										<?php endif; ?>
									</div>

									<a href="#" class="attendant-add-new tmw-button-primary"><?php echo esc_html__( 'ADD NEW', 'master-whats-chat' ); ?></a>

								<?php elseif( $field_val['type'] == 'tab_start' ) : ?>

									<div id="<?php echo esc_attr( $field_val['tab_id'] ); ?>" class="tmw-tab-content">

										<?php if( isset($field_val['prepend_html']) && !empty($field_val['prepend_html']) ) : ?>

											<?php echo wp_kses_post( $field_val['prepend_html'] ); ?>

										<?php endif; ?>

								<?php elseif( $field_val['type'] == 'tab_close' ) : ?>

									</div>

								<?php elseif( $field_val['type'] == 'heading' ) : ?>

									<h2 class="tmw-mb-0px"><?php echo esc_html( $field_val['label'] ); ?></h2>
									<p class="tmw-text-color-grey"><?php echo esc_html( $field_val['desc'] ); ?></p>

								<?php elseif( $field_val['type'] == 'space' ) : ?>

									<div class="tmw-spacer" style="padding-top: <?php echo esc_attr( $field_val['value'] ); ?>;"></div>

								<?php else : ?>

									<?php 
									// Form Group Class (Responsive Purpose)
									$form_group_class = 'tmw-form-group';
									if( isset($field_val['form_group_class']) ) {
										$form_group_class = 'tmw-form-group' . ' ' . esc_attr( $field_val['form_group_class'], 'master-whats-chat' );
									} ?>

									<div class="<?php echo esc_attr( $form_group_class ); ?> col-md-12 align-items-center mt-3<?php echo esc_attr( SettingsFields::conditional_class( $field_val ) ); ?>"<?php echo wp_kses_post( SettingsFields::conditional_atts( $field_val ) ); ?>>
									
										<label class="tmw-form-control-label">
											<strong><?php echo esc_html($field_val['label']); ?></strong>
											<p class="tmw-form-control-description"><?php echo esc_html($field_val['desc']); ?></p>
											<?php if( isset($field_val['tooltip']) && $field_val['tooltip'] == true ) : ?>
												<span class="tmw-form-control-tooltip">
													<?php echo esc_html( $field_val['tooltip_title'] ); ?>
													<span class="tmw-form-control-tooltip-popup">
														<?php foreach( $field_val['tooltip_content'] as $markup => $label ) : ?>

															<?php if( $markup == 'explain' ) : ?>
																<p><?php echo esc_html( $label ); ?></p>
															<?php else : ?>
																<div class="tmw-d-flex justify-content-between">
																	<span><strong><?php echo esc_html( $label ); ?></strong></span>
																	<span><?php echo esc_html( $markup ); ?></span>
																</div>
															<?php endif; ?>

														<?php endforeach; ?>
													</span>
												</span>
											<?php endif; ?>
										</label>

										<?php if( isset($field_val['type']) && $field_val['type'] == 'textarea' ) : ?>
											<textarea name="<?php echo esc_attr( $field_name ); ?>" class="tmw-form-control" rows="4"><?php echo esc_attr($field_val['value']); ?></textarea>
										<?php elseif( isset($field_val['type']) && $field_val['type'] == 'select' ) : ?>
											<select class="tmw-form-control tmw-form-control-select" name="<?php echo esc_attr( $field_name ); ?>">
												
												<?php foreach( $field_val['opts'] as $opt_key => $opt_val ) : ?>
													<option value="<?php echo esc_attr( $opt_key ); ?>"<?php selected( $opt_key, $field_val['value'], true ); ?>><?php echo esc_html( $opt_val ); ?></option>
												<?php endforeach; ?>
												
											</select>
										<?php elseif( isset($field_val['type']) && $field_val['type'] == 'switch' ) : ?>
											<div class="custom-radio-switch">
												
												<?php 
												$index = 0;
												foreach( $field_val['opts'] as $option_key => $option_value ) : ?>

													<input class="tmw-form-control-radio" type="radio" id="switch-<?php echo esc_attr($field_name . $option_key); ?>" name="<?php echo esc_attr($field_name); ?>" value="<?php echo esc_attr( $option_key ); ?>" <?php echo checked( $option_key, $field_val['value'], true ); ?> />
													<label for="switch-<?php echo esc_attr($field_name . $option_key); ?>"><?php echo esc_html($option_value); ?></label>

												<?php 
												$index++;
												endforeach; ?>

											</div>
										<?php elseif( isset($field_val['type']) && $field_val['type'] == 'switch_onoff' ) : ?>

											<input class="tmw-form-control-checkbox custom-checkbox-switch" name="<?php echo esc_attr( $field_name ); ?>" type="checkbox" <?php echo checked( $field_val['value'], 'on', true ); ?> />

										<?php elseif( isset($field_val['type']) && $field_val['type'] == 'colorpicker' ) : ?>

											<input type="text" class="tmw-colorpicker" name="<?php echo esc_attr( $field_name ); ?>" value="<?php echo esc_attr( $field_val['value'] ); ?>" data-tmw-colorpicker-target="<?php echo esc_attr( $field_val['target'] ); ?>" data-tmw-colorpicker-css-prop="<?php echo esc_attr( $field_val['cssProp'] ); ?>"<?php echo ( isset($field_val['pseudo']) ? ' data-tmw-colorpicker-is-pseudo="' . esc_attr( $field_val['pseudo'] ) . '"' : '' ); ?><?php echo ( isset($field_val['pseudo_prop']) ? ' data-tmw-colorpicker-is-pseudo-prop="' . esc_attr( $field_val['pseudo_prop'] ) . '"' : '' ); ?> />

										<?php elseif( isset($field_val['type']) && $field_val['type'] == 'image_upload' ) : ?>

											<?php SettingsFields::media_upload( $field_val['value'], $field_name ); ?>

										<?php elseif( isset($field_val['type']) && $field_val['type'] == 'padding_margin' ) : ?>

											<?php SettingsFields::padding_margin( $field_val['value'], $field_name ); ?>

										<?php elseif( isset($field_val['type']) && $field_val['type'] == 'number' ) : ?>

										<input name="<?php echo esc_attr( $field_name ); ?>" class="tmw-form-control" value="<?php echo esc_attr($field_val['value']); ?>" type="number" min="0" max="999" />

										<?php else : ?>

											<input name="<?php echo esc_attr( $field_name ); ?>" class="tmw-form-control" value="<?php echo esc_attr( wp_unslash( $field_val['value'] )); ?>" type="text"<?php echo ( isset($field_val['placeholder']) ) ? ' placeholder="'. esc_attr( $field_val['placeholder'] ) .'"' : ''; ?> />

										<?php endif; ?>

									</div>

								<?php endif; ?>

							<?php endforeach; ?>
						</div>

					</form>
					<div class="tmw-settings-changed-warning tmw-hide">
						<p><?php echo esc_html__( 'Settings Changed! Click save button to see the new changes in the preview.', 'master-whats-chat' ); ?> </p>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col d-flex align-items-center">
						<a href="#" class="tmw-button-primary tmw-settings-save"><?php echo esc_html__( 'Save Settings', 'master-whats-chat' ); ?></a>
						<span class="tmw-settings-save-success d-none px-4"><strong style="color: green;"><?php echo esc_html__( 'Settings Updated!', 'master-whats-chat' ); ?></strong></span>
					</div>
				</div>
			</div>
			<div class="col-lg-5">
				<div class="tmw-whatsapp-admin-wrapper">
					
					<?php 
					// Render the floating whast app chat in the settings page
					// The purpose is live preview
					ChatWidget::instance(); ?>

				</div>
			</div>
		</div>

	</div>
</div>
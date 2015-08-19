<?php do_action( 'bp_before_profile_edit_content' );

if ( bp_has_profile( 'profile_group_id=' . bp_get_current_profile_group_id() ) ) :
	while ( bp_profile_groups() ) : bp_the_profile_group(); ?>

<form action="<?php bp_the_profile_group_edit_form_action(); ?>" method="post" id="profile-edit-form" class="standard-form form-horizontal <?php bp_the_profile_group_slug(); ?>">

	<?php do_action( 'bp_before_profile_field_content' ); ?>

		<h4><?php printf( __( "Editing '%s' Profile Group", 'firmasite' ), bp_get_the_profile_group_name() ); ?></h4>

		<?php if ( bp_profile_has_multiple_groups() ) : ?>
			<ul class="button-nav nav nav-tabs">

				<?php bp_profile_group_tabs(); ?>

			</ul>
		<?php endif ;?>

		<div class="clear clearfix"></div>
		<div class="panel panel-default">
        <div class="panel-body">
		<?php while ( bp_profile_fields() ) : bp_the_profile_field(); ?>

			<div<?php bp_field_css_class( 'editfield' ); ?>>

				<?php
					
				$field_type = bp_xprofile_create_field_type( bp_get_the_profile_field_type() );
				$field_type->edit_field_html();

				do_action( 'bp_custom_profile_edit_fields_pre_visibility' );

				if ( bp_current_user_can( 'bp_xprofile_change_field_visibility' ) ) : ?>
				<div class="form-group">
				  <div class="col-sm-offset-3 col-sm-9">
					<p class="field-visibility-settings-toggle text-muted" id="field-visibility-settings-toggle-<?php bp_the_profile_field_id() ?>">
						<?php printf( __( 'This field can be seen by: <span class="current-visibility-level">%s</span>', 'firmasite' ), bp_get_the_profile_field_visibility_level_label() ) ?> <a href="#" class="visibility-toggle-link"><?php _ex( 'Change', 'Change profile field visibility level', 'firmasite' ); ?></a>
					</p>

					<div class="field-visibility-settings well well-sm" id="field-visibility-settings-<?php bp_the_profile_field_id() ?>" style="display: none;">
						<fieldset>
							<legend><?php _e( 'Who can see this field?', 'firmasite' ) ?></legend>

							<?php bp_profile_visibility_radio_buttons() ?>

						</fieldset>
						<a class="field-visibility-settings-close" href="#"><?php _e( 'Close', 'firmasite' ) ?></a>

					</div>
				<?php else : ?>
				<div class="form-group">
				  <div class="col-sm-offset-3 col-sm-9">
					<p class="field-visibility-settings-notoggle text-muted" id="field-visibility-settings-toggle-<?php bp_the_profile_field_id() ?>">
						<?php printf( __( 'This field can be seen by: <span class="current-visibility-level">%s</span>', 'firmasite' ), bp_get_the_profile_field_visibility_level_label() ) ?>
					</p>
				<?php endif ?>

					<?php do_action( 'bp_custom_profile_edit_fields' ); ?>

					<div class="description"><?php bp_the_profile_field_description(); ?></div>
				  </div>
				</div>
			</div>

		<?php endwhile; ?>
        </div>
        </div>

	<?php do_action( 'bp_after_profile_field_content' ); ?>

	<div class="submit">
		<input type="submit" class="btn btn-primary" name="profile-group-edit-submit" id="profile-group-edit-submit" value="<?php esc_attr_e( 'Save Changes', 'firmasite' ); ?> " />
	</div>

	<input type="hidden" name="field_ids" id="field_ids" value="<?php bp_the_profile_field_ids(); ?>" />

	<?php wp_nonce_field( 'bp_xprofile_edit' ); ?>

</form>

<?php endwhile; endif; ?>

<?php do_action( 'bp_after_profile_edit_content' ); ?>

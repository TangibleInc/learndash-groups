<?php

namespace Tangible\LearnDashGroups\Modules\Settings;

defined( 'ABSPATH' ) or die( 'Nothing to see here' );

use Tangible\LearnDashGroups\Modules\Settings as settings;

/**
 * Render select settings field
 *
 * @param      string  $key      The key
 * @param      array   $options  The options
 * @param      string  $label    The label
 */
function select( string $key, array $options, string $label = '' ) {

  $value = settings\get('redirect-type');
  $name = settings\field_name('redirect-type');

  require LearnDashGroups_DIR . 'includes/views/admin/fields/select.php';
}

/**
 * Render image upload settings field
 *
 * @param      string  $key      The key
 * @param      array   $type     The type : picture, banner
 * @param      string  $label    The label
 * @param      string  $context  The context : plugin_settings, meta_boxes
 */
function image_upload( string $key, string $type, string $label = '', string $context = 'plugin_settings' ) {

  if( !in_array( $context, ['plugin_settings', 'meta_boxes'] ) ) return '';

	wp_enqueue_media();
	$value = settings\get( $key );
	$has_image = ($value)? ' has-image' : '' ;
	if( $context = 'plugin_settings' ) {
		$name = settings\field_name( $key );
	}

	require LearnDashGroups_DIR . 'includes/views/admin/fields/image-upload.php';
}

/**
 * Render check box using framework rendering + nice CSS
 *
 * @param      string  $key    The key
 * @param      string  $label  The label
 * @param      string  $note   The note
 *
 * @return     html
 */
function checkbox(string $key, string $label, string $note = "") {

  $framework = \tangible_lg()->framework;

  $note = !empty($note) ? '<i>(' . __( $note, 'ld-groups' ) . ')</i>' : ''; ?>

  <div class="setting-row ttge-setting-row ttge-setting-row-checkbox">
    <?php $framework->render_setting_field([
      'type'  => 'checkbox',
      'name'  => settings\field_name( $key ),
      'value' => settings\get( $key ),
      'label' => '<span></span><div>' . __( $label, 'ld-groups' ) . ' ' . $note . '</div>',
    ]); ?>
  </div><?php
}

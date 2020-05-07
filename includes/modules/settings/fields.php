<?php

namespace Tangible\LearnDashGroups\Modules\Settings;

defined( 'ABSPATH' ) or die( 'Nothing to see here' );

use Tangible\LearnDashGroups\Modules\Settings as settings;
use Tangible\LearnDashGroups\StudentGroup;

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

  global $post;

  if( !in_array( $context, ['plugin_settings', 'meta_boxes'] ) ) return '';

	wp_enqueue_media();

	$value = '';
	$wrapper_class = '';
	if( $context === 'plugin_settings' ) {
		$value = settings\get( $key );
		$name = settings\field_name( $key );
		$wrapper_id_class = 'ttge-default-group-images';

	} elseif( $context === 'meta_boxes' ){
		$group = new StudentGroup( $post -> ID );
		$value = $group -> get_setting( $type );
		$name =  $key;
		$wrapper_id_class = 'ttge-group-images';
  }
	$has_image = ( $value ) ? ' has-image' : '' ;
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

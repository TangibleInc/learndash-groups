<?php

namespace Tangible\LearnDashGroups\Utils;

defined( 'ABSPATH' ) or die( 'Nothing to see here' );

use Tangible\LearnDashGroups\Utils as utils;

/**
 * Save a $_FILES ressource in wordpress
 * 
 * @param  string $filesname Name of the $_FILES index we want to upload
 * 
 * @return mixed
 */
function save_image( $filesname ) {

	require_once( ABSPATH . 'wp-admin/includes/admin.php' );
    
  $image = wp_handle_upload( $_FILES[$filesname], array('test_form' => false ) );

	if( isset( $image['error'] ) || isset( $image['upload_error_handler'] ) ) return false;
    
	$filename = $image['file'];

  $attachment = array(
    'post_mime_type'  => $image['type'],
    'post_title'      => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
    'post_content'    => '',
    'post_status'     => 'inherit',
    'guid'            => $image['url']
  );
  $attachment_id = wp_insert_attachment( $attachment, $image['url'] );
  
  require_once( ABSPATH . 'wp-admin/includes/image.php' );
  
  $attachment_data = wp_generate_attachment_metadata( $attachment_id, $filename );
  wp_update_attachment_metadata( $attachment_id, $attachment_data );
  
  return 0 < intval( $attachment_id ) ? $attachment_id : false;
}

<?php

namespace Tangible\LDGroups;

defined( 'ABSPATH' ) or die( 'Nothing to see here' );


Class StudentGroup
{


	/**
	 * Construct
	 */
	public function __construct( $id ) {
		
		$this->id = (int) $id;
	}



	/**
	 * Update a group level setting 
	 * 
	 * @param  string $key      This can be : comment, global, studentpost or moderate
	 * @param  string $value 
	 */
	public function update_settings( $key, $value ) {

		if( get_post_meta( $this->id, 'ldg-' . $key . '-settings', false ) )
			update_post_meta( $this->id, 'ldg-' . $key . '-settings', $value );
		else
			add_post_meta( $this->id, 'ldg-' . $key . '-settings', $value, true );
	}



	/**
	 * Return a setting
	 * 
	 * @param  string $key 	 	This can be : comment, global, studentpost or moderate
	 * 
	 * @return bool
	 */
	public function get_setting( $key ) {

		$settings = get_post_meta( $this->id, 'ldg-' . $key . '-settings', true );

		// Picture and banner aren't boolean
		if( $key === 'picture' || $key === 'banner' ) {
			$settings = (int) $settings;
		}

		return $settings;
	}



	/**
	 * Save a picture (if exist in the $_FILES array) and add a post
	 * meta to the group with the link of the picture
	 */
	public function save_picture() {

		if( !empty($_FILES['ttsg_metabox-file-picture']) ) {
			$picture_id = ldgroups_save_image( 'ttsg_metabox-file-picture' );

			$this->update_settings( 'picture', $picture_id );
		}
	}



	/**
	 * Return the link of the picture set for the student group
	 * 
	 * @return string 	url
	 */
	public function get_picture_link() {

		$attachment_id = $this->get_setting( 'picture' );
		
		if( $attachment_id )
			$response = wp_get_attachment_url( $attachment_id );
		else
			$response = false;
		
		return $response; 
	}



	/**
	 * Save the banner (if exist in the $_FILES array) and add a post
	 * meta to the group with the link of the banner
	 */
	public function save_banner() {

		if( !empty($_FILES['ttsg_metabox-file-banner']) ) {
			$picture_id = ldgroups_save_image( 'ttsg_metabox-file-banner' );

			$this->update_settings( 'banner', $picture_id );
		}
	}



	/**
	 * Return the link of the picture set for the student group
	 * 
	 * @return string 	url
	 */
	public function get_banner_link() {

		$attachment_id = $this->get_setting( 'banner' );

		if( $attachment_id )
			$response = wp_get_attachment_url( $attachment_id );
		else
			$response = false;
		
		return $response; 
	}


}
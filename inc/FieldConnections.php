<?php

namespace Tangible\LDGroups;

defined( 'ABSPATH' ) or die( 'Nothing to see here' );


/**
 * This class register field connections for Beaver Themer
 * 
 * https://www.wpbeaverbuilder.com/beaver-themer/
 */
Class FieldConnections
{


	/**
	 * Constructor
	 */
	public function __construct() {
		
		add_action( 'init', function() {

			// Only if BeaverBuilder is activate 
			if( class_exists( '\FLBuilder' ) )
				$this->register_fields_connection(); 
		
		});

	}



	/**
	 * Register field connexion for beaver themer
	 * 
	 * @return void
	 */
	private function register_fields_connection() {

		add_action('fl_page_data_add_properties', function () {

			\FLPageData::add_group( 'ld-groups', array(
    			'label' => 'LearnDash : Groups'
			));	

	    	\FLPageData::add_post_property( 'ld-groups_picture', array(
		        'label'   => __( 'Picture', 'ld-groups' ),
		        'group'   => 'ld-groups',
		        'type'    => 'photo',
		        'getter'  => array( $this, 'get_current_picture' )
	    	));

	    	\FLPageData::add_post_property( 'ld-groups_banner', array(
		        'label'   => __( 'Banner', 'ld-groups' ),
		        'group'   => 'ld-groups',
		        'type'    => 'photo',
		        'getter'  => array( $this, 'get_current_banner' )
	    	));

		}, 1);

	}



	/**
	 * If the current object is a post and the postype of this
	 * post is a LearnDash student group, we return the url of
	 * the picture (if any)
	 * 
	 * @return string url
	 */
	public function get_current_picture() {

		if( get_queried_object() ){
			$post = get_queried_object();

			if( property_exists( $post, 'post_type' ) && $post->post_type === 'groups' ) {

				$group = new StudentGroup( $post->ID );
				$link = $group->get_picture_link();

				return $link;
			}
		}

		return false;
	}



	/**
	 * If the current object is a post and the postype of this
	 * post is a LearnDash student group, we return the url of
	 * the banner (if any)
	 * 
	 * @return string url
	 */
	public function get_current_banner() {

		if( get_queried_object() ){
			$post = get_queried_object();

			if( property_exists( $post, 'post_type' ) && $post->post_type === 'groups' ) {

				$group = new StudentGroup( $post->ID );
				$link = $group->get_banner_link();

				return $link;
			}
		}

		return false;
	}


}


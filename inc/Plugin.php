<?php 

namespace Tangible\LDGroups;

defined( 'ABSPATH' ) or die( 'Nothing to see here' );

use Tangible\LDGroups\User;

Class Plugin
{

	/**
	 * Constructor
	 */
	public function __construct() {

		// Current user
		$this->user = new User();

		// Set the visibility of the cpt to true
		$this->set_groups_to_public();

		// Restrict access to the users which are into the group
		$this->restrict_group_access();
	}
	


	/**
	 * Set student group to public
	 */
	private function set_groups_to_public() {

		add_filter( 'learndash-cpt-options', function ($args, $post_type) {

			if( $post_type === 'groups' ) {

			    $args = array_merge($args, [
			      	'public' => true,
			      	'show_in_nav_menus' => true,
			      	'has_archive' => true,
			      	'publicly_queryable' => true,
			    ]);

			    $args['capabilities']['read_post'] = 'read_post';
			}

			return $args;

		}, 10, 2);
	}	



	/**
	 * Restict the access to the student group to the student adn groupleader of
	 * the group, and the administrator
	 */
	private function restrict_group_access() {
		
		/**
		 * Redirect to the home if the user is not authorized to access the student group
		 */
		add_action( 'wp', function() {

    		if ( is_singular( 'groups' ) ) {

	 			$group_id = (int) get_queried_object_id();

        		if( !$this->user->is_in_group( $group_id ) ) {
					$url = (string) get_home_url();
        			wp_safe_redirect( $url, 302, 'WordPress' );
        			exit();
        		}
        		
        	}

		}, 10, 1 );


		/**
		 * Normally this is useless, but if for some reason the redirection is not working,
		 * wer are not displaying the content
		 */
	 	add_filter( 'the_content', function( $content ) {

    		if ( is_singular( 'groups' ) ) {
    			
	 			$group_id = (int) get_queried_object_id();

        		if( !$this->user->is_in_group( $group_id ) ) {
        			$content = __( 'You are not authorized to access to this student group', 'ld-groups' );
        			exit();
        		}
        	}

    		return $content;
		});	

	}
}
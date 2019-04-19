<?php

namespace Tangible\LDGroups;

defined( 'ABSPATH' ) or die( 'Nothing to see here' );


/**
 * Handle the logic in the admin part of wordpress
 */
Class GroupAccess
{


	/**
	 * Constructor
	 */
	public function __construct() {

		// Manage the student group banner / picture part
		$this->student_groups_picture();
	}



	/**
	 * Add the meta box in the Student groups post type part
	 */
	private function student_groups_picture() {


		/**
		 * Add the front part of the metabox
		 */
		add_action( 'add_meta_boxes', function() {
			add_meta_box( 
        		'ld-groups_picture_meta_box_options',
        	 	__( 'Student Group Pictures', 'ld-groups' ), 
        	 	array( $this, 'get_metabox_content' ), 
        	 	'groups', 
        	 	'advanced', 
        		'high'
        	);
		} );

		
		/**
		 * Add the js/ css
		 */
		add_action( 'admin_enqueue_scripts', function() {
			wp_enqueue_script( 'meta-boxes-pictures-js', TangibleGroups_URL . 'assets/js/admin/meta-boxes/pictures.js' );
			wp_enqueue_style( 'meta-boxes-pictures-css', TangibleGroups_URL . 'assets/css/admin/admin.css' );
		});


		/**
		 * Save the data of the metabox
		 */
		add_action( 'save_post', function( $post_id ) {

			if( !wp_verify_nonce( $_POST['ld-group-pictures'], 'save_post' ) )
				return $post_id;

			if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
				return $post_id;

			// Check permissions to edit pages and/or posts
			if ( 'groups' !== $_POST['post_type'] ) {
				return $post_id;
			} 

			$group = new StudentGroup( $post_id );
			$group->save_picture();
			$group->save_banner();

			return $post_id;
		});


		/**
		 * We need to add the multipart/form-data attribute 
		 * to the <form> for allowing us to upload image
		 * 
		 * src: https://gist.github.com/rfmeier/3513349
		 */
		add_action('post_edit_form_tag', function() {

			global $post;
    
    		if(!$post)
        		return;
    
    		// get the current post type
    		$post_type = get_post_type($post->ID);

    		if( 'groups' != $post_type )
        		return;
    
    		// append our form attributes
    		printf(' enctype="multipart/form-data"');
		});

	}



	/**
	 * Return meta box content
	 * 
	 * @return string html
	 */
	public function get_metabox_content() {
		
		$group = new StudentGroup( get_the_ID() );
		
		ob_start();
		require TangibleGroups_DIR . 'template/admin/meta-boxes/pictures.php';
		$content = ob_get_clean();

		echo $content; 
	}
}


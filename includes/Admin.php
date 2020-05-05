<?php

namespace Tangible\LearnDashGroups;

defined( 'ABSPATH' ) or die( 'Nothing to see here' );


/**
 * Handle the logic in the admin part of WordPress
 */
class Admin {

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
        __( 'LearnDash Group Assets', 'ld-groups' ),
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
      wp_enqueue_script( 'ttlg-admin', LearnDashGroups_URL . 'assets/build/admin.min.js' );
      wp_enqueue_style( 'ttlg-admin', LearnDashGroups_URL . 'assets/build/admin.min.css' );

	    wp_localize_script( 'ttlg-admin', 'ImageUpload', [
			    'media_modal_title' => __( 'Select an image to upload', 'ld-groups' ),
			    'media_modal_button' => __( 'Use this image', 'ld-groups' ),
			    'remove_button_confirm' => __( 'Are you sure?', 'ld-groups' ),
	    ]);
    });

    /**
     * Save the data of the metabox
     */
    add_action( 'save_post', function( $post_id ) {

	    if ( empty( $_POST ) || ! array_key_exists( 'ld-group-pictures', $_POST ) ) return $post_id;

      if ( ! wp_verify_nonce( $_POST['ld-group-pictures'], 'save_post' ) ) return $post_id;

      if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return $post_id;

      // Check permissions to edit pages and/or posts
      if ( 'groups' !== $_POST['post_type'] ) return $post_id;

      $group = new StudentGroup( $post_id );
      $group->save_picture();
      $group->save_banner();
      
      if( isset($_POST['ttge-remove-file-picture']) && $_POST['ttge-remove-file-picture'] === 'on' ) {
        $group->update_settings( 'picture', ' ');
      }

      if( isset($_POST['ttge-remove-file-banner']) && $_POST['ttge-remove-file-banner'] === 'on' ) {
        $group->update_settings( 'banner', ' ');
      }

      return $post_id;
    });

    /**
     * We need to add the multipart/form-data attribute
     * to the <form> for allowing us to upload image
     *
     * @see https://gist.github.com/rfmeier/3513349
     */
    add_action('post_edit_form_tag', function() {

      global $post;

      if ( ! $post ) return;

      // get the current post type
      $post_type = get_post_type( $post->ID );

      if ( 'groups' != $post_type ) return;

      // append our form attributes
      printf( ' enctype="multipart/form-data"' );
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
    require_once LearnDashGroups_DIR . 'includes/views/admin/meta-boxes/pictures.php';
    $content = ob_get_clean();

    echo $content;
  }
}


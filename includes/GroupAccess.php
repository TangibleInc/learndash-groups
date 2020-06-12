<?php

namespace Tangible\LearnDashGroups;

defined( 'ABSPATH' ) or die( 'Nothing to see here' );

use Tangible\LearnDashGroups\Modules\Settings as settings; 

/**
 * This class handle the comportement when a user
 * try to access to a LearnDash student group
 */
class GroupAccess {

  /**
   * Constructor
   */
  public function __construct() {

    // Current user
    add_action( 'init', function() {
      $this->user = new User();
    }, 10 );

    // Modify custom post type
    $this->modify_groups();

    // Restrict access to the users which are into the group
    $this->restrict_group_access();

	  /**
	   * Flush rewrite rules if the flag exists,
	   * and then remove the flag. Priority 20 - so, after CPT registered
	   */

	  add_action( 'init', function () {
		  if ( get_option( 'ttlg_flush_rewrite_rules_flag' ) ) {
			  flush_rewrite_rules();
			  delete_option( 'ttlg_flush_rewrite_rules_flag' );
		  }
	  }, 20 );
  }

  /**
   * Change default settings of the group custom post type
   */
  public function modify_groups() {

    // Possibility to display groups on the frontend
    add_filter( 'learndash-cpt-options', [$this, 'set_groups_to_public'], 10, 2 );
    add_action( 'the_posts', [$this, 'set_comments'], 10 );
    add_filter( 'use_block_editor_for_post_type', [$this, 'set_editor'], 20, 2 );
  }

  /**
   * Redirect to the home page and exit
   */
  public function home_redirection() {

    $url = (string) get_home_url();
    wp_safe_redirect( $url, 302, 'WordPress' );
    exit();
  }

  /**
   * Redirect to a 404 page and exit
   */
  public function not_found_redirection() {

    global $wp_query;
    $wp_query->set_404();
    status_header( 404 );
    get_template_part( 404 );
    exit();
  }

  /**
   * Get the restriction type (redirection, 404, ....)
   *
   * @return string
   */
  private function get_restriction_type() {

    $possible_restriction = array( '404', 'home' );
    $restriction = settings\get('redirect-type');

    return in_array( $restriction, $possible_restriction ) ? $restriction : '404'; 
  }

  /**
   * Set student group to public
   */
  public function set_groups_to_public( $args, $post_type ) {

    if ( $post_type !== 'groups' ) return $args;

    $args = array_merge($args, [
      'public'             => true,
      'show_in_nav_menus'  => true,
      'has_archive'        => true,
      'publicly_queryable' => true,
      'exclude_from_search'=> false
    ]);

    if( settings\get_boolean('comments') ) {
      $args['supports'][] = 'comments';
    }

    if( settings\get_boolean('gutenberg') ) {
      $args['supports'][] = 'editor';
      $args['show_in_rest'] = true;
    }

	  $args['rewrite'] = ['slug' => 'group'];
    $args['capabilities']['read_post'] = 'read_post';

    return $args;
  }

  /**
   * Remove comment on old post if there is already some
   *
   * @param      array  $posts  The posts
   */
  public function set_comments( $posts ) {

    if( !is_single() || empty($posts) ) return $posts;
    if( $posts[0]->post_type !== 'groups' ) return $posts; 
    if( settings\get_boolean('comments') ) return $posts;
      
    $posts[0]->comment_status = 'closed';
    $posts[0]->ping_status    = 'closed';
    $posts[0]->comment_count  = 0;

    return $posts;  
  }

  /**
   * Sets the editor according to the settings (gutenberg or classic)
   *
   * @param      boolean  $can_edit   Indicates if edit
   * @param      string   $post_type  The post type
   *
   * @return     boolean
   */
  public function set_editor( $can_edit, $post_type ) {

    if( $post_type !== 'groups' ) return $can_edit; 

    if( !settings\get_boolean('gutenberg') ) return $can_edit;
    
    add_filter( 'admin_body_class', function( $classes ) {
      $classes .= ' ttge-admin-gutenberg-fix';
      return $classes;
    });

    return true;
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

      if ( !is_singular( 'groups' ) ) return;

      $group_id = get_queried_object_id();

      if ( $this->user->is_in_group( $group_id ) ) return;

      switch ( $this->get_restriction_type() ) {
        case 'home':
          $this->home_redirection();
          break;
        case '404':
          $this->not_found_redirection();
          break;
        default:
          $this->not_found_redirection();
          break;
      }
      
    }, 10 ** 19, 1 ); // We need a REALLY HIGH priority for redirecting to 404 when Elementor is activated

    /**
     * Normally this is useless, but if for some reason the redirection is not working,
     * wer are not displaying the content
     */
    add_filter( 'the_content', function( $content ) {

      if ( !is_singular( 'groups' ) ) return $content;

      $group_id = get_queried_object_id();

      if( $this->user->is_in_group( $group_id ) ) return $content;
        
      $content = __( 'You are not authorized to access to this student group', 'ld-groups' );
      exit();
    });

  }
}


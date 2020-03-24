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
    $this->user = new User();

    // Set the visibility of the cpt to true
    $this->set_groups_to_public();

    // Restrict access to the users which are into the group
    $this->restrict_group_access();
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
  private function set_groups_to_public() {

    add_filter( 'learndash-cpt-options', function ( $args, $post_type ) {

      if ( $post_type !== 'groups' ) return $args;

      $args = array_merge($args, [
        'public'             => true,
        'show_in_nav_menus'  => true,
        'has_archive'        => true,
        'publicly_queryable' => true,
        'exclude_from_search'=> false
      ]);

      $args['capabilities']['read_post'] = 'read_post';

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

      if ( !is_singular( 'groups' ) ) return;

      $group_id = (int) get_queried_object_id();

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

      $group_id = (int) get_queried_object_id();

      if ( ! $this->user->is_in_group( $group_id ) ) {
        $content = __( 'You are not authorized to access to this student group', 'ld-groups' );
        exit();
      }

      return $content;
    });

  }
}


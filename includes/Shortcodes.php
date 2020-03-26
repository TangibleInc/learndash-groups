<?php

namespace Tangible\LearnDashGroups;

defined( 'ABSPATH' ) or die( 'Nothing to see here' );

use Tangible\LearnDashGroups\StudentGroup;

/**
 * This class handle all the shortcodes
 */
class Shortcodes {

  /**
   * Constructs a new instance.
   */
  public function __construct() {
  
    add_shortcode( 'ldg_user_groups', [ $this, 'user_groups' ] );
    add_shortcode( 'ldg_group_picture', [ $this, 'group_picture' ] );
    add_shortcode( 'ldg_group_cover_picture', [ $this, 'group_cover_picture' ] );
  }

  /**
   * Display userœ's group
   *
   * @param      array  $atts   The atts
   *
   * @return     string
   */
  public function user_groups( $atts ) {

    $user_id = get_current_user_id();
    if ( empty( $user_id ) ) return '';

    if ( isset( $atts['role'] ) && $atts['role'] === 'group_leader' ) {
      $groups = \learndash_get_administrators_group_ids( $user_id );
    } else {
      $groups = \learndash_get_users_group_ids( $user_id );
    }

    ob_start();
    
    if( isset($atts['style']) &&  $atts['style'] === 'simple' ) { 
      ?>
        <div class="ttge-user-groups">
          <?php foreach ( $groups as $group_id ) : ?>
            <a href="<?= get_the_permalink( $group_id ); ?>">
              <div class="ttge-user-group">
                <?= get_the_title( $group_id ); ?>
              </div>
          <?php endforeach; ?>
        </div>
      <?php 
    }
    else {
      
      wp_enqueue_style( 'ttlg-frontend', LearnDashGroups_URL . 'assets/build/frontend.min.css' );
      foreach( $groups as $key => $group ) {
        $groups[$key] = new StudentGroup( $group );
      }
      require LearnDashGroups_DIR . 'includes/views/shortcodes/user-groups.php';
    }

    return ob_get_clean();
  }

  /**
   * Display the picture of the group (set in the group edit page of the admin)
   *
   * @param      array  $atts   The atts
   *
   * @return     string
   */
  public function group_picture( $atts ) {

    if( isset($atts['id']) ) {
      $post_id = (int) $atts['id'];
      $post = get_post( $post_id );
    }
    else {
      $post = get_queried_object();
    }

    if( empty($post) ) return '';

    if( !property_exists( $post, 'post_type' ) || $post->post_type !== 'groups' ) {
      return '';
    }

    $group = new StudentGroup( $post->ID );
    return $group->get_picture();
  }

  /**
   * Display the cover picture of the group (set in the group edit page of the admin)
   *
   * @param      array  $atts   The atts
   *
   * @return     string
   */
  public function group_cover_picture( $atts ) {

    if( isset($atts['id']) ) {
      $post_id = (int) $atts['id'];
      $post = get_post( $post_id );
    }
    else {
      $post = get_queried_object();
    }

    if( empty($post) ) return '';

    if( !property_exists( $post, 'post_type' ) || $post->post_type !== 'groups' ) {
      return '';
    }

    $group = new StudentGroup( $post->ID );
    return $group->get_banner();
  }
}

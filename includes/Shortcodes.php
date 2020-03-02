<?php

namespace Tangible\LearnDashGroups;

defined( 'ABSPATH' ) or die( 'Nothing to see here' );

/**
 * This class handle all the shortcodes
 */
class Shortcodes {

  /**
   * Constructs a new instance.
   */
  public function __construct() {
    
    add_action( 'init', function() {

      add_shortcode( 'ldg_user_groups', [ $this, 'user_groups' ] );
      add_shortcode( 'ldg_group_picture', [ $this, 'group_picture' ] );
      add_shortcode( 'ldg_group_cover_picture', [ $this, 'group_cover_picture' ] );
    
    });
  }

  /**
   * Display users's group
   *
   * @param      array  $atts   The atts
   *
   * @return     string
   */
  public function user_groups( $atts ) {

    $user_id = get_current_user_id();
    if ( empty( $user_id ) ) return '';

    if ( isset( $atts['role'] ) && $atts['role'] === 'group_leader' ) {
      $user_groups = \learndash_get_administrators_group_ids( $user_id );
    } else {
      $user_groups = \learndash_get_users_group_ids( $user_id );
    }

    ob_start(); ?>
    <div class="ttlg-user-groups">
      <?php foreach ( $user_groups as $group_id ) : ?>
        <a href="<?= get_the_permalink( $group_id ); ?>">
          <div class="ttlg-user-group">
            <?= get_the_title( $group_id ); ?>
          </div>
      <?php endforeach; ?>
    </div>
    <?php

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

    ob_start(); ?>
      <div class="ttlg-group-picture">
        <img src="<?= $group->get_picture_link(); ?>">
      </div>
    <?php

    return ob_get_clean();
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

    ob_start(); ?>
      <div class="ttlg-group-picture">
        <img src="<?= $group->get_banner_link(); ?>">
      </div>
    <?php

    return ob_get_clean();
  }
}

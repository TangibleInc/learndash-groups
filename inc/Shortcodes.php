<?php

namespace Tangible\LDGroups;

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
			add_shortcode( 'extended_ld_user_groups', [$this, 'extended_ld_user_groups'] );
		});
	}


	/**
	 * Display the list of the users's group
	 *
	 * @param      array  $atts   The atts
	 *
	 * @return     string
	 */
	public function extended_ld_user_groups( $atts ) {
		
		$user_id = get_current_user_id();
    if( empty($user_id) ) return '';

    if( isset($atts['role']) && $atts['role'] === 'group_leader' ) {
      $user_groups = \learndash_get_administrators_group_ids( $user_id );
    }
    else{
      $user_groups = \learndash_get_users_group_ids( $user_id );
    }

    ob_start(); ?>
    <div class="tt-extended-ld-user-groups">
      <?php foreach( $user_groups as $group_id ): ?>
        <a href="<?= get_the_permalink( $group_id ); ?>">
          <div class="tt-extended-ld-user-group">
            <?= get_the_title( $group_id ); ?>
          </div>
      <?php endforeach; ?>
    </div>
    <?php $content = ob_get_clean();
  
    return $content;
	}
    
}

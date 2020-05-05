<?php defined( 'ABSPATH' ) or die( 'Nothing to see here' ); 

use Tangible\LearnDashGroups\Modules\Settings as settings;

?>

<div class="tangible-plugin-settings-tab-license">
    
  <h3><?= __( 'Settings', 'ld-groups' ); ?></h3>

  
  <div class="ttge-settings-container">
    
    <h4><?= __( 'Redirection', 'ld-groups' ); ?></h4>
    
    <?php settings\select(
      'redirect-type',
      [
        '404' => __( 'Redirect to the 404 page', 'ld-groups' ),
        'home' => __( 'Redirect to the home page', 'ld-groups' )
      ],
      __( 'Defines the behaviour if the user isn’t allowed to access the group.', 'ld-groups' )
    ); ?>

    <h4><?= __( 'Groups', 'ld-groups' ); ?></h4>
    
    <?php settings\checkbox(
      'comments',
      __( 'Enable comments on group pages', 'ld-groups' ),
      __( 'If enabled, comments will use the group settings', 'ld-groups' )
    ); ?>

    <?php settings\checkbox(
      'gutenberg',
      __( 'Enable Gutenberg editor on group pages', 'ld-groups' )
    ); ?>

    <?php
	    settings\image_upload(
	      'default-picture',
        'picture',
        __( 'Choose Default LearnDash Group Profile photo:', 'ld-groups' )
      ); ?>

	  <?php
		  settings\image_upload(
		    'default-banner',
        'banner',
        __( 'Choose Default LearnDash Group Cover photo', 'ld-groups' )
      ); ?>

  </div>

  <div class="setting-row">
    <?php submit_button(); ?>
  </div>  

</div>

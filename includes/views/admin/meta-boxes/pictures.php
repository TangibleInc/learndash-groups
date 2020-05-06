<?php
defined( 'ABSPATH' ) or die( 'Nothing to see here' );

use Tangible\LearnDashGroups\Modules\Settings as settings;

wp_nonce_field( 'save_post', 'ld-group-pictures' );
?>
<section class='ttge-metabox-container'>

  <?php
    settings\image_upload(
      'ttlg-picture-settings',
      'picture',
      __( 'Choose LearnDash Group Profile photo:', 'ld-groups' ),
      'meta_boxes'
    ); ?>

  <?php
    settings\image_upload(
      'ttlg-banner-settings',
      'banner',
      __( 'Choose LearnDash Group Banner photo:', 'ld-groups' ),
      'meta_boxes'
    ); ?>

</section>

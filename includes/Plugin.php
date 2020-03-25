<?php

namespace Tangible\LearnDashGroups;

defined( 'ABSPATH' ) or die( 'Nothing to see here' );

use Tangible\LearnDashGroups\Modules\Settings as settings;

/**
 * Global controller of the plugin
 */
class Plugin {

  /**
   * Constructor
   */
  public function __construct() {

    // Handle the group access logic
    new GroupAccess;

    // Handle the admin part of WordPress
    new Admin;

    // Register all the shortcodes of the plugin
    new Shortcodes;

    // Register settings pages 
    add_action('init', function() { settings\register(); });
  }

  /**
   * Return the HTML for the log
   *
   * @return     string
   */
  public static function logo() {

    ob_start(); ?>
    <div class="ttge-logo">
      <img src="<?= LearnDashGroups_URL ?>assets/images/logo.png"/>
    </div><?php 
    
    return ob_get_clean();
  }

}

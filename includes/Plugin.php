<?php

namespace Tangible\LearnDashGroups;

defined( 'ABSPATH' ) or die( 'Nothing to see here' );

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

  }

}

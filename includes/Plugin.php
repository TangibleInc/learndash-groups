<?php

namespace Tangible\LearnDashGroups;

defined( 'ABSPATH' ) or die( 'Nothing to see here' );

/**
 * Global controller of the plugin
 */
Class Plugin
{

  /**
   * Constructor
   */
  public function __construct() {

    // include plugin's functions
    include __DIR__ . '/utils/index.php';

    // include third party plugin's related features
    include __DIR__ . '/extensions/index.php';

    // Initialize the tangible framework
    add_action( tangible_plugin_framework()->ready, [$this, 'init_framework'] );

    // Handle the group access logic
    new GroupAccess;

    // Handle the admin part of wordpress
    new Admin;

    // Register all the shortcodes of the plugin
    new Shortcodes;

    // Get the settings
    $this->settings = new Settings;

    // Register fileds
    $this->register_fields();
  }



  /**
   * Register all the fields of the plugin
   */
  private function register_fields() {

    add_action( 'init', function() {
      $this->settings->register_settings();
    } );
  }



  /**
   * Use the Tangible internal plugin (see documentation)
   */
  public function init_framework($framework) {

    $framework->register_plugin([

      // Required
      'name'            => 'ld-groups',
      'title'           => 'LearnDash Groups',
      'setting_prefix'  => 'ldg',
      'file_path'       => LearnDashGroups_FILE,
      'version'         => LearnDashGroups_VER,

      // Must match with a product in the Tangible Plugins store
      'item_id' => 4945,

      // Plugin dependencies
      'dependencies'     => [
        'sfwd-lms/sfwd_lms.php' => [
            'title' => 'LearnDash',
            'fallback_check' => function() {
              return defined( 'LEARNDASH_VERSION' );
            }
        ],
      ],

      // Settings page CSS/JS
      'settings_css'  => plugins_url( 'settings/style.css', LearnDashGroups_VER ),
      'settings_js'   => plugins_url( 'settings/script.js', LearnDashGroups_VER ),

      // Tabs in settings page
      'setting_tabs' => [
        'settings' => [
          'title' => __( 'Settings', 'ld-groups' ),
          'callback' => function () {
            $this->settings->get_view();
          },
        ],
      ],
    ]);

  }

}

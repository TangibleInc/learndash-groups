<?php
/**
 * Plugin Name: Groups Extended for LearnDash
 * Plugin URI: https://tangibleplugins.com
 * Description: Groups Extended for LearnDash is a free plugin developed by TangiblePlugins that allows you to display a group page only to users in the group, providing a space to  display group-related content.
 * Version: 0.0.3
 * Author: Team Tangible
 * Author URI: https://teamtangible.com/
 * Text Domain: ld-groups
 * Domain Path: /languages
 * License: GPLv2 or later
 */


defined( 'ABSPATH' ) or die( 'Nothing to see here' );

define( 'LearnDashGroups_VER', '0.0.3' );
define( 'LearnDashGroups_FILE', __FILE__ );
define( 'LearnDashGroups_DIR', plugin_dir_path( __FILE__ ) );
define( 'LearnDashGroups_URL', plugins_url( '/', __FILE__ ) );
define( 'LearnDashGroups_PATH', plugin_basename( __FILE__ ) );

// Dependencies
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/vendor/tangible/plugin-framework/index.php';

use Tangible\LearnDashGroups\Plugin;

class LearnDashGroups {

  use TangibleObject;

  public $name  = 'ttlg';
  public $state = [];

  function __construct() {
    
    require_once LearnDashGroups_DIR . 'includes/utils/index.php';
    require_once LearnDashGroups_DIR . 'includes/extensions/index.php';
    require_once LearnDashGroups_DIR . 'includes/modules/index.php';

    add_action( tangible_plugin_framework()->ready, [$this, 'register'] );
    new Plugin();
  }

  /**
   * Register the plugin into the framework
   * 
   * @see https://docs.tangible.one/modules/plugin-framework/
   *
   * @param      object  $framework  The framework
   */
  function register( $framework ) {

    $this->plugin = $framework
      ->register_plugin([
        'name'            => 'learndash-groups',
        'title'           => 'Groups Extended for LearnDash',
        'setting_prefix'  => 'ttlg',
        'file_path'       => LearnDashGroups_FILE,
        'version'         => LearnDashGroups_VER,
        'item_id'         => 9557,
        'multisite'       => false,

        // Display plugins logo into the settings
        'settings_title_callback' => function( $plugin ) {
          echo Plugin::logo();
          echo $plugin['title'];
        }
      ])

      /**
       * For now, dependencies for LD, but needs to be removed in the future if we support other LMS
       */
      ->register_dependencies([
       'sfwd-lms/sfwd_lms.php' => [
          'title' => 'LearnDash',
          'fallback_check' => function() { return defined('LEARNDASH_VERSION'); }
        ],
      ]);

      $this->framework = $framework;
  }
}

/**
 * Get plugin instance
 */
function tangible_lg() {
  static $o;
  if ( $o ) return $o;
  return $o = new LearnDashGroups();
}

tangible_lg();

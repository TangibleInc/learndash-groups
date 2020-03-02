<?php
/**
 * Plugin Name: LearnDash Groups
 * Plugin URI: https://tangibleplugins.com
 * Description: Allow the use of Beaver Themer with LearnDash Student Groups and create pictures / banners fields connections for each student groups
 * Version: 0.0.1
 * Author: Team Tangible
 * Author URI: https://teamtangible.com/
 * Text Domain: ld-groups
 * Domain Path: /languages
 * License: GPLv2 or later
 */


defined( 'ABSPATH' ) or die( 'Nothing to see here' );

define( 'LearnDashGroups_VER', '0.0.1' );
define( 'LearnDashGroups_FILE', __FILE__ );
define( 'LearnDashGroups_DIR', plugin_dir_path( __FILE__ ) );
define( 'LearnDashGroups_URL', plugins_url( '/', __FILE__ ) );
define( 'LearnDashGroups_PATH', plugin_basename( __FILE__ ) );

// Dependencies
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/vendor/tangible/plugin-framework/index.php';

use Tangible\LearnDashGroups\Plugin;
use Tangible\LearnDashGroups\Modules\Settings as settings;

class LearnDashGroups {

  use TangibleObject;

  public $name  = 'ttsc';
  public $state = [];

  function __construct() {
    
    require_once LearnDashGroups_DIR . 'includes/utils/index.php';
    require_once LearnDashGroups_DIR . 'includes/extensions/index.php';

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
        'name'           => 'ld-groups',
        'title'          => 'LearnDash Groups',
        'setting_prefix' => 'ttlg',
        'file_path'      => LearnDashGroups_FILE,
        'version'        => LearnDashGroups_VER,
        'item_id'        => 4945,
        'multisite'       => false,
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

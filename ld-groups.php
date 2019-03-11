<?php
/**
 * Plugin Name: Tangible Groups for LearnDash
 * Plugin URI: https://tangibleplugins.com
 * Description: Internal Plugin. Allow us to use Beaver Themer with the Student Group post type
 * Version: 0.0.0
 * Author: Team Tangible
 * Author URI: https://teamtangible.com/
 * Text Domain: ld-groups
 * Domain Path: /languages
 * License: GPLv2 or later
 */


defined( 'ABSPATH' ) or die( 'Nothing to see here' );


define( 'TangibleGroups_VER', '0.0.0' );
define( 'TangibleGroups_FILE', __FILE__ );
define( 'TangibleGroups_DIR', plugin_dir_path( __FILE__ ) );
define( 'TangibleGroups_URL', plugins_url( '/', __FILE__ ) );
define( 'TangibleGroups_PATH', plugin_basename( __FILE__ ) );


// Composer
require_once __DIR__ . '/vendor/autoload.php';

use Tangible\LDGroups\Plugin;

new Plugin();
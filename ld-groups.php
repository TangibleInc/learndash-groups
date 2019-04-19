<?php
/**
 * Plugin Name: LearnDash Groups
 * Plugin URI: https://tangibleplugins.com
 * Description: Allow us to use Beaver Themer with the Student Group post type and add a picture and a banner field connection for student group
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

// Internal framework
require_once __DIR__ . '/vendor/tangible/plugin-framework/index.php';


use Tangible\LDGroups\Plugin;

new Plugin();
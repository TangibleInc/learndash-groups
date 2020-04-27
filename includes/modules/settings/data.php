<?php

namespace Tangible\LearnDashGroups\Modules\Settings;

defined( 'ABSPATH' ) or die( 'Nothing to see here' );

use Tangible\LearnDashGroups\Modules\Settings as settings;

/**
 * The default value of some settings, if none set
 */
function default_values() {
  return [
    'redirect-type' => '404'
  ];
}

/**
 * Get the data from the framework
 *
 * @return     array
 */
function data() {
  static $settings;
  if( $settings ) return $settings;
  return $settings = \tangible_lg()->plugin->get_settings();
}

/**
 * Get the setting key from the framework
 *
 * @return     string
 */
function key() {
  static $key;
  if( $key ) return $key;
  return $key = \tangible_lg()->plugin->get_settings_key();
}

/**
 * Gets the value of a setting
 *
 * @param      string  $name   The name
 */
function get( string $name ) {
  
  $value = isset(settings\data()[$name]) ? settings\data()[$name] : false;

  // If no value set and if there is a default value
  if( $value === false && isset(settings\default_values()[$name]) ) return settings\default_values()[$name]; 
  return $value;
}

/**
 * Helper for checking value from checkbox (it's false or true, but as string
 * so we will return a boolean with this function)
 *
 * @param      string  $name   The name
 * 
 * @return     boolean   
 */
function get_boolean( string $name ) {
  $value = get( $name );
  return $value === 'true' ? true : false; 
}

/**
 * Get the complete key of the setting (used for saving it)
 *
 * @param      string  $name   The name
 *
 * @return     string
 */
function field_name( string $name ) {
  return settings\key() . '[' . $name . ']';
}

/**
 * Update setting
 *
 * @param      string  $name   The name
 * @param      string  $value  The value
 */
function update( string $name, string $value ) {
  \tangible_lg()->plugin->update_settings([$name => $value]);
}

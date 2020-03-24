<?php

defined( 'ABSPATH' ) or die( 'Nothing to see here' );

/**
 * Register feature which needs a third party plugin for working
 *
 * Folder are named after the extension folder name
 */

if ( defined( 'FL_THEME_BUILDER_VERSION' ) ) {
  require_once __DIR__ . '/bb-theme-builder/index.php';
}

if ( defined( 'ELEMENTOR_VERSION' ) ) {
  require_once __DIR__ . '/elementor/index.php';
}


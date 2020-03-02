<?php

namespace Tangible\LearnDashGroups\Extensions;

defined( 'ABSPATH' ) or die( 'Nothing to see here' );

add_action( 'init', function() {

  /**
   * If beaver themer is installed but not beaver builder
   */
  if ( class_exists( '\FLBuilder' ) ) {

    require_once __DIR__ . '/FieldConnections.php';
    new FieldConnections;
  }

});


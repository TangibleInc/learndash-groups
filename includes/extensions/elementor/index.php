<?php

namespace Tangible\LearnDashGroups\Extensions\Elementor;

defined( 'ABSPATH' ) or die( 'Nothing to see here' );

/**
 * Register dynamic tags
 */
add_action( 'elementor/dynamic_tags/register_tags', function( $dynamic_tags ) {

  \Elementor\Plugin::$instance->dynamic_tags->register_group( 'ld-groups', [
    'title' => 'Groups Extended for LearnDash' 
  ]);

  require_once __DIR__ . '/dynamic-tags/Banner.php';
  require_once __DIR__ . '/dynamic-tags/Picture.php';

  $dynamic_tags->register_tag( __NAMESPACE__ . '\Picture' );
  $dynamic_tags->register_tag( __NAMESPACE__ . '\Banner' );
  
});


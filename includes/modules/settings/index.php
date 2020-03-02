<?php

namespace Tangible\LearnDashGroups\Modules\Settings;

defined( 'ABSPATH' ) or die( 'Nothing to see here' );

use Tangible\LearnDashGroups\Modules\Settings as settings;

// Functions for managing settings value
require_once __DIR__ . '/data.php';

/**
 * Register the setting pages into the back office
 * 
 * @see https://docs.tangible.one/modules/plugin-framework/plugin-settings/ 
 */
function register() {

  \tangible_lg()->plugin->register_settings([
    'tabs' => [
      'settings' => [ 
        'title' => __( 'Settings', 'ld-groups' ),
        'callback' => function () {
          
          ob_start();
          require_once LearnDashGroups_DIR . 'includes/views/admin/settings.php';
          echo ob_get_clean();
        },
      ],
      'documentation' => [
        'title' => __( 'Documentation', 'ld-groups' ),
        'callback' => function() {
          $markdown_doc = file_get_contents( LearnDashGroups_DIR . '/docs/index.md' );;
          echo \Parsedown::instance()->text($markdown_doc);
        }
      ],
    ]
  ]);
}

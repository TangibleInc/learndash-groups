<?php

namespace Tangible\LearnDashGroups\Extensions;

defined( 'ABSPATH' ) or die( 'Nothing to see here' );


/**
 * This class register field connections for Beaver Themer
 * 
 * https://www.wpbeaverbuilder.com/beaver-themer/
 */
class FieldConnections {

  /**
   * Constructor
   */
  public function __construct() {
    
    $this->register_fields_connection(); 
  }

  /**
   * Register field connexion for beaver themer
   * 
   * @return void
   */
  private function register_fields_connection() {

    add_action('fl_page_data_add_properties', function () {

      \FLPageData::add_group( 'ld-groups', array(
        'label' => 'LearnDash: Groups'
      )); 

      \FLPageData::add_post_property( 'ld-groups_picture', array(
        'label'   => __( 'Picture', 'ld-groups' ),
        'group'   => 'ld-groups',
        'type'    => 'photo',
        'getter'  => 'Tangible\LearnDashGroups\Utils\get_group_picture'
      ));

      \FLPageData::add_post_property( 'ld-groups_banner', array(
        'label'   => __( 'Banner', 'ld-groups' ),
        'group'   => 'ld-groups',
        'type'    => 'photo',
        'getter'  => 'Tangible\LearnDashGroups\Utils\get_group_banner'
      ));

    }, 1);

  }

}


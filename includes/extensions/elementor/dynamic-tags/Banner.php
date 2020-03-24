<?php

namespace Tangible\LearnDashGroups\Extensions\Elementor;

defined( 'ABSPATH' ) or die();

use Tangible\LearnDashGroups\Utils as utils;

/**
 * @see https://developers.elementor.com/dynamic-tags/
 */
class Banner extends \Elementor\Core\DynamicTags\Data_Tag {
  

  /**
   * Slug of the dynamic tag
   * 
   * @return string
   */
  public function get_name() {
    return 'ldg-banner';
  }


  /**
   * Title of the dynamic tag
   *  
   * @return string
   */
  public function get_title() {
    return __( 'Banner', 'lifter-elements' );
  }


  /**
   * @see https://developers.elementor.com/dynamic-tags/
   * 
   * @return string
   */
  public function get_group() {
    return 'ld-groups';
  }


  /**
   * @see https://developers.elementor.com/dynamic-tags/
   * 
   * @return array
   */
  public function get_categories() {
    return array( \Elementor\Modules\DynamicTags\Module::IMAGE_CATEGORY );
  }


  /**
   * @see https://developers.elementor.com/elementor-controls/
   */
  protected function _register_controls() {}


  /**
   * Output result
   * 
   * @return string
   */
  public function get_value( array $options = [] ) {
    return [
      'id'  => utils\get_group_banner_id(),
      'url' => utils\get_group_banner(),
    ];
  }
}

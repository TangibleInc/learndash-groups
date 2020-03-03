<?php

namespace Tangible\LearnDashGroups;

defined( 'ABSPATH' ) or die( 'Nothing to see here' );

use Tangible\LearnDashGroups\Utils as utils;

class StudentGroup {


  /**
   * Construct
   */
  public function __construct( $id ) {

    $this->id = (int) $id;
  }

  /**
   * Update a group level setting
   *
   * @param  string $key      This can be : comment, global, studentpost or moderate
   * @param  string $value
   */
  public function update_settings( $key, $value ) {

    if ( get_post_meta( $this->id, 'ttlg-' . $key . '-settings', false ) ) {
        update_post_meta( $this->id, 'ttlg-' . $key . '-settings', $value );
    } else {
        add_post_meta( $this->id, 'ttlg-' . $key . '-settings', $value, true );
    }
  }

  /**
   * Return a setting
   *
   * @param  string $key      This can be : comment, global, studentpost or moderate
   *
   * @return bool
   */
  public function get_setting( $key ) {

    $settings = get_post_meta( $this->id, 'ttlg-' . $key . '-settings', true );

    // Picture and banner aren't boolean
    if ( $key === 'picture' || $key === 'banner' ) $settings = (int) $settings;

    return $settings;
  }

  /**
   * Save a picture (if exist in the $_FILES array) and add a post
   * meta to the group with the link of the picture
   */
  public function save_picture() {

    if ( empty($_FILES['ttlg-metabox-file-picture']) ) return;
    if ( $_FILES['ttlg-metabox-file-picture']['size'] === 0 ) return;

    $picture_id = utils\save_image( 'ttlg-metabox-file-picture' );
    $this->update_settings( 'picture', $picture_id );
  }

  /**
   * Return the link of the picture set for the student group
   *
   * @return string   url
   */
  public function get_picture_link() {

    $attachment_id = $this->get_setting( 'picture' );
    return $attachment_id ? wp_get_attachment_url( $attachment_id ) : false;
  }

  /**
   * Save the banner (if exist in the $_FILES array) and add a post
   * meta to the group with the link of the banner
   */
  public function save_banner() {

    if ( empty($_FILES['ttlg-metabox-file-banner']) ) return;
    if ( $_FILES['ttlg-metabox-file-banner']['size'] === 0 ) return;

    $picture_id = utils\save_image( 'ttlg-metabox-file-banner' );
    $this->update_settings( 'banner', $picture_id );
  }

  /**
   * Return the link of the picture set for the student group
   *
   * @return string   url
   */
  public function get_banner_link() {

    $attachment_id = $this->get_setting( 'banner' );
    return $attachment_id ? wp_get_attachment_url( $attachment_id ) : false;
  }

  /**
   * HTML of the picture using the wordpress function (better for the accessibility)
   *
   * @return     string  (html)
   */
  public function get_picture() {
    $attachment_id = $this->get_setting( 'picture' );
    return wp_get_attachment_image( $attachment_id, 'full', false, ['class' => 'ttlg-group-picture'] );
  }

  /**
   * HTML of the banner using the wordpress function (better for the accessibility)
   *
   * @return     string  (html)
   */
  public function get_banner() {
    $attachment_id = $this->get_setting( 'banner' );
    return wp_get_attachment_image( $attachment_id, 'full', false, ['class' => 'ttlg-group-banner'] );
  }
}

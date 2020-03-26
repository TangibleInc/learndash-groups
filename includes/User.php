<?php

namespace Tangible\LearnDashGroups;

defined( 'ABSPATH' ) or die( 'Nothing to see here' );

/**
 * User model
 */
class User {

  /**
   * Construct
   *
   * @param int $id
   */
  public function __construct( $user_id = false ) {
    $this->id = $user_id === false ? get_current_user_id() : (int) $user_id;
  }

  /**
   * Return the display name of the user
   *
   * @return string
   */
  public function get_name() {
    $user_info = get_userdata( $this->id );
    return $user_info->display_name;
  }

  /**
   * Return the url of the user avatar (from gravatar)
   *
   * @return string url
   */
  public function get_picture() {

    // $avatar = get_avatar_url( $this->id );
    
    // Some plugin are not compatible with the get_avatar_url function, so we use another method
    preg_match("/src='(.*?)'/i", get_avatar( $this->id, 150 ), $matches); 
    if( empty($matches) ) preg_match('/src="(.*?)"/i', get_avatar( $this->id, 150 ), $matches);
    
    return $matches[1];
  }

  /**
   * Return true if the user has the group leader role
   *
   * @return boolean
   */
  public function is_group_leader() {
    return in_array( 'group_leader', wp_get_current_user()->roles );
  }

  /**
   * Return true if the user has the administrator
   *
   * @return boolean
   */
  public function is_administrator() {
    return in_array( 'administrator', wp_get_current_user()->roles );
  }

  /**
   * Return true is the user is a student of this group, if he is
   * a group leader of this group or if he is an administrator
   *
   * @param  int  $group_id
   *
   * @return boolean
   */
  public function is_in_group( $group_id ) {

    // Administrator can see al the student groups
    if ( $this->is_administrator() ) return true;

    $group_id = (int) $group_id;

      // If the user is group leader, we check if he is a group leader of the student group
    if ( $this->is_group_leader() ) {
      $user_groups = (array) learndash_get_administrators_group_ids( $this->id );
      if ( ! empty( $user_groups ) && in_array( $group_id, $user_groups ) ) return true;
    }

    // We check the user is a member of the given student group
    $student_groups = (array) learndash_get_users_group_ids( $this->id );
    if ( ! empty( $student_groups ) && in_array( $group_id, $student_groups ) ) return true;

    return false;
  }


}

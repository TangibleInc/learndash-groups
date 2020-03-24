<?php

namespace Tangible\LearnDashGroups\Utils;

defined( 'ABSPATH' ) or die( 'Nothing to see here' );

use Tangible\LearnDashGroups\Utils as utils;
use Tangible\LearnDashGroups\StudentGroup;


/**
 * If the current object is a post and the postype of this
 * post is a LearnDash student group, we return the url of
 * the picture (if any)
 * 
 * @return string url
 */
function get_group_picture() {

  if( !get_queried_object() ) return false;

  $post = get_queried_object();

  if( property_exists( $post, 'post_type' ) && $post->post_type === 'groups' ) {

    $group = new StudentGroup( $post->ID );
    $link = $group->get_picture_link();

    return $link;
  }
  return false;
}


/**
 * If the current object is a post and the postype of this
 * post is a LearnDash student group, we return the url of
 * the picture (if any)
 * 
 * @return string url
 */
function get_group_picture_id() {

  if( !get_queried_object() ) return false;

  $post = get_queried_object();

  if( property_exists( $post, 'post_type' ) && $post->post_type === 'groups' ) {

    $group = new StudentGroup( $post->ID );
    $link = $group->get_picture_id();

    return $link;
  }
  return false;
}


/**
 * If the current object is a post and the postype of this
 * post is a LearnDash student group, we return the url of
 * the banner (if any)
 * 
 * @return string url
 */
function get_group_banner() {

  if( !get_queried_object() ) return false;

  $post = get_queried_object();

  if( property_exists( $post, 'post_type' ) && $post->post_type === 'groups' ) {

    $group = new StudentGroup( $post->ID );
    $link = $group->get_banner_link();

    return $link;
  }
  return false;
}


/**
 * If the current object is a post and the postype of this
 * post is a LearnDash student group, we return the url of
 * the banner (if any)
 * 
 * @return string url
 */
function get_group_banner_id() {

  if( !get_queried_object() ) return false;

  $post = get_queried_object();

  if( property_exists( $post, 'post_type' ) && $post->post_type === 'groups' ) {

    $group = new StudentGroup( $post->ID );
    $link = $group->get_banner_id();

    return $link;
  }
  return false;
}

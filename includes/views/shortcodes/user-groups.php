<?php defined( 'ABSPATH' ) or die( 'Nothing to see here' ); ?>

<section class="ttge-groups-list">
  <?php foreach( $groups as $group ): ?>

    <div class="ttge-groups-list-item post-<?= $group->id ?> groups type-groups status-<?= get_post_status( $group->id ) ?>">
      <a href="<?= get_the_permalink( $group->id ); ?>">
        <div class="ttge-groups-list-item-inner">
          <div class="ttge-groups-list-item-title">
            <?php if($group -> get_picture_link()) {?>
              <img class="ttge-groups-list-item-image" src="<?= $group -> get_picture_link() ?>"/>
            <?php } ?>
            <div class="ttge-groups-list-item-title-text"><?= get_the_title( $group->id ); ?></div>
          </div>
          <div class="ttge-groups-list-item-leaders">
            <?php if( !empty($group->get_group_leaders()) ): ?>
              <span><?= count($group->get_group_leaders()) > 1 ? __( 'Leaders', 'ld-groups' ) : __( 'Leader', 'ld-groups' ) ?></span>
              <ul>
                <?php foreach( $group->get_group_leaders() as $leader ): ?>
                  <li><img title="<?= $leader->get_name() ?>" alt="<?= $leader->get_name() ?>" src="<?= $leader->get_picture() ?>"/></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </div>
        </div>
      </a>
    </div>
  <?php endforeach; ?>
</section>

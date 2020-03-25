<?php defined( 'ABSPATH' ) or die( 'Nothing to see here' ); ?>  

<?php wp_nonce_field( 'save_post', 'ld-group-pictures' ); ?>

<section class='ttge-metabox'>
  <div>
    <label><?= __( 'Profile photo:', 'ld-groups' ); ?></label>
    <label style="background-image: url(<?= $group->get_picture_link(); ?>)" id='ttge-metabox-picture' class='ttge-metabox-file' for="ttge-metabox-file-picture">
      <span>
        <span class="button-secondary">
          <?= __( 'Choose file to upload', 'ld-groups' ); ?>    
        </span>
        <label 
          id="ttge-remove-file-picture" 
          for="ttge-remove-file-picture" 
          class="button-secondary" 
          style="<?= empty($group->get_picture_link()) ? 'display: none' : '';  ?>"
        >
          <?= __( 'Remove file', 'ld-groups' ); ?>    
          <input type="checkbox" name="ttge-remove-file-picture" />
        </label>
      </span>
    </label>
    <input type="file" id="ttge-metabox-file-picture" name="ttge-metabox-file-picture" />
  </div>

  <div style='flex-direction: column'>
    <label><?= __( 'Cover photo:', 'ld-groups' ); ?></label>
    <label style="background-image: url(<?= $group->get_banner_link(); ?>)" id='ttge-metabox-banner' class='ttge-metabox-file ttge-metabox-file-cover' for="ttge-metabox-file-banner">
      <span>
        <span class="button-secondary">
          <?= __( 'Choose file to upload', 'ld-groups' ); ?>    
        </span>
        <label 
          id="ttge-remove-file-banner" 
          for="ttge-remove-file-banner" 
          class="button-secondary" 
          style="<?= empty($group->get_banner_link()) ? 'display: none' : '';  ?>"
        >
          <?= __( 'Remove file', 'ld-groups' ); ?>    
          <input type="checkbox" name="ttge-remove-file-banner" />
        </label>
      </span>
    </label>
    <input type="file" id="ttge-metabox-file-banner" name="ttge-metabox-file-banner" />
  </div>
</section>

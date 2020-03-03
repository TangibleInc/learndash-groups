<?php defined( 'ABSPATH' ) or die( 'Nothing to see here' ); ?>  

<?php wp_nonce_field( 'save_post', 'ld-group-pictures' ); ?>

<section class='ttlg-metabox'>
  <div>
    <label><?= __( 'Profile photo:', 'ld-groups' ); ?></label>
    <label style="background-image: url(<?= $group->get_picture_link(); ?>)" id='ttlg-metabox-picture' class='ttlg-metabox-file' for="ttlg-metabox-file-picture">
      <span>
        <span class="button-secondary">
          <?= __( 'Choose file to upload', 'ld-groups' ); ?>    
        </span>
        <label 
          id="ttlg-remove-file-picture" 
          for="ttlg-remove-file-picture" 
          class="button-secondary" 
          style="<?= empty($group->get_picture_link()) ? 'display: none' : '';  ?>"
        >
          <?= __( 'Remove file', 'ld-groups' ); ?>    
          <input type="checkbox" name="ttlg-remove-file-picture" />
        </label>
      </span>
    </label>
    <input type="file" id="ttlg-metabox-file-picture" name="ttlg-metabox-file-picture" />
  </div>

  <div style='flex-direction: column'>
    <label><?= __( 'Cover photo:', 'ld-groups' ); ?></label>
    <label style="background-image: url(<?= $group->get_banner_link(); ?>)" id='ttlg-metabox-banner' class='ttlg-metabox-file ttlg-metabox-file-cover' for="ttlg-metabox-file-banner">
      <span>
        <span class="button-secondary">
          <?= __( 'Choose file to upload', 'ld-groups' ); ?>    
        </span>
        <label 
          id="ttlg-remove-file-banner" 
          for="ttlg-remove-file-banner" 
          class="button-secondary" 
          style="<?= empty($group->get_banner_link()) ? 'display: none' : '';  ?>"
        >
          <?= __( 'Remove file', 'ld-groups' ); ?>    
          <input type="checkbox" name="ttlg-remove-file-banner" />
        </label>
      </span>
    </label>
    <input type="file" id="ttlg-metabox-file-banner" name="ttlg-metabox-file-banner" />
  </div>
</section>

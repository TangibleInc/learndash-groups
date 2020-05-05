<?php defined( 'ABSPATH' ) or die( 'Nothing to see here' ); ?>

<div id="ttlg-default-group-images" class="ttlg-default-group-images">
	<h4><?php echo $label ?> </h4>
	<div id="ttlg-image-preview-wrapper-<?php echo $type ?>" class="ttlg-image-preview-wrapper type-<?php echo $type ?>"  style=" background-image:url('<?php echo wp_get_attachment_url($value) ?>'); background-size:cover; ">
		<div class="ttlg-buttons-wrapper">
			<input id="ttlg-upload-file-image-<?php echo $type ?>" type="button" class="button-secondary ttlg-upload-file-image <?php echo $has_image ?>" value="<?php echo __( 'Choose file to upload', 'ld-groups' ); ?>" />
			<input id="ttlg-remove-file-image-<?php echo $type ?>" type="button" class="button-secondary ttlg-remove-file-image <?php echo $has_image ?>" value="<?php echo __( 'Remove file', 'ld-groups' ); ?>" />
		</div>
		<input type="hidden" id="ttlg-settings-default-<?php echo $type ?>" class="ttlg-settings-default" name="<?php echo $name ?>"  value="<?php echo $value ?>">
	</div>
</div>

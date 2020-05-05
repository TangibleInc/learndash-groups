<?php defined( 'ABSPATH' ) or die( 'Nothing to see here' ); ?>

<div id="ttge-default-group-images" class="ttge-default-group-images">
	<h4><?php echo $label ?> </h4>
	<div id="ttge-image-preview-wrapper-<?php echo $type ?>" class="ttge-image-preview-wrapper type-<?php echo $type ?>"  style=" background-image:url('<?php echo wp_get_attachment_url($value) ?>'); background-size:cover; ">
		<div class="ttge-buttons-wrapper">
			<input id="ttge-upload-file-image-<?php echo $type ?>" type="button" class="button-secondary ttge-upload-file-image <?php echo $has_image ?>" value="<?php echo __( 'Choose file to upload', 'ld-groups' ); ?>" />
			<input id="ttge-remove-file-image-<?php echo $type ?>" type="button" class="button-secondary ttge-remove-file-image <?php echo $has_image ?>" value="<?php echo __( 'Remove file', 'ld-groups' ); ?>" />
		</div>
		<input type="hidden" id="ttge-settings-default-<?php echo $type ?>" class="ttge-settings-default" name="<?php echo $name ?>"  value="<?php echo $value ?>">
	</div>
</div>

<?php defined( 'ABSPATH' ) or die( 'Nothing to see here' ); ?>	

<?php wp_nonce_field( 'save_post', 'ld-group-pictures' ); ?>

<section class='ttsg_metabox'>
	<div>
		<label><?= __( 'Student group picture :', 'ld-groupposts' ); ?></label>
		<label style="background-image: url(<?= $group->get_picture_link(); ?>)" id='ttsg_metabox-picture' class='ttsg_metabox-file' for="ttsg_metabox-file-picture">
			<p><?= __( 'Choose file to upload', 'ld-groupposts' ); ?></p>
		</label>
		<input type="file" id="ttsg_metabox-file-picture" name="ttsg_metabox-file-picture" />
	</div>

	<div class="tangible_notif-comment" style='flex-direction: column'>
		<label><?= __( 'Cover picture :', 'ld-groupposts' ); ?></label>
		<label style="background-image: url(<?= $group->get_banner_link(); ?>)" id='ttsg_metabox-banner' class='ttsg_metabox-file ttsg_metabox-file-cover' for="ttsg_metabox-file-banner">
			<p><?= __( 'Choose file to upload', 'ld-groupposts' ); ?></p>
		</label>
		<input type="file" id="ttsg_metabox-file-banner" name="ttsg_metabox-file-banner" />
	</div>
</section>

<?php defined( 'ABSPATH' ) or die( 'Nothing to see here' ); ?>	

<?php wp_nonce_field( 'save_post', 'ld-group-pictures' ); ?>

<section class='ttlg-metabox'>
	<div>
		<label><?= __( 'Student group picture :', 'ld-groups' ); ?></label>
		<label style="background-image: url(<?= $group->get_picture_link(); ?>)" id='ttlg-metabox-picture' class='ttlg-metabox-file' for="ttlg-metabox-file-picture">
			<p><?= __( 'Choose file to upload', 'ld-groups' ); ?></p>
		</label>
		<input type="file" id="ttlg-metabox-file-picture" name="ttlg-metabox-file-picture" />
	</div>

	<div class="tangible_notif-comment" style='flex-direction: column'>
		<label><?= __( 'Cover picture :', 'ld-groups' ); ?></label>
		<label style="background-image: url(<?= $group->get_banner_link(); ?>)" id='ttlg-metabox-banner' class='ttlg-metabox-file ttlg-metabox-file-cover' for="ttlg-metabox-file-banner">
			<p><?= __( 'Choose file to upload', 'ld-groups' ); ?></p>
		</label>
		<input type="file" id="ttlg-metabox-file-banner" name="ttlg-metabox-file-banner" />
	</div>
</section>

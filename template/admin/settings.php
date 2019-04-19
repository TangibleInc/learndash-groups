<?php defined( 'ABSPATH' ) or die( 'Nothing to see here' ); ?>

<div class="tangible-plugin-settings-tab-license">
    
    <h3><?= __( 'Settings', 'ld-groups' ); ?></h3>
	
	<?php settings_fields( 'ldg-settings' ); ?>
    
    <div class="setting-row">
        <label for="ldg-redirection-type">
			<p style="margin:0;"><?= __( 'Defined the comportement if the user is not allowed to access to the group', 'ld-groups' ); ?></p>		
		</label>
        <select name="ldg-redirection-type" id="ldg-redirection-type" class="postform">
			<option <?= $restriction === '404' ? 'selected' : ''; ?> class="level-0" value="404">
				<?= __( 'Redirect to the 404 page', 'ld-groups' ); ?>
			</option>
			<option <?= $restriction === 'home' ? 'selected' : ''; ?> class="level-0" value="home">
				<?= __( 'Redirect to the home page', 'ld-groups' ); ?>		
			</option>
		</select>
    </div>

    <div class="setting-row">
		<?php submit_button(); ?>
	</div>	

</div>
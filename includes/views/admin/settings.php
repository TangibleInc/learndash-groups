<?php defined( 'ABSPATH' ) or die( 'Nothing to see here' ); 

use Tangible\LearnDashGroups\Modules\Settings as settings;

$redirect_type = settings\get('redirect-type');
$redirect_field_name = settings\field_name('redirect-type');
?>

<div class="tangible-plugin-settings-tab-license">
    
  <h3><?= __( 'Settings', 'ld-groups' ); ?></h3>
    
  <div class="setting-row">
    <label for="<?= $redirect_field_name ?>">
      <p style="margin:0;"><?= __( 'Defines the behaviour if the user isn’t allowed to access the group.', 'ld-groups' ); ?></p>    
    </label>
    <select name="<?= $redirect_field_name ?>" id="<?= $redirect_field_name ?>" class="postform">
        <option <?= $redirect_type === '404' ? 'selected' : ''; ?> class="level-0" value="404">
            <?= __( 'Redirect to the 404 page', 'ld-groups' ); ?>
        </option>
        <option <?= $redirect_type === 'home' ? 'selected' : ''; ?> class="level-0" value="home">
            <?= __( 'Redirect to the home page', 'ld-groups' ); ?>      
        </option>
     </select>
  </div>

  <div class="setting-row">
    <?php submit_button(); ?>
  </div>  

</div>

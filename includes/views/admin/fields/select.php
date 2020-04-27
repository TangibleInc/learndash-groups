<?php defined( 'ABSPATH' ) or die( 'Nothing to see here' ); ?>

<div class="setting-row ttge-setting-row">
  <label for="<?= $name ?>">
    <p style="margin:0;"><?= $label ?></p>    
  </label>
  <select name="<?= $name ?>" id="<?= $name ?>" class="postform">
    <?php foreach( $options as $key => $option ): ?>
      <option <?= $value === $key ? 'selected' : ''; ?> class="level-0" value="<?= $key ?>">
        <?= $option ?>
      </option>
    <?php endforeach; ?>
  </select>
</div>

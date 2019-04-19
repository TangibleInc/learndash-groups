<?php defined( 'ABSPATH' ) or die( 'Nothing to see here' ); ?>

<table class="form-table">
	<tbody>
		<tr>
			<th scope="row">
				<label for="ld-groups-redirection-type">
					<?= __( 'Defined the comportement if the user is not allowed to access to the group', 'ld-groups' ); ?>		
				</label>
			</th>
			<td>
				<select name="ld-groups-redirection-type" id="ldg-redirection-type" class="postform">
					<option <?= $restriction === '404' ? 'selected' : ''; ?> class="level-0" value="404">
						<?= __( 'Redirect to the 404 page', 'ld-groups' ); ?>
					</option>
					<option <?= $restriction === 'home' ? 'selected' : ''; ?> class="level-0" value="home">
						<?= __( 'Redirect to the home page', 'ld-groups' ); ?>		
					</option>
				</select>
			</td>
		</tr>
	</tbody>
</table>


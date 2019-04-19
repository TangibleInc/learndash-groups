<?php 

namespace Tangible\LDGroups;

defined( 'ABSPATH' ) or die( 'Nothing to see here' );

use Tangible\LDGroups\User;
use Tangible\LDGroups\Settings;
use Tangible\PluginFramework;


/**
 * Global controller of the plugin
 */
Class Plugin
{

	/**
	 * Constructor
	 */
	public function __construct() {

		// include plugin's functions
		include __DIR__ . '/functions/index.php';

		// Initialize the tangible framework
		$this->init_framework();

		// Handle the group access logic
		new GroupAccess();
		
		// Handle the admin part of wordpress
		new Admin();

		// Register field connections
		new FieldConnections();

		// Get the settings
		$this->settings = new Settings();

		// Register fileds
		$this->register_fields();
	}
	


	/**
	 * Register all the fields of the plugin
	 */
	private function register_fields() {

		add_action( 'init', function() {
			$this->settings->register_settings();
		} );
	}



	/**
	 * Use the Tangible internal plugin (see documentation)
	 */
	private function init_framework() {

		PluginFramework\register_plugin([

		  	// Required
		  	'name' 				=> 'ld-groups',
		  	'title' 			=> 'LearnDash Groups',
		  	'setting_prefix' 	=> 'ldg',
		  	'file_path' 		=> TangibleGroups_FILE,

		  	// Must match with a product in the Tangible Plugins store
		  	'item_id' 			=> 4945,
		  	'version' 			=> TangibleGroups_VER,

		  	// Plugin dependencies
		  	'dependencies' 		=> [
		    	'bb-plugin/fl-builder.php' => [
		      		'title' => 'Beaver Builder',
		      		'fallback_check' => function() { 
		      			return class_exists( 'FLBuilder' ); 
		      		}
		    	],
		    	'sfwd-lms/sfwd_lms.php' => [
		      		'title' => 'LearnDash',
		      		'fallback_check' => function() { 
		      			return defined( 'LEARNDASH_VERSION' ); 
		      		}
		    	],
			],
		  	'missing_dependencies_message' => function( $plugin, $missing_deps ) {

		    	?><p><b>Missing plugin dependencies for </b></p><?php

		    	foreach( $missing_deps as $dep ) {
		      	?><p><?= $dep['title'] ?></p><?php
		    	}
		  	},

		  	// Settings page CSS/JS
		  	'settings_css' 	=> plugins_url( 'settings/style.css', TangibleGroups_VER ),
		  	'settings_js' 	=> plugins_url( 'settings/script.js', TangibleGroups_VER ),

		  	// Title of settings page
		  	'settings_title_callback' => function( $plugin, $tabs, $active_tab ) {
		    	?><h2><?= $plugin['title'] ?></h2><?php
		  	},

		  	// Tabs in settings page
		  	'setting_tabs' => [
		    	'settings' => [
		      		'title' 	=> __( 'Settings', 'ld-groups' ),
		      		'callback' 	=> function () {
						$this->settings->get_view();
		      		},
		    	],
		  	],

		  	// Action links shown in admin plugin list
		  	'action_links' => [
		    	'<a href="" target="_blank">Support</a>'
		  	],

		  	// Admin notices - this also ensures support for multi-site
		  	'admin_notice' => function ($plugin) {

			    ?>
			    	<div class="notice notice-info is-dismissible">
			      		<p>Welcome to <?= $plugin['title'] ?>! Make sure to take a look at our list of recommended plugins.</p>
			      		<p><a href="<?= PluginFramework\get_settings_page_url($plugin, 'recommend') ?>">See our recommendations &raquo;</a></p>
			    	</div>
			    <?php

			    if (!PluginFramework\has_valid_license($plugin)) {
			    
			    	?>
			      		<div class="notice notice-error">
			        		<p>Please <a href="<?= PluginFramework\get_settings_page_url($plugin, 'license') ?>">enter your license key</a> to enable plugin updates for <?= $plugin['title'] ?>.</p>
			      		</div>
			      	<?php
			    }
		  	},
		]);

	}

}
<?php 

namespace Tangible\LDGroups;

defined( 'ABSPATH' ) or die( 'Nothing to see here' );

use Tangible\LDGroups\User;


/**
 * Settings page controller
 */
Class Settings
{


	/**
	 * Constructor
	 */
	public function __construct() {

		$this->add_menu();
		$this->register_settings(); 
	}



	/**
	 * Register the options for our settings 
	 */
	private function register_settings() {
		register_setting( 'ld-groups-settings', 'ld-groups-redirection-type' );
	}



	/**
	 * Add the settings page 
	 */
	private function add_menu() {
		
		add_action('admin_menu', function() {
		
			add_options_page('LearnDash Group Visibility', 'LearnDash Group Visibility', 'manage_options', 'ldgroupvisibility', array( $this, 'get_page' ) );
		
		} );
	}



	/**
	 * Get the settigns html
	 *  
	 * @return string
	 */
	public function get_page() {
		
		$restriction = get_option( 'ld-groups-redirection-type', true );

		ob_start();
		require TangibleGroups_DIR . 'template/admin/settings.php';
		$content = ob_get_clean();

		echo $content; 
	}
}
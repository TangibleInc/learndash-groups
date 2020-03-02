<?php 

namespace Tangible\LearnDashGroups;

defined( 'ABSPATH' ) or die( 'Nothing to see here' );

use Tangible\LearnDashGroups\User;


/**
 * Settings page controller
 */
Class Settings
{


	/**
	 * Constructor
	 */
	public function __construct() {

	}



	/**
	 * Register the settings options (call in the Plugin class)
	 */
	public function register_settings() {

 		register_setting( 'ldg-settings', 'ldg-redirection-type' );
	}



	/**
	 * Get the settigns html
	 *  
	 * @return string
	 */
	public function get_view() {
		
		$restriction = get_option( 'ldg-redirection-type', '404' );

		ob_start();
		require LearnDashGroups_DIR . 'includes/views/admin/settings.php';
		$content = ob_get_clean();

		echo $content; 
	}
}

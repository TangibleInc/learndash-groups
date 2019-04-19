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
 
	}



	/**
	 * Get the settigns html
	 *  
	 * @return string
	 */
	public function get_page() {
		
		$restriction = get_option( 'ldg-redirection-type', '404' );

		ob_start();
		require TangibleGroups_DIR . 'template/admin/settings.php';
		$content = ob_get_clean();

		echo $content; 
	}
}
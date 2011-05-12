<?php

/**
 * @pakage PiwikCounter
 */

/*
Plugin Name: PiwikCounter
Plugin URI: http://piwikcounter.rontu.de
Description: 
Version: 0.1
Author: Tobias Etzold
Email: tobias.etzold@googlemail.com
Author URI: http://blog.rontu.de
License: GPLv2 or later
*/

class PiwikCounterAdministration {

	function __construct()
	{
		add_action('admin_menu', array( &$this, 'getAdminMenu' ) );
	}

	public function getAdminMenu()
	{
		add_options_page('PiwikCounter Options', 'PiwikCounter', 'manage_options', 'piwik-counter-administration', array( &$this, 'getAdminOptions') );
	}
	
	public function getAdminOptions()
	{
		if (!current_user_can('manage_options'))
		{
			wp_die( __('You do not have sufficient permissions to access this page.') );
		}
	
		if( isset($_POST['unique_visitors']) ) {

			update_option( 'piwikcounter_piwik_url', $_POST[ 'piwik_url' ] );
			update_option( 'piwikcounter_site_id', $_POST[ 'site_id' ] );
			update_option( 'piwikcounter_auth_key', $_POST[ 'auth_key' ] );
			update_option( 'piwikcounter_start_date', $_POST[ 'start_date' ] );
			update_option( 'piwikcounter_unique_visitors', $_POST[ 'unique_visitors' ] );
			
			?>
			<div id="message" class="updated fade"><p><strong><?php _e('Options saved.') ?></strong></p></div>
			<?php

		}
				
		echo '<div class="wrap">';
		echo '<div id="icon-options-general" class="icon32"><br /></div>';
		echo "<h2>" . __( 'PiwikCounter Settings', 'PiwikCounter' ) . "</h2>";
		
		?>

		
		<form name="piwik_counter_administration" method="post" action="">
		
		<b>Piwik installation: </b><input type="text" name="piwik_url" value="<?php echo get_option('piwikcounter_piwik_url') ?>" /> (http://domain.tld)<br />
		<b>Site ID: </b><input type="text" name="site_id" value="<?php echo get_option('piwikcounter_site_id') ?>" /><br />
		<b>Authorisation Key: </b><input type="text" name="auth_key" value="<?php echo get_option('piwikcounter_auth_key') ?>" /><br />

		<b>Start Date: </b><input type="text" name="start_date" value="<?php echo get_option('piwikcounter_start_date') ?>" /> (YYYY-MM-DD)<br />

		<select name="unique_visitors">
			<option value="1" <?php if (get_option('piwikcounter_unique_visitors') == 1) { echo 'selected="selected"'; } ?>>unique visitors</option>
			<option value="0" <?php if (get_option('piwikcounter_unique_visitors') == 0) { echo 'selected="selected"'; } ?>>all visits</option>
		</select><br />

		<p><input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" /></p>

		</form>
		
		</div>
		<?php
	}

}

?>
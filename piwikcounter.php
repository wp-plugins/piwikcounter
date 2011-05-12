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

require_once 'class.Visitors.php';
require_once 'class.PiwikCounterWidget.php';
require_once 'class.PiwikCounterAdministration.php';

if ( !load_plugin_textdomain('PiwikCounter','/wp-content/languages/') )
{
	load_plugin_textdomain('PiwikCounter','/wp-content/plugins/piwikcounter/language/');
}


// options for PiwikCounter
add_option( 'piwikcounter_piwik_url', '', '', 'yes' );				// URL of your Piwik installation
add_option( 'piwikcounter_site_id', '', '', 'yes' );				// identification number of your tracked website
add_option( 'piwikcounter_auth_key', '', '', 'yes' );				// your authorisation key for piwik with viewing rights for the specified site id
add_option( 'piwikcounter_start_date', '', '', 'yes' );				// date when tracking in piwik began (date YYYY-MM-DD)
add_option( 'piwikcounter_unique_visitors', '', '', 'yes' );		// all visitors or unique visitors (bool)
add_option( 'piwikcounter_visitors_yesterday', '', '', 'yes' );		// quantity of visitors until yesterday
add_option( 'piwikcounter_visitors_last_change', '', '', 'yes' );	// last modification date of piwikcounter_visitors_yesterday (date YYYY-MM-DD)

$pca = new PiwikCounterAdministration();

//Actions und Filter
add_action('widgets_init', create_function('', 'return register_widget("PiwikCounterWidget");'));
 
?>
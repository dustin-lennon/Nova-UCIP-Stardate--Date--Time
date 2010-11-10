<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
/*
|---------------------------------------------------------------
| MOD HOOK
|---------------------------------------------------------------
|
| File: hooks/Mod.php
| System Version: 1.0
|
*/

class Mod {

	function Mod()
	{
		/* log the debug message */
		log_message('info', 'Mod Hook Initialized');
	}

	function stardate()
	{
		$ci =& get_instance();

		/**
		 * Pull all the settings needed in one fell swoop
		 * to avoid hitting the database several times along the way,
		 * especially with something that's running before anything
		 * it set to the browser.
		 */
		 $modsettings = $ci->settings->get_settings(array('sim_year', 'timezone', 'daylight_savings', 'date_format'));

		/**
		 * Using date() here is okay because you're only pulling the
		 * month and day, but generally, you'll want to avoid this in
		 * Nova since it relies entirely on a server setting to determine
		 * what timezone to use whereas using CI's built-in functions
		 * will take the framework setting in to account.
		 */
		$stardate = $modsettings['sim_year'].date('m.d');

		// Only get the timestamp once
		$timestamp = gmt_to_local(now(), $modsettings['timezone'], $modsettings['daylight_savings']);

		// CI's date functions are slightly different from date()
		$date = mdate('%M %d, %Y', $timestamp);

		// exact same timestamp just in a different format
		$time = mdate('%g:%i %A %T', $timestamp);

		$output = '<div style="padding:1em;">';
		$output .= '<strong>Stardate:</strong> '. $stardate .'<br />';
		$output .= '<strong>Date:</strong> '. $date .'<br />';
		$output .= '<strong>Time:</strong> '. $time .'<br />';
		$output .= '</div>';

		$ci->template->add_region('stardate');
		$ci->template->write('stardate', $output);
	}
}

/* End of file Mod.php */
/* Location: ./application/hooks/Mod.php */
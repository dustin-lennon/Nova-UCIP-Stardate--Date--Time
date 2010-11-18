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

		// Set server timezone based on Nova setting
		$tz = $modsettings['timezone'];
		switch ($tz)
		{
			case 'UM12':
				date_default_timezone_set("Pacific/Kwajalein");
				break;
			case 'UM11':
				date_default_timezone_set("Pacific/Samoa");
				break;
			case 'UM10':
				date_default_timezone_set("Pacific/Honolulu");
				break;
			case 'UM95':
				date_default_timezone_set("Pacific/Marquesas");
				break;
			case 'UM9':
				date_default_timezone_set("America/Anchorage");
				break;
			case 'UM8':
				date_default_timezone_set("America/Los_Angeles");
				break;
			case 'UM7':
				date_default_timezone_set("America/Boise");
				break;
			case 'UM6':
				date_default_timezone_set("America/Chicago");
				break;
			case 'UM5':
				date_default_timezone_set("America/Bogota");
				break;
			case 'UM45':
				date_default_timezone_set("America/Caracas");
				break;
			case 'UM4':
				date_default_timezone_set("America/Santiago");
				break;
			case 'UM35':
				date_default_timezone_set("America/St_Johns");
				break;
			case 'UM3':
				date_default_timezone_set("America/Argentina/Buenos_Aires");
				break;
			case 'UM2':
				date_default_timezone_set("America/Noronha");
				break;
			case 'UM1':
				date_default_timezone_set("Atlantic/Azores");
				break;
			case 'UTC':
				date_default_timezone_set("Europe/London");
				break;
			case 'UP1':
				date_default_timezone_set("Europe/Amsterdam");
				break;
			case 'UP2':
				date_default_timezone_set("Africa/Cairo");
				break;
			case 'UP3':
				date_default_timezone_set("Europe/Moscow");
				break;
			case 'UP35':
				date_default_timezone_set("Asia/Tehran");
				break;
			case 'UP4':
				date_default_timezone_set("Asia/Dubai");
				break;
			case 'UP45':
				date_default_timezone_set("Asia/Kabul");
				break;
			case 'UP5':
				date_default_timezone_set("Asia/Yekaterinburg");
				break;
			case 'UP55':
				date_default_timezone_set("Asia/Kolkata");
				break;
			case 'UP575':
				date_default_timezone_set("Asia/Katmandu");
				break;
			case 'UP6':
				date_default_timezone_set("Asia/Dhaka");
				break;
			case 'UP65':
				date_default_timezone_set("Asia/Rangoon");
				break;
			case 'UP7':
				date_default_timezone_set("Asia/Krasnoyarsk");
				break;
			case 'UP8':
				date_default_timezone_set("Australia/Perth");
				break;
			case 'UP875':
				date_default_timezone_set("Australia/Eucla");
				break;
			case 'UP9':
				date_default_timezone_set("Asia/Seoul");
				break;
			case 'UP95':
				date_default_timezone_set("Australia/Darwin");
				break;
			case 'UP10':
				date_default_timezone_set("Australia/Brisbane");
				break;
			case 'UP105':
				date_default_timezone_set("Australia/Lord_Howe");
				break;
			case 'UP11':
				date_default_timezone_set("Asia/Magadan");
				break;
			case 'UP115':
				date_default_timezone_set("Pacific/Norfolk");
				break;
			case 'UP12':
				date_default_timezone_set("Asia/Anadyr");
				break;
			case 'UP1275':
				date_default_timezone_set("Pacific/Chatham");
				break;
			case 'UP13':
				date_default_timezone_set("Pacific/Tongatapu");
				break;
			case 'UP14':
				date_default_timezone_set("Pacific/Kiritimati");
				break;
		}

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
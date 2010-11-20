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
		$modsettings = $ci->settings->get_settings(array('sim_year', 'timezone'));

		// Set server timezone based on Nova setting
		$tz = $modsettings['timezone'];

		switch ($tz)
		{
			case 'UM12':
				$novaTimeZone = new DateTime("now", new DateTimeZone('Pacific/Kwajalein'));
				break;
			case 'UM11':
				$novaTimeZone = new DateTime("now", new DateTimeZone('Pacific/Samoa'));
				break;
			case 'UM10':
				$novaTimeZone = new DateTime("now", new DateTimeZone('Pacific/Honolulu'));
				break;
			case 'UM95':
				$novaTimeZone = new DateTime("now", new DateTimeZone('Pacific/Marquesas'));
				break;
			case 'UM9':
				$novaTimeZone = new DateTime("now", new DateTimeZone('America/Anchorage'));
				break;
			case 'UM8':
				$novaTimeZone = new DateTime("now", new DateTimeZone('America/Los_Angeles'));
				break;
			case 'UM7':
				$novaTimeZone = new DateTime("now", new DateTimeZone('America/Boise'));
				break;
			case 'UM6':
				$novaTimeZone = new DateTime("now", new DateTimeZone('America/Chicago'));
				break;
			case 'UM5':
				$novaTimeZone = new DateTime("now", new DateTimeZone('America/New_York'));
				break;
			case 'UM45':
				$novaTimeZone = new DateTime("now", new DateTimeZone('America/Caracas'));
				break;
			case 'UM4':
				$novaTimeZone = new DateTime("now", new DateTimeZone('America/Santiago'));
				break;
			case 'UM35':
				$novaTimeZone = new DateTime("now", new DateTimeZone('America/St_Johns'));
				break;
			case 'UM3':
				$novaTimeZone = new DateTime("now", new DateTimeZone('America/Argentina/Buenos_Aires'));
				break;
			case 'UM2':
				$novaTimeZone = new DateTime("now", new DateTimeZone('America/Noronha'));
				break;
			case 'UM1':
				$novaTimeZone = new DateTime("now", new DateTimeZone('Atlantic/Azores'));
				break;
			case 'UTC':
				$novaTimeZone = new DateTime("now", new DateTimeZone('Europe/London'));
				break;
			case 'UP1':
				$novaTimeZone = new DateTime("now", new DateTimeZone('Europe/Amsterdam'));
				break;
			case 'UP2':
				$novaTimeZone = new DateTime("now", new DateTimeZone('Africa/Cairo'));
				break;
			case 'UP3':
				$novaTimeZone = new DateTime("now", new DateTimeZone('Europe/Moscow'));
				break;
			case 'UP35':
				$novaTimeZone = new DateTime("now", new DateTimeZone('Asia/Tehran'));
				break;
			case 'UP4':
				$novaTimeZone = new DateTime("now", new DateTimeZone('Asia/Dubai'));
				break;
			case 'UP45':
				$novaTimeZone = new DateTime("now", new DateTimeZone('Asia/Kabul'));
				break;
			case 'UP5':
				$novaTimeZone = new DateTime("now", new DateTimeZone('Asia/Yekaterinburg'));
				break;
			case 'UP55':
				$novaTimeZone = new DateTime("now", new DateTimeZone('Asia/Kolkata'));
				break;
			case 'UP575':
				$novaTimeZone = new DateTime("now", new DateTimeZone('Asia/Katmandu'));
				break;
			case 'UP6':
				$novaTimeZone = new DateTime("now", new DateTimeZone('Asia/Dhaka'));
				break;
			case 'UP65':
				$novaTimeZone = new DateTime("now", new DateTimeZone('Asia/Rangoon'));
				break;
			case 'UP7':
				$novaTimeZone = new DateTime("now", new DateTimeZone('Asia/Krasnoyarsk'));
				break;
			case 'UP8':
				$novaTimeZone = new DateTime("now", new DateTimeZone('Australia/Perth'));
				break;
			case 'UP875':
				$novaTimeZone = new DateTime("now", new DateTimeZone('Australia/Eucla'));
				break;
			case 'UP9':
				$novaTimeZone = new DateTime("now", new DateTimeZone('Asia/Seoul'));
				break;
			case 'UP95':
				$novaTimeZone = new DateTime("now", new DateTimeZone('Australia/Darwin'));
				break;
			case 'UP10':
				$novaTimeZone = new DateTime("now", new DateTimeZone('Australia/Brisbane'));
				break;
			case 'UP105':
				$novaTimeZone = new DateTime("now", new DateTimeZone('Australia/Lord_Howe'));
				break;
			case 'UP11':
				$novaTimeZone = new DateTime("now", new DateTimeZone('Asia/Magadan'));
				break;
			case 'UP115':
				$novaTimeZone = new DateTime("now", new DateTimeZone('Pacific/Norfolk'));
				break;
			case 'UP12':
				$novaTimeZone = new DateTime("now", new DateTimeZone('Asia/Anadyr'));
				break;
			case 'UP1275':
				$novaTimeZone = new DateTime("now", new DateTimeZone('Pacific/Chatham'));
				break;
			case 'UP13':
				$novaTimeZone = new DateTime("now", new DateTimeZone('Pacific/Tongatapu'));
				break;
			case 'UP14':
				$novaTimeZone = new DateTime("now", new DateTimeZone('Pacific/Kiritimati'));
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

		// CI's date functions are slightly different from date()
		$date = $novaTimeZone->format('M d, Y');

		// exact same timestamp just in a different format
		$time = $novaTimeZone->format('g:i A T');

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
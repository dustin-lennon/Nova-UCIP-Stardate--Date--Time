<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// STARDATE HOOK
class Stardate {
	public function Mod() {
		/* log the debug message */
		log_message('info', 'Stardate Hook Initialized');
	}

	public function stardate() {
		$ci =& get_instance();

		// check the install status
		$installed = $ci->sys->check_install_status();
		
		if ( ! $installed)
		{
			redirect('install/index', 'refresh');
		}

		// Get Stardate Config
		$ci->config->load('stardate', TRUE);

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

		// Get the option for Stardate Era
		$era = $ci->config->item('sdera','stardate');

		switch ($era)
		{
			case 'Enterprise':
				$stardate = date('M d, ').$modsettings['sim_year'];

				// Using PHP 5.2+ DateTime class to format date
				$date = $novaTimeZone->format('M d, Y');
				$time = $novaTimeZone->format('g:i A T');
				
				$output = '<div style="padding:1em;">';
				$output .= '<strong>Stardate:</strong> '. $stardate .'<br />';
				$output .= '<strong>Date:</strong> '. $date .'<br />';
				$output .= '<strong>Time:</strong> '. $time .'<br />';
				$output .= '</div>';
			break;
			case 'TOS':
				$year = $modsettings['sim_year'];
				$month = date('n');
				$day = date('j');
				$hour = date('G');
				$min = intval(date('i'));
			
				// Calculate TOS Stardate
				// Using PHP 5.2+ DateTime class to format date
				$stardateOrigin = new DateTime('2265/5/1 00:00:00', new DateTimeZone('Europe/London'));
				$stardateInput = new DateTime($year.'/'.$month.'/'.$day.' '.$hour.':'.$min.':00', new DateTimeZone('Europe/London'));
				$ms = ($stardateInput->format('U') - $stardateOrigin->format('U')) * 1000;
				$starYear = ($ms / (60 * 60 * 24 * 365.2422)) * 2.7113654892;
				$stardate = floor((floor(floor($starYear * 1000)) / 10)) / 100;
			
				// Convert TOS Stardate to Human readable date
				$dateOut = ($stardate / 1000) * 60 * 60 * 24 * 365.2422 / 2.7113654892;
				$ms = floor($dateOut + $stardateOrigin->format('U'));
				$date = new DateTime("@$ms");
			
				$serdate = $novaTimeZone->format('M d, Y');
				$sertime = $novaTimeZone->format('g:i A T');
			
				$output = '<div style="padding:1em;">';
				$output .= '<strong>Stardate:</strong> '. $stardate .'<br />';
				$output .= '<strong>Date:</strong> '. $date->format('M d, Y') .'<br />';
				$output .= '<br /><font style="font-size: 10px"><strong>Server Date:</strong> '. $serdate .'</font><br />';
				$output .= '<font style="font-size: 10px"><strong>Server Time:</strong> '. $sertime .'</font><br />';
				$output .= '</div>';
			break;
			case 'TNG':
				$year = $modsettings['sim_year'];
				$month = date('n');
				$day = date('j');
				$hour = date('G');
				$min = intval(date('i'));
			
				// Calculate TNG Stardate
				// Using PHP 5.2+ DateTime class to format date
				$stardateOrigin = new DateTime('2322/5/25 00:00:00', new DateTimeZone('Europe/London'));
				$stardateInput = new DateTime($year.'/'.$month.'/'.$day.' '.$hour.':'.$min.':00', new DateTimeZone('Europe/London'));
				$ms = ($stardateInput->format('U') - $stardateOrigin->format('U')) * 1000;
				$starYear = $ms / (60 * 60 * 24 * 365.2422);
				$stardate = floor($starYear * 100) / 100;
			
				// Convert TNG Stardate to Human readable date
				$dateOut = ($stardate / 1000) * 60 * 60 * 24 * 365.2422;
				$ms = floor($dateOut + $stardateOrigin->format('U'));
				$date = new DateTime("@$ms");
			
				$serdate = $novaTimeZone->format('M d, Y');
				$sertime = $novaTimeZone->format('g:i A T');
			
				$output = '<div style="padding:1em;">';
				$output .= '<strong>Stardate:</strong> '. $stardate .'<br />';
				$output .= '<strong>Date:</strong> '. $date->format('M d, Y') .'<br />';
				$output .= '<br /><font style="font-size: 10px"><strong>Server Date:</strong> '. $serdate .'</font><br />';
				$output .= '<font style="font-size: 10px"><strong>Server Time:</strong> '. $sertime .'</font><br />';
				$output .= '</div>';
			break;
			case 'Other':
				$stardate = $modsettings['sim_year'].date('m.d');
			
				// Using PHP 5.2+ DateTime class to format date
				$date = $novaTimeZone->format('M d, Y');
			
				// exact same timestamp just in a different format
				$time = $novaTimeZone->format('g:i A T');
			
				$output = '<div style="padding:1em;">';
				$output .= '<strong>Stardate:</strong> '. $stardate .'<br />';
				$output .= '<strong>Date:</strong> '. $date .'<br />';
				$output .= '<strong>Time:</strong> '. $time .'<br />';
				$output .= '</div>';
			break;
		}

		$this->_regions['stardate'] = $output;
		Template::assign($this->_regions);
	}
}

/* End of file Stardate.php */
/* Location: ./application/hooks/Stardate.php */
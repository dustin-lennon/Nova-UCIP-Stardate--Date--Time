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
		
		$output = '<div style="padding:1em;">';
		$output .= '<strong>Stardate:</strong> '. $ci->settings->get_setting('sim_year') . date('m.d') .'<br />';
		$output .= '<strong>Date:</strong> '. date('M d, Y') .'<br />';
		$output .= '<strong>Time:</strong> '. date('g:i A T', gmt_to_local(time(), $ci->settings->get_setting('timezone'), $ci->settings->get_setting('daylight_savings'))).'<br />';
		$output .= '<strong>Temp:</strong> '.date('g:i A T', now()).'<br />';
		$output .= '<strong>Temp2:</strong> '.gmt_to_local(now(), $ci->settings->get_setting('timezone'), $ci->settings->get_setting('daylight_savings'));
		$output.= '</div>';
		
		$ci->template->add_region('stardate');
		$ci->template->write('stardate', $output);
	}
}

/* End of file Mod.php */
/* Location: ./application/hooks/Mod.php */
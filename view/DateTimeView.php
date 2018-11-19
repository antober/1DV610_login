<?php

class DateTimeView {
	private static $location = 'Europe/Stockholm';
	private static $dateFormat = 'l\, \t\h\e\ jS \of F Y\, \T\h\e\ \t\i\m\e\ \i\s\  H:i:s';

	public function show() : string {
		date_default_timezone_set(self::$location);
		$timeString = date(self::$dateFormat);

		return '<p>' . $timeString . '</p>';
	}
}
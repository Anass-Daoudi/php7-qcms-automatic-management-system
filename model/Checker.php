<?php
	class Checker{
		public static function checkDateFormat($date) {
			$dateElements = explode ( "-", $date );
			return count ( $dateElements ) == 3 && checkdate ( $dateElements [1], $dateElements [0], $dateElements [2] );
		}
		public static  function checkEmailFormat($email) {
			return preg_match ( "#^[A-Za-z0-9-_.]+@[A-Za-z0-9-.]+\.[A-Za-z]{2,6}$#", $email ) == 1;
		}
	}
?>
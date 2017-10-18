<?php
class ConnectionDB {
	private static $instance = null;
	private function __construct() {
	}
	public static function getInstance() {
		if (self::$instance==null) {
			try {
				self::$instance = new PDO ( "mysql:host=localhost;dbname=project", "root", "" );
			} catch ( PDOException $e ) {
				echo $e->getMessage ();
			}
		}
		return self::$instance;
	}
}
?>
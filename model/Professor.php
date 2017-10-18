<?php
require_once 'Person.php';
class Professor extends Person {
	private $module;
	private $qcms = array ();
	public function __construct($firstName, $lastName, $cin, $module, $email, $password = null, $id = null) {
		parent::__construct ( $firstName, $lastName, $cin, $email, $password, $id );
		$this->module = $module;
	}
	public function addQcm($qcm) {
		$this->qcms [] = $qcm;
	}
	public function getQcms() {
		return $this->qcms;
	}
	public function getModule() {
		return $this->module;
	}
}
?>
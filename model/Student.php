<?php
require_once 'Person.php';
class Student extends Person {
	private $accepted = 0;
	private $qcmYear;
	private $birthday;
	private $cne;
	private $field;
	private $mark;
	private $qcms = array ();
	public function __construct($firstName, $lastName, $birthday, $cin, $cne, $field, $mark, $email, $password = null, $id = null) {
		parent::__construct ( $firstName, $lastName, $cin, $email, $password, $id );
		$this->birthday = $birthday;
		$this->cne = $cne;
		$this->field = $field;
		$this->mark = $mark;
	}
	public function setAccepted($accepted) {
		$this->accepted = $accepted;
	}
	public function getAccepted() {
		return $this->accepted;
	}
	public function setQCMYearArg($qcmYear) {
		$this->qcmYear = $qcmYear;
	}
	public function getQCMYear() {
		return $this->qcmYear;
	}
	public function addQcm($qcm) {
		$this->qcms [] = $qcm;
	}
	public function getQcms() {
		return $this->qcms;
	}
	
	/*
	 * public function setFirstName(){
	 *
	 * }
	 *
	 * public function setBirthday($birthday){
	 * $this->birthday=$birthday;
	 * }
	 *
	 * public function setCne($cne){
	 * $this->cne=$cne;
	 * }
	 *
	 * public function setField($field){
	 * $this->field=$field;
	 * }
	 *
	 * public function setmMark($mark){
	 * $this->mark=$mark;
	 * }
	 */
	public function getBirthday() {
		return $this->birthday;
	}
	public function getCne() {
		return $this->cne;
	}
	public function getField() {
		return $this->field;
	}
	public function getMark() {
		return $this->mark;
	}
}

?>
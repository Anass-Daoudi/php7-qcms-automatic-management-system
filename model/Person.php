<?php
	class Person{
		private $id;
		private $firstName;
		private $lastName;
		private $cin;
		private $email;
		private $password;
		
		public function __construct($firstName,$lastName,$cin,$email,$password=null,$id=null){
			$this->firstName=$firstName;
			$this->lastName=$lastName;
			$this->cin=$cin;
			$this->email=$email;
			$this->password=$password;
			$this->id=$id;
		}
		
		public function getFirstName(){
			return $this->firstName;
		}
		
		public function getLastName(){
			return $this->lastName;
		}
		
		public function getCin(){
			return $this->cin;
		}
		
		public function getEmail(){
			return $this->email;
		}
		
		public function getPassword(){
			return $this->password;
		}
		
		public function setId($id){
			$this->id=$id;
		}
		
		function getId(){
			return $this->id;
		}
	}
?>
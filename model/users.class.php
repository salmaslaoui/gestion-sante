<?php
require_once('crud.class.php');

class Users {

    private $_u_id;
	private $_u_name;
	private $_u_password;
	private $_u_mail;
	
	public function setu_id($value){
        if((is_int($value) == true or ctype_digit($value) == true) and $value <= 2147483647){
            $this->_u_id = $value;
        }
	}
	public function getu_id(){ 
        return $this->_u_id; 
	}
	
	public function setu_name($value){
        if((is_string($value) == true) and (strlen($value) <= 255)){
            $this->_u_name = $value;
        }
	}
	public function getu_name(){ 
        return $this->_u_name; 
	}
	
	public function setu_password($value){
        if((is_string($value) == true) and (strlen($value) <= 255)){
            $this->_u_password = $value;
        }
	}
	public function getu_password(){ 
        return $this->_u_password; 
	}
	
	public function setu_mail($value){
        if((is_string($value) == true) and (strlen($value) <= 255)){
            $this->_u_mail = $value;
        }
	}
	public function getu_mail(){ 
        return $this->_u_mail; 
	}
	
	public function hydrate(array $donnees) {
		foreach($donnees as $key => $value) {
			$method = 'set'.($key); 
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}
}


class ManagementBddUsers extends crud {

    // CREATE
    public function add_user(Users $users){
        $query = $this->getDb()->prepare('INSERT INTO users (u_name, u_password, u_mail) 
            VALUES (:u_name, :u_password, :u_mail)');

        $query->bindValue(':u_name', $users->getu_name(), PDO::PARAM_STR);			
        $query->bindValue(':u_password', $users->getu_password(), PDO::PARAM_STR);
        $query->bindValue(':u_mail', $users->getu_mail(), PDO::PARAM_STR);
        
        $query->execute();
	}
	
	
    // UPDATE
    public function update_user(Users $users){
        $query = $this->getDb()->prepare('UPDATE users 
            SET u_name = :u_name, u_password = :u_password, u_mail = :u_mail
            WHERE u_id = :u_id');
            
		$query->bindValue(':u_id', $users->getu_id(), PDO::PARAM_INT);
        $query->bindValue(':u_name', $users->getu_name(), PDO::PARAM_STR);			
        $query->bindValue(':u_password', $users->getu_password(), PDO::PARAM_STR);
        $query->bindValue(':u_mail', $users->getu_mail(), PDO::PARAM_STR);

        $query->execute();
	}

   
    // READ

}
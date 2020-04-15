<?php
require_once('crud.class.php');

class Accounts {

    private $_a_id;
	private $_a_uid;
	private $_a_name;
	private $_a_first_name;
	private $_a_birth_date;

	
	public function seta_id($value){
        if((is_int($value) == true or ctype_digit($value) == true) and $value <= 2147483647){
            $this->_a_id = $value;
        }
	}
	public function geta_id(){ 
        return $this->_a_id; 
	}
	
	public function seta_uid($value) {
        if((is_int($value) == true or ctype_digit($value) == true) and $value <= 2147483647){
            $this->_a_uid = $value;
        }
	}
	public function geta_uid() { 
        return $this->_a_uid; 
	}
	
	public function seta_name($value){
        if((is_string($value) == true) and (strlen($value) <= 255)){
            $this->_a_name = $value;
        }
	}
	public function geta_name() { 
        return $this->_a_name; 
	}
	
	public function seta_first_name($value) {
        if((is_string($value) == true) and (strlen($value) <= 255)){
            $this->_a_first_name = $value;
        }
	}
	public function geta_first_name() { 
        return $this->_a_first_name; 
	}
	
	public function seta_birth_date($value) {
        if((is_string($value) == true) and (strlen($value) <= 10)){
			$this->_a_birth_date = $value;
        }
	}
	public function geta_birth_date() { 
        return $this->_a_birth_date; 
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


class ManagementBddAccounts extends crud {

    // CREATE
    public function add_account(Accounts $accounts){
        $query = $this->getDb()->prepare('INSERT INTO accounts (a_uid, a_name, a_first_name, a_birth_date) 
            VALUES (:a_uid, :a_name, :a_first_name, :a_birth_date)');

        $query->bindValue(':a_uid', $accounts->geta_uid(), PDO::PARAM_INT);			
        $query->bindValue(':a_name', $accounts->geta_name(), PDO::PARAM_STR);
        $query->bindValue(':a_first_name', $accounts->geta_first_name(), PDO::PARAM_STR);
        $query->bindValue(':a_birth_date', $accounts->geta_birth_date(), PDO::PARAM_STR);
        
        $query->execute();
	}
	
	
    // UPDATE
    public function update_account(Accounts $accounts){
        $query = $this->getDb()->prepare('UPDATE accounts 
            SET a_name = :a_name, a_first_name = :a_first_name, a_birth_date = :a_birth_date 
            WHERE a_id = :a_id');
            
		$query->bindValue(':a_id', $accounts->geta_id(), PDO::PARAM_INT);	
        $query->bindValue(':a_name', $accounts->geta_name(), PDO::PARAM_STR);
        $query->bindValue(':a_first_name', $accounts->geta_first_name(), PDO::PARAM_STR);
        $query->bindValue(':a_birth_date', $accounts->geta_birth_date(), PDO::PARAM_STR);

        $query->execute();
	}

   
    // READ
    public function select_account_with_user_id($id){
        $resultat =[];
        
        $query = $this->getDb()->prepare('SELECT * FROM accounts
            WHERE a_uid = :a_uid');
        
        $query->BindValue(':a_uid', $id, PDO::PARAM_INT);
        
        $query->execute();
        
        if($query == false){
            return false;
        } else {
            $resultat = $query->fetchAll(PDO::FETCH_ASSOC);
            return $resultat;
        }
    }
	
	public function select_account_with_account_id($id){
        $resultat =[];
        
        $query = $this->getDb()->prepare('SELECT * FROM accounts
            WHERE a_id = :a_id');
        
        $query->BindValue(':a_id', $id, PDO::PARAM_INT);
        
        $query->execute();
        
        if($query == false){
            return false;
        } else {
            $resultat = $query->fetchAll(PDO::FETCH_ASSOC);
            return $resultat;
        }
    }
	
	public function check_session($iduser , $idacc){
        $resultat =[];
        
        $query = $this->getDb()->prepare('SELECT * FROM accounts
            WHERE a_uid = :a_uid AND a_id = :a_id');
        
        $query->BindValue(':a_uid', $iduser, PDO::PARAM_INT);
		$query->BindValue(':a_id', $idacc, PDO::PARAM_INT);
        
        $query->execute();
        
        if($query == false){
            return false;
        } else {
            $resultat = $query->fetch(PDO::FETCH_ASSOC);
            return $resultat;
        }
	}
	
	   public function get_birth_day($id){
        $resultat =[];
        
        $query = $this->getDb()->prepare('SELECT a_birth_date FROM accounts
            WHERE a_uid = :a_uid');
        
        $query->BindValue(':a_uid', $id, PDO::PARAM_INT);
        
        $query->execute();
        
        if($query == false){
            return false;
        } else {
            $resultat = $query->fetch(PDO::FETCH_ASSOC);
            return $resultat;
        }
    }
	
	//DELETE
	public function delete_account_with_user_id($id){
		$query = $this->getDb()->prepare('DELETE FROM accounts
			WHERE a_uid = :a_uid');

		$query->bindValue(':a_uid',$id, PDO::PARAM_INT);

		$query->execute();
	}
	
	public function delete_account_with_account_id($id){
		$query = $this->getDb()->prepare('DELETE FROM accounts
			WHERE a_id = :a_id');

		$query->bindValue(':a_id',$id, PDO::PARAM_INT);

		$query->execute();
	}
}
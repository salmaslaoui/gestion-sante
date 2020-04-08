<?php
require_once('crud.class.php');

class Storages {

    private $_s_id;
	private $_s_uid;
	private $_s_cis;
	private $_s_cip;
	private $_s_bundle;
	private $_s_dosage;
	private $_s_quantity;
	private $_s_date;

	
	public function sets_id($value){
        if((is_int($value) == true or ctype_digit($value) == true) and $value <= 2147483647){
            $this->_s_id = $value;
        }
	}
	public function gets_id(){ 
        return $this->_s_id; 
	}
	
	public function sets_uid($value){
        if((is_int($value) == true or ctype_digit($value) == true) and $value <= 2147483647){
            $this->_s_uid = $value;
        }
	}
	public function gets_uid(){ 
        return $this->_s_uid; 
	}
	
	public function sets_cis($value){
        if((is_int($value) == true or ctype_digit($value) == true) and (strlen($value) == 8)){
            $this->_s_cis = $value;
        }
	}
	public function gets_cis(){ 
        return $this->_s_cis; 
	}
	
	public function sets_cip($value){
        if((is_int($value) == true or ctype_digit($value) == true) and (strlen($value) == 13)){
            $this->_s_cip = $value;
        }
	}
	public function gets_cip(){ 
        return $this->_s_cip; 
	}
	
	public function sets_bundle($value){
		if((is_string($value) == true) and (strlen($value) <= 20)){
			$this->_s_bundle = $value;
		}
	}
	public function gets_bundle(){ 
        return $this->_s_bundle; 
	}
	
	public function sets_dosage($value){
		if((is_string($value) == true) and (strlen($value) <= 20)){
			$this->_s_dosage = $value;
		}
	}
	public function gets_dosage(){ 
        return $this->_s_dosage; 
	}

	public function sets_quantity($value){
        if((is_int($value) == true or ctype_digit($value) == true) and $value <= 2147483647){
            $this->_s_quantity = $value;
        }
	}
	public function gets_quantity(){ 
        return $this->_s_quantity; 
	}
	
	public function sets_date($value) {
        if((is_string($value) == true) and (strlen($value) <= 10)){
			$this->_s_date = $value;
        }
	}
	public function gets_date() { 
        return $this->_s_date; 
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


class ManagementBddStorages extends crud {

    // CREATE
    public function add_storage(Storages $storage){
        $query = $this->getDb()->prepare('INSERT INTO storages (s_uid, s_cis, s_cip, s_bundle, s_dosage, s_quantity, s_date) 
            VALUES (:s_uid, :s_cis, :s_cip, :s_bundle, :s_dosage, :s_quantity, :s_date)');

        $query->bindValue(':s_uid', $storage->gets_uid(), PDO::PARAM_INT);			
        $query->bindValue(':s_cis', $storage->gets_cis(), PDO::PARAM_STR);
		$query->bindValue(':s_cip', $storage->gets_cip(), PDO::PARAM_STR);			
        $query->bindValue(':s_bundle', $storage->gets_bundle(), PDO::PARAM_STR);
		$query->bindValue(':s_dosage', $storage->gets_dosage(), PDO::PARAM_STR);			
        $query->bindValue(':s_quantity', $storage->gets_quantity(), PDO::PARAM_INT);
		$query->bindValue(':s_date', $storage->gets_date(), PDO::PARAM_STR);
        
        $query->execute();
	}
	
	   
	// UPDATE
    public function update_storage(Storages $storage){
        $query = $this->getDb()->prepare('UPDATE storages 
            SET s_uid = :s_uid, s_cis = :s_cis, s_cip = :s_cip, s_bundle = :s_bundle, s_dosage = :s_dosage, s_quantity = :s_quantity, s_date = :s_date
            WHERE s_id = :s_id');
        
		$query->bindValue(':s_id', $storage->gets_id(), PDO::PARAM_INT);
		$query->bindValue(':s_uid', $storage->gets_uid(), PDO::PARAM_INT);			
        $query->bindValue(':s_cis', $storage->gets_cis(), PDO::PARAM_STR);
		$query->bindValue(':s_cip', $storage->gets_cip(), PDO::PARAM_STR);			
        $query->bindValue(':s_bundle', $storage->gets_bundle(), PDO::PARAM_STR);
		$query->bindValue(':s_dosage', $storage->gets_dosage(), PDO::PARAM_STR);			
        $query->bindValue(':s_quantity', $storage->gets_quantity(), PDO::PARAM_INT);
		$query->bindValue(':s_date', $storage->gets_date(), PDO::PARAM_STR);

        $query->execute();
	}

   
    // READ
    public function select_storage_with_uid($id){
        $resultat =[];
        
        $query = $this->getDb()->prepare('SELECT * FROM storages
			LEFT JOIN cis_bdpm ON s_cip = cis_cis
            WHERE s_uid = :s_uid');
        
        $query->BindValue(':s_uid', $id, PDO::PARAM_INT);
        
        $query->execute();
        
        if($query == false){
            return false;
        } else {
            $resultat = $query->fetch(PDO::FETCH_ASSOC);
            return $resultat;
        }
    }
}
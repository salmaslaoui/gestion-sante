<?php
require_once('crud.class.php');

class Vaccines {

    private $_v_id;
	private $_v_name;
	private $_v_disease;
	private $_v_type;
	private $_v_age;
	private $_v_date;

	
	public function setv_id($value){
        if((is_int($value) == true or ctype_digit($value) == true) and $value <= 2147483647){
            $this->_v_id = $value;
        }
	}
	public function getv_id(){ 
        return $this->_v_id; 
	}
	
	public function setv_name($value) {
        if((is_string($value) == true) and (strlen($value) <= 255)){
			$this->_v_name = $value;
        }
	}
	public function getv_name() { 
        return $this->_v_name; 
	}
	
	public function setv_disease($value) {
        if((is_string($value) == true) and (strlen($value) <= 255)){
			$this->_v_disease = $value;
        }
	}
	public function getv_disease() { 
        return $this->_v_disease; 
	}
	
	public function setv_type($value) {
        if((is_string($value) == true) and ($value =="Atténué" OR $value="Inactivé")){
			$this->_v_type = $value;
        }
	}
	public function getv_type() { 
        return $this->_v_type; 
	}
	
	public function setv_age($value) {
        if((is_string($value) == true) and (strlen($value) <= 5)){
			$this->_v_age = $value;
        }
	}
	public function getv_age() { 
        return $this->_v_age; 
	}
	
	public function setv_date($value) {
        if((is_string($value) == true) and (strlen($value) <= 255)){
			$this->_v_date = $value;
        }
	}
	public function getv_date() { 
        return $this->_v_date; 
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


class ManagementBddVaccines extends crud {

    // CREATE
    public function add_vaccin(Vaccines $vaccin){
        $query = $this->getDb()->prepare('INSERT INTO vaccines (v_name, v_disease, v_type, v_age, v_date) 
            VALUES (:v_name, :v_disease, :v_type, :v_age, :v_date)');
			
        $query->bindValue(':v_name', $vaccin->getv_name(), PDO::PARAM_STR);
		$query->bindValue(':v_disease', $vaccin->getv_disease(), PDO::PARAM_STR);			
        $query->bindValue(':v_type', $vaccin->getv_type(), PDO::PARAM_STR);
        $query->bindValue(':v_age', $vaccin->getv_age(), PDO::PARAM_STR);
		$query->bindValue(':v_date', $vaccin->getv_date(), PDO::PARAM_STR);
        
        $query->execute();
	}
	
	   
	// UPDATE
    public function update_vaccin(Vaccines $vaccin){
        $query = $this->getDb()->prepare('UPDATE vaccines 
            SET v_name = :v_name, v_disease = :v_disease, v_type = :v_type, v_age = :v_age, v_date = :v_date
            WHERE v_id = :v_id');
        
		$query->bindValue(':v_id', $vaccin->getv_id(), PDO::PARAM_INT);
		$query->bindValue(':v_name', $vaccin->getv_name(), PDO::PARAM_STR);
		$query->bindValue(':v_disease', $vaccin->getv_disease(), PDO::PARAM_STR);			
        $query->bindValue(':v_type', $vaccin->getv_type(), PDO::PARAM_STR);
		$query->bindValue(':v_date', $vaccin->getv_age(), PDO::PARAM_STR);
		$query->bindValue(':v_date', $vaccin->getv_date(), PDO::PARAM_STR);

        $query->execute();
	}

   
    // READ
	   public function select_vaccines_with_vac_id($id){
		$resultat =[];
      
		$query = $this->getDb()->prepare('SELECT * FROM vaccines
			WHERE v_id = :v_id');
      
		$query->BindValue(':v_id', $id, PDO::PARAM_INT);
      
		$query->execute();
      
		if($query == false){
			return false;
		} else {
			$resultat = $query->fetchAll(PDO::FETCH_ASSOC);
			return $resultat;
		}
	}

	public function select_id_vaccin_with_vac_name($name){
		$resultat =[];
    
		$query = $this->getDb()->prepare('SELECT v_id, v_age FROM vaccines
			WHERE v_name = :v_name');
    
		$query->BindValue(':v_name', $name, PDO::PARAM_STR);
    
		$query->execute();
    
		if($query == false){
			return false;
		} else {
			$resultat = $query->fetchAll(PDO::FETCH_ASSOC);
			return $resultat;
		}
	}
}	
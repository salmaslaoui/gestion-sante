<?php
require_once('crud.class.php');

class Journeys {

	private $_j_id;
	private $_j_cid;
	private $_j_vid;

	
	public function setj_id($value){
        if((is_int($value) == true or ctype_digit($value) == true) and $value <= 2147483647){
            $this->_j_id = $value;
        }
	}
	public function getj_id(){ 
        return $this->_j_id; 
	}
	
	public function setj_cid($value){
        if((is_int($value) == true or ctype_digit($value) == true) and $value <= 2147483647){
            $this->_j_cid = $value;
        }
	}
	public function getj_cid(){ 
        return $this->_j_cid; 
	}

	public function setj_vid($value){
        if((is_int($value) == true or ctype_digit($value) == true) and $value <= 2147483647){
            $this->_j_vid = $value;
        }
	}
	public function getj_vid(){ 
        return $this->_j_vid; 
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


class ManagementBddJourneys extends crud {

    // CREATE
    public function add_journey(Journeys $journey){
        $query = $this->getDb()->prepare('INSERT INTO journeys (j_cid, j_vid) 
            VALUES (:j_cid, :j_vid)');

        $query->bindValue(':j_cid', $journey->getj_cid(), PDO::PARAM_INT);			
        $query->bindValue(':j_vid', $journey->getj_vid(), PDO::PARAM_INT);
        
        $query->execute();
	}
	
	   
	// UPDATE
    public function update_journey(Journeys $journey){
        $query = $this->getDb()->prepare('UPDATE journeys 
            SET j_cid = :j_cid, j_vid = :j_vid
            WHERE j_id = :j_id');
        
		$query->bindValue(':j_id', $journey->getj_id(), PDO::PARAM_INT);
		$query->bindValue(':j_cid', $journey->getj_cid(), PDO::PARAM_INT);			
        $query->bindValue(':j_vid', $journey->getj_vid(), PDO::PARAM_INT);

        $query->execute();
	}

   
    // READ
    public function select_vaccines_for_1countrie($id){
        $resultat =[];
        
        $query = $this->getDb()->prepare('SELECT * FROM countries
			LEFT JOIN journeys ON c_id = j_cid
			LEFT JOIN vaccines ON j_vid = v_id
            WHERE c_id = :c_id');
        
        $query->BindValue(':c_id', $id, PDO::PARAM_INT);
        
        $query->execute();
        
        if($query == false){
            return false;
        } else {
            $resultat = $query->fetch(PDO::FETCH_ASSOC);
            return $resultat;
        }
    }
}
<?php
require_once('crud.class.php');

class Inoculations {

    private $_i_id;
	private $_i_aid;
	private $_i_vid;
	private $_i_date;

	
	public function seti_id($value){
        if((is_int($value) == true or ctype_digit($value) == true) and $value <= 2147483647){
            $this->_i_id = $value;
        }
	}
	public function geti_id(){ 
        return $this->_i_id; 
	}
	
	public function seti_aid($value){
        if((is_int($value) == true or ctype_digit($value) == true) and $value <= 2147483647){
            $this->_i_aid = $value;
        }
	}
	public function geti_aid(){ 
        return $this->_i_aid; 
	}
	
	public function seti_vid($value){
        if((is_int($value) == true or ctype_digit($value) == true) and $value <= 2147483647){
            $this->_i_vid = $value;
        }
	}
	public function geti_vid(){ 
        return $this->_i_vid; 
	}
	
	public function seti_date($value){
        if((is_string($value) == true) and (strlen($value) <= 10)){
            $this->_i_date = $value;
        }
	}
	public function geti_date(){ 
        return $this->_i_date;
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


class ManagementBddInoculations extends crud {

    // CREATE
    public function add_inoculation(Inoculations $ino){
        $query = $this->getDb()->prepare('INSERT INTO inoculations (i_aid, i_vid, i_date) 
            VALUES (:i_aid, :i_vid, :i_date)');

        $query->bindValue(':i_aid', $ino->geti_aid(), PDO::PARAM_INT);			
        $query->bindValue(':i_vid', $ino->geti_vid(), PDO::PARAM_INT);
        $query->bindValue(':i_date', $ino->geti_date(), PDO::PARAM_STR);
        
        $query->execute();
	}
	
	
    // UPDATE
    public function update_inoculation(Inoculations $ino){
        $query = $this->getDb()->prepare('UPDATE inoculations 
            SET i_aid = :i_aid, i_vid = :i_vid, i_date = :i_date 
            WHERE i_id = :i_id');
        
		$query->bindValue(':i_id', $ino->geti_aid(), PDO::PARAM_INT)
		$query->bindValue(':i_aid', $ino->geti_aid(), PDO::PARAM_INT);			
        $query->bindValue(':i_vid', $ino->geti_vid(), PDO::PARAM_INT);
        $query->bindValue(':i_date', $ino->geti_date(), PDO::PARAM_STR);

        $query->execute();
	}

   
    // READ
    public function select_inoculation_for_1ppl($id){
        $resultat =[];
        
        $query = $this->getDb()->prepare('SELECT * FROM inoculations
			LEFT JOIN vaccines ON i_vid = v_id
            WHERE i_aid = :i_aid');
        
        $query->BindValue(':i_aid', $id, PDO::PARAM_INT);
        
        $query->execute();
        
        if($query == false){
            return false;
        } else {
            $resultat = $query->fetch(PDO::FETCH_ASSOC);
            return $resultat;
        }
    }
}
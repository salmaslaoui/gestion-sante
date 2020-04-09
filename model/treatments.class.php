<?php
require_once('crud.class.php');

class Treatments {

    private $_t_id;
	private $_t_aid;
	private $_t_tag;
	private $_t_cis;
	private $_t_start_date;
	private $_t_end_date;
	private $_t_quantity;
	private $_t_number_day;
	private $_t_time;
	private $_t_validate;
	private $_t_del;
	
	
	public function sett_id($value){
        if((is_int($value) == true or ctype_digit($value) == true) and $value <= 2147483647){
            $this->_t_id = $value;
        }
	}
	public function gett_id(){ 
        return $this->_t_id; 
	}
	
	public function sett_aid($value){
        if((is_int($value) == true or ctype_digit($value) == true) and $value <= 2147483647){
            $this->_t_aid = $value;
        }
	}
	public function gett_aid(){ 
        return $this->_t_aid; 
	}
	
	public function sett_tag($value){
		if((is_string($value) == true) and (strlen($value) <= 20)){
			$this->_t_tag = $value;
		}
	}
	public function gett_tag(){ 
        return $this->_t_tag; 
	}
	
	public function sett_cis($value){
        if((is_int($value) == true or ctype_digit($value) == true) and (strlen($value) == 8)){
            $this->_t_cis = $value;
        }
	}
	public function gett_cis(){ 
        return $this->_t_cis; 
	}
	
	public function sett_start_date($value) {
        if((is_string($value) == true) and (strlen($value) <= 10)){
			$this->_t_start_date = $value;
        }
	}
	public function gett_start_date() { 
        return $this->_t_start_date; 
	}
	
	public function sett_end_date($value) {
        if((is_string($value) == true) and (strlen($value) <= 10)){
			$this->_t_end_date = $value;
        }
	}
	public function gett_end_date() { 
        return $this->_t_end_date; 
	}
	
	public function sett_quantity($value){
        if((is_int($value) == true or ctype_digit($value) == true) and $value <= 255){
            $this->_t_quantity = $value;
        }
	}
	public function gett_quantity(){ 
        return $this->_t_quantity; 
	}
	
	public function sett_number_day($value){
        if((is_int($value) == true or ctype_digit($value) == true) and $value <= 255){
            $this->_t_number_day = $value;
        }
	}
	public function gett_number_day(){ 
        return $this->_t_number_day; 
	}
	
	public function sett_time($value){
		if((is_string($value) == true) and (strlen($value) <= 255)){
			$this->_t_time = $value;
		}
	}
	public function gett_time(){ 
        return $this->_t_time; 
	}
	
	public function sett_validate($value){
        if((is_int($value) == true or ctype_digit($value) == true) and $value <= 2147483647){
            $this->_t_validate = $value;
        }
	}
	public function gett_validate(){ 
        return $this->_t_validate; 
	}
	
	public function sett_del($value){
        if((is_int($value) == true or ctype_digit($value) == true) and $value <= 1){
            $this->_t_del = $value;
        }
	}
	public function gett_del(){ 
        return $this->_t_del; 
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


class ManagementBddTreatments extends crud {

    // CREATE
    public function add_treatment(Treatments $treatment){
        $query = $this->getDb()->prepare('INSERT INTO treatments (t_aid, t_tag, t_cis, t_start_date, t_end_date, t_quantity, t_number_day, t_time, t_validate, t_del) 
            VALUES (:t_aid, :t_tag, :t_cis, :t_start_date, :t_end_date, :t_quantity, :t_number_day, :t_time, :t_validate, :t_del)');
			
        $query->bindValue(':t_aid', $treatment->gett_aid(), PDO::PARAM_INT);
		$query->bindValue(':t_tag', $treatment->gett_tag(), PDO::PARAM_STR);			
        $query->bindValue(':t_cis', $treatment->gett_cis(), PDO::PARAM_STR);
		$query->bindValue(':t_start_date', $treatment->gett_start_date(), PDO::PARAM_STR);			
        $query->bindValue(':t_end_date', $treatment->gett_end_date(), PDO::PARAM_STR);
		$query->bindValue(':t_quantity', $treatment->gett_quantity(), PDO::PARAM_INT);
		$query->bindValue(':t_number_day', $treatment->gett_number_day(), PDO::PARAM_INT);
		$query->bindValue(':t_time', $treatment->gett_time(), PDO::PARAM_STR);
		$query->bindValue(':t_validate', $treatment->gett_validate(), PDO::PARAM_INT);
		$query->bindValue(':t_del', $treatment->gett_del(), PDO::PARAM_INT);
        
        $query->execute();
	}
	
	   
	// UPDATE
    public function update_treatment(Treatments $treatment){
        $query = $this->getDb()->prepare('UPDATE treatments 
            SET t_aid = :t_aid, t_tag = :t_tag, t_cis = :t_cis, t_start_date = :t_start_date, t_end_date = :t_end_date, t_quantity = :t_quantity, t_number_day = :t_number_day, t_time = :t_time, t_validate = :t_validate, t_del = :t_del
            WHERE t_id = :t_id');
        
		$query->bindValue(':t_id', $treatment->gett_id(), PDO::PARAM_INT);
		$query->bindValue(':t_aid', $treatment->gett_aid(), PDO::PARAM_INT);
		$query->bindValue(':t_tag', $treatment->gett_tag(), PDO::PARAM_STR);			
        $query->bindValue(':t_cis', $treatment->gett_cis(), PDO::PARAM_STR);
		$query->bindValue(':t_start_date', $treatment->gett_start_date(), PDO::PARAM_STR);			
        $query->bindValue(':t_end_date', $treatment->gett_end_date(), PDO::PARAM_STR);
		$query->bindValue(':t_quantity', $treatment->gett_quantity(), PDO::PARAM_INT);
		$query->bindValue(':t_number_day', $treatment->gett_number_day(), PDO::PARAM_INT);
		$query->bindValue(':t_time', $treatment->gett_time(), PDO::PARAM_STR);
		$query->bindValue(':t_validate', $treatment->gett_validate(), PDO::PARAM_INT);
		$query->bindValue(':t_del', $treatment->gett_del(), PDO::PARAM_INT);

        $query->execute();
	}

   
    // READ
    public function select_treatment_for_1ppl($id){
        $resultat =[];
        
        $query = $this->getDb()->prepare('SELECT * FROM treatments
			LEFT JOIN cis_bdpm ON t_cip = cis_cis
            WHERE t_aid = :t_aid');
        
        $query->BindValue(':t_aid', $id, PDO::PARAM_INT);
        
        $query->execute();
        
        if($query == false){
            return false;
        } else {
            $resultat = $query->fetch(PDO::FETCH_ASSOC);
            return $resultat;
        }
    }
	
	public function select_treatment_for_1ppl_with_tag($id, $tag){
        $resultat =[];
        
        $query = $this->getDb()->prepare('SELECT * FROM treatments
			LEFT JOIN cis_bdpm ON t_cip = cis_cis
            WHERE t_aid = :t_aid AND t_tag = :t_tag');
        
        $query->BindValue(':t_aid', $id, PDO::PARAM_INT);
		$query->BindValue(':t_tag', $tag, PDO::PARAM_STR);
        
        $query->execute();
        
        if($query == false){
            return false;
        } else {
            $resultat = $query->fetch(PDO::FETCH_ASSOC);
            return $resultat;
        }
	}
}
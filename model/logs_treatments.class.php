<?php
require_once('crud.class.php');

class LogsTreatments {

    private $_l_id;
    private $_l_tid;
    private $_l_date;
    private $_l_time;
    private $_l_validate;

	
    public function setl_id($value){
		if((is_int($value) == true or ctype_digit($value) == true) and $value <= 2147483647){
			$this->_l_id = $value;
		}
    }
    public function getl_id(){
		return $this->_l_id;
    }

    public function setl_tid($value){
		if((is_int($value) == true or ctype_digit($value) == true) and $value <= 2147483647){
			$this->_l_tid = $value;
		}
    }
    public function getl_tid(){
        return $this->_l_tid;
    }

    public function setl_date($value) {
		if((is_string($value) == true) and (strlen($value) <= 10)){
			$this->_l_date = $value;
		}
    }
    public function getl_date() { 
        return $this->_l_date; 
    }

    public function setl_time($value) {
		if((is_string($value) == true) and (strlen($value) <= 5)){
			$this->_l_time = $value;
		}
    }
    public function getl_time() { 
        return $this->_l_time; 
    }

    public function setl_validate($value){
		if((is_int($value) == true or ctype_digit($value) == true) and $value <= 1){
			$this->_l_validate = $value;
		}
    }
    public function getl_validate(){
		return $this->_l_validate;
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

class ManagementBddLogsTreatments extends crud {
	
	// CREATE
    public function add_logstreatments(LogsTreatments $logsTreatments){
        $query = $this->getDb()->prepare('INSERT INTO logs_treatments (l_tid, l_date, l_time, l_validate) 
            VALUES (:l_tid, :l_date, :l_time, :l_validate)');
			
        $query->bindValue(':l_tid', $logsTreatments->getl_tid(), PDO::PARAM_INT);
	    $query->bindValue(':l_date', $logsTreatments->getl_date(), PDO::PARAM_STR);			
        $query->bindValue(':l_time', $logsTreatments->getl_time(), PDO::PARAM_STR);
	    $query->bindValue(':l_validate', $logsTreatments->getl_validate(), PDO::PARAM_INT);
        
        $query->execute();
	}

	
  	// UPDATE
    public function update_logstreatments(LogsTreatments $logsTreatments){
		$query = $this->getDb()->prepare('UPDATE logs_treatments 
			SET l_tid = :l_tid, l_date = :l_date, l_time = :l_time, l_validate = :l_validate
			WHERE l_id = :l_id');
      
		$query->bindValue(':l_id', $logsTreatments->getl_id(), PDO::PARAM_INT);
		$query->bindValue(':l_tid', $logsTreatments->getl_tid(), PDO::PARAM_INT);
		$query->bindValue(':l_date', $logsTreatments->getl_date(), PDO::PARAM_STR);			
		$query->bindValue(':l_time', $logsTreatments->getl_time(), PDO::PARAM_STR);
		$query->bindValue(':l_validate', $logsTreatments->getl_validate(), PDO::PARAM_INT);

		$query->execute();
	}
}
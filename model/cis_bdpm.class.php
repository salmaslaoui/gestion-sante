<?php
require_once('crud.class.php');

class CisBpdm {
  private $_cis_cis;
  private $_cis_name;
  private $_cis_type;
  private $_cis_take;
  private $_cis_status;
  private $_cis_proc;
  private $_cis_comm;
  private $_cis_date_amm;
  private $_cis_status_bdm;
  private $_cis_ue_number;
  private $_cis_lab;
  private $_cis_watch;

  public function setcis_cis($value){
    $this->_cis_cis = $value;
  }
  public function getcis_cis(){
    return $this->_cis_cis;
  }
  
  public function setcis_name($value){
    $this->_cis_name = $value;
  }
  public function getcis_name(){
    return $this->_cis_name;
  }
  
  public function setcis_type($value){
    $this->_cis_type = $value;
  }
  public function getcis_type(){
    return $this->_cis_type;
  }
  
  public function setcis_take($value){
    $this->_cis_take = $value;
  }
  public function getcis_take(){
    return $this->_cis_take;
  }
  
  public function setcis_status($value){
    $this->_cis_status = $value;
  }
  public function getcis_status(){
    return $this->_cis_status;
  }
  
  public function setcis_proc($value){
    $this->_cis_proc = $value;
  }
  public function getcis_proc(){
    return $this->_cis_proc;
  }
  
  public function setcis_comm($value){
    $this->_cis_comm = $value;
  }
  public function getcis_comm(){
    return $this->_cis_comm;
  }
  
  public function setcis_date_amm($value){
    $this->_cis_date_amm = $value;
  }
  public function getcis_date_amm(){
    return $this->_cis_date_amm;
  }
  
  public function setcis_status_bdm($value){
    $this->_cis_status_bdm = $value;
  }
  public function getcis_status_bdm(){
    return $this->_cis_status_bdm;
  }
  
  public function setcis_ue_number($value){
    $this->_cis_ue_number = $value;
  }
  public function getcis_ue_number(){
    return $this->_cis_ue_number;
  }
  
  public function setcis_lab($value){
    $this->_cis_lab = $value;
  }
  public function getcis_lab(){
    return $this->_cis_lab;
  }
  
  public function setcis_watch($value){
    $this->_cis_watch = $value;
  }
  public function getcis_watch(){
    return $this->_cis_watch;
  }
}

class ManagementBddCisBdpm extends crud{
	// READ
	public function select_cis_by_idcis($id){
		$resultat = [];

		$query = $this->getDb()->prepare('SELECT * FROM cis_bdpm
			WHERE cis_cis = '.$id.'');

		$query->execute();

		if ($query == false) {
			return false;
		} 
		else {
			$resultat = $query->fetchALL(PDO::FETCH_ASSOC);
			return $resultat;
		}
	}
	
	public function select_name_by_idcis($id){
		$resultat = [];

		$query = $this->getDb()->prepare('SELECT cis_name FROM cis_bdpm
			WHERE cis_cis = '.$id.'');

		$query->execute();

		if ($query == false) {
			return false;
		} 
		else {
			$resultat = $query->fetchALL(PDO::FETCH_ASSOC);
			return $resultat;
		}
	}

	public function select_cis_by_cisname($name){
		$resultat = [];

		$query = $this->getDb()->prepare('SELECT * FROM cis_bdpm
			WHERE cis_name LIKE "%'.$name.'%"');
		
		$query->execute();

		if ($query == false) {
			return false;
		} 
		else {
			$resultat = $query->fetchAll(PDO::FETCH_ASSOC);
			return $resultat;
		}
	}
}
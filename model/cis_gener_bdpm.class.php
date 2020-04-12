<?php
require_once('crud.class.php');

class CisGenerBpdm {
  
  private $_cis_gen_id;
  private $_cis_gen_name;
  private $_cis_gen_cis;
  private $_cis_gen_type;
  private $_cis_gen_sort;
  private $_cis_gen_col6;

  public function setcis_gen_id($value){
    $this->_cis_gen_id = $value;
  }
  public function getcis_gen_id(){
    return $this->_cis_gen_id;
  }
  public function setcis_gen_name($value){
    $this->_cis_gen_name = $value;
  }
  public function getcis_gen_name(){
    return $this->_cis_gen_name;
  }
  public function setcis_gen_cis($value){
    $this->_cis_gen_cis = $value;
  }
  public function getcis_gen_cis(){
    return $this->_cis_gen_cis;
  }
  public function setcis_gen_type($value){
    $this->_cis_gen_type = $value;
  }
  public function getcis_gen_type(){
    return $this->_cis_gen_type;
  }
  public function setcis_gen_sort($value){
    $this->_cis_gen_sort = $value;
  }
  public function getcis_gen_sort(){
    return $this->_cis_gen_sort;
  }
  public function setcis_gen_col6($value){
    $this->_cis_gen_col6 = $value;
  }
  public function getcis_gen_col6(){
    return $this->_cis_gen_col6;
  }
}

class ManagementBddCisGenerBdpm extends crud{
  public function select_cis_gener_by_idcis($id){
    $resultat = [];

    $query = $this->getDb()->prepare('SELECT * FROM cis_gener_bdpm
        WHERE cis_gen_cis = '.$id.'');

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
<?php
require_once('crud.class.php');

class CisCompoBpdm {
  
  private $_cis_comp_cis;
  private $_cis_comp_type;
  private $_cis_comp_code;
  private $_cis_comp_sub;
  private $_cis_comp_dosage;
  private $_cis_comp_ref;
  private $_cis_comp_nature;
  private $_cis_comp_link_number;
  private $_cis_comp_col9;

  public function setcis_comp_cis($value){
    $this->_cis_comp_cis = $value;
  }
  public function getcis_comp_cis(){
    return $this->_cis_comp_cis;
  }
  public function setcis_comp_type($value){
    $this->_cis_comp_type = $value;
  }
  public function getcis_comp_type(){
    return $this->_cis_comp_type;
  }
  public function setcis_comp_code($value){
    $this->_cis_comp_code = $value;
  }
  public function getcis_comp_code(){
    return $this->_cis_comp_code;
  }
  public function setcis_comp_sub($value){
    $this->_cis_comp_sub = $value;
  }
  public function getcis_comp_sub(){
    return $this->_cis_comp_sub;
  }
  public function setcis_comp_dosage($value){
    $this->_cis_comp_dosage = $value;
  }
  public function getcis_comp_dosage(){
    return $this->_cis_comp_dosage;
  }
  public function setcis_comp_ref($value){
    $this->_cis_comp_ref = $value;
  }
  public function getcis_comp_ref(){
    return $this->_cis_comp_ref;
  }
  public function setcis_comp_nature($value){
    $this->_cis_comp_nature = $value;
  }
  public function getcis_comp_nature(){
    return $this->_cis_comp_nature;
  }
  public function setcis_comp_link_number($value){
    $this->_cis_comp_link_number = $value;
  }
  public function getcis_comp_link_number(){
    return $this->_cis_comp_link_number;
  }
  public function setcis_comp_col9($value){
    $this->_cis_comp_col9 = $value;
  }
  public function getcis_comp_col9(){
    return $this->_cis_comp_col9;
  }
}

class ManagementBddCisCompoBdpm extends crud{
  public function select_cis_compo_by_idcis($id){
    $resultat = [];

    $query = $this->getDb()->prepare('SELECT * FROM cis_compo_bdpm
        WHERE cis_comp_cis = '.$id.'');

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
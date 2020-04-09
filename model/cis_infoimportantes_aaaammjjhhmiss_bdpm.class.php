<?php
require_once('crud.class.php');

class CisInfoImportantesAAAAMMJJhhmissBpdm {

  private $_cis_ii_cis;
  private $_cis_ii_start_date;
  private $_cis_ii_end_date;
  private $_cis_ii_desc;

  public function setcis_ii_cis($value){
    $this->_cis_ii_cis = $value;
  }
  public function getcis_ii_cis(){
    return $this->_cis_ii_cis;
  }
  public function setcis_ii_start_date($value){
    $this->_cis_ii_start_date = $value;
  }
  public function getcis_ii_start_date(){
    return $this->_cis_ii_start_date;
  }
  public function setcis_ii_end_date($value){
    $this->_cis_ii_end_date = $value;
  }
  public function getcis_ii_end_date(){
    return $this->_cis_ii_end_date;
  }
  public function setcis_ii_desc($value){
    $this->_cis_ii_desc = $value;
  }
  public function getcis_ii_desc(){
    return $this->_cis_ii_desc;
  }
}

class ManagementBddCisInfoImportantesAAAAMMJJhhmissBdpm extends crud{
  public function select_cis_infoImportantes_aaaammjjhhmiss_by_idcis($id){
    $resultat = [];

    $query = $this->getDb()->prepare('SELECT * FROM cis_infoImportantes_aaaammjjhhmiss_bdpm
        WHERE cis_ii_cis = '.$id.'');

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
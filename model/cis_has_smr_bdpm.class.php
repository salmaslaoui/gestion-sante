<?php
require_once('crud.class.php');

class CisHasSmrBpdm {

  private $_cis_hs_cis;
  private $_cis_hs_file;
  private $_cis_hs_motive;
  private $_cis_hs_date;
  private $_cis_hs_value;
  private $_cis_hs_desc;

  public function setcis_hs_cis($value){
    $this->_cis_hs_cis = $value;
  }
  public function getcis_hs_cis(){
    return $this->_cis_hs_cis;
  }
  public function setcis_hs_file($value){
    $this->_cis_hs_file = $value;
  }
  public function getcis_hs_file(){
    return $this->_cis_hs_file;
  }
  public function setcis_hs_motive($value){
    $this->_cis_hs_motive = $value;
  }
  public function getcis_hs_motive(){
    return $this->_cis_hs_motive;
  }
  public function setcis_hs_date($value){
    $this->_cis_hs_date = $value;
  }
  public function getcis_hs_date(){
    return $this->_cis_hs_date;
  }
  public function setcis_hs_value($value){
    $this->_cis_hs_value = $value;
  }
  public function getcis_hs_desc(){
    return $this->_cis_hs_desc;
  }
  public function setcis_hs_desc($value){
    $this->_cis_hs_desc = $value;
  }
  public function getcis_hs_value(){
    return $this->_cis_hs_value;
  }
}

class ManagementBddCisHasSmrBdpm extends crud{
  public function select_cis_has_smr_by_idcis($id){
    $resultat = [];

    $query = $this->getDb()->prepare('SELECT * FROM cis_has_smr_bdpm
        WHERE cis_hs_cis ='.$id.'');

    $query->execute();

    if ($query == false) {
      return false;
    } 
	else {
      $resultat = $query->fetchAll(PDO::FETCH_ASSOC);
      return $resultat;
    }
  }

  public function select_cis_has_smr_by_dossier($file){
    $resultat = [];

    $query = $this->getDb()->prepare('SELECT * FROM cis_has_smr_bdpm
        WHERE cis_hs_file = '.$file.'');

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
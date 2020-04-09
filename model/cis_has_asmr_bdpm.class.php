<?php
require_once('crud.class.php');

class CisHasAsmrBpdm {

  private $_cis_ha_cis;
  private $_cis_ha_file;
  private $_cis_ha_motive;
  private $_cis_ha_date;
  private $_cis_ha_value;
  private $_cis_ha_desc;

  public function setcis_ha_cis($value){
    $this->_cis_ha_cis = $value;
  }
  public function getcis_ha_cis(){
    return $this->_cis_ha_cis;
  }
  public function setcis_ha_file($value){
    $this->_cis_ha_file = $value;
  }
  public function getcis_ha_file(){
    return $this->_cis_ha_file;
  }
  public function setcis_ha_motive($value){
    $this->_cis_ha_motive = $value;
  }
  public function getcis_ha_motive(){
    return $this->_cis_ha_motive;
  }
  public function setcis_ha_date($value){
    $this->_cis_ha_date = $value;
  }
  public function getcis_ha_date(){
    return $this->_cis_ha_date;
  }
  public function setcis_ha_value($value){
    $this->_cis_ha_value = $value;
  }
  public function getcis_ha_value(){
    return $this->_cis_ha_value;
  }
  public function setcis_ha_desc($value){
    $this->_cis_ha_desc = $value;
  }
  public function getcis_ha_desc(){
    return $this->_cis_ha_desc;
  }
}

class ManagementBddCisHasAsmrBdpm extends crud{
  public function select_cis_has_asmr_by_idcis($id){
    $resultat = [];

    $query = $this->getDb()->prepare('SELECT * FROM cis_has_asmr_bdpm
        WHERE cis_ha_cis = '.$id.'');

    $query->execute();

    if ($query == false) {
      return false;
    } 
	else {
      $resultat = $query->fetchAll(PDO::FETCH_ASSOC);
      return $resultat;
    }
  }

  public function select_cis_has_asmr_by_dossier($file){
    $resultat = [];

    $query = $this->getDb()->prepare('SELECT * FROM cis_has_asmr_bdpm
        WHERE cis_ha_file = '.$file.'');

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
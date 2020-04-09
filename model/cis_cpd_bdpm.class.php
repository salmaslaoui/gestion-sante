<?php
require_once('crud.class.php');

class CisCpdBpdm {

  private $_cis_cpd_cis;
  private $_cis_cpd_cond;

  public function setcis_cpd_cis($value){
    $this->_cis_cpd_cis = $value;
  }
  public function getcis_cpd_cis(){
    return $this->_cis_cpd_cis;
  }
  public function setcis_cpd_cond($value){
    $this->_cis_cpd_cond = $value;
  }
  public function getcis_cpd_cond(){
    return $this->_cis_cpd_cond;
  }
}

class ManagementBddCisCpdBdpm extends crud{
  public function select_cis_cpd_by_idcis($id){
    $resultat = [];

    $query = $this->getDb()->prepare('SELECT * FROM cis_cpd_bdpm
        WHERE cis_cpd_cis = '.$id.'');

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
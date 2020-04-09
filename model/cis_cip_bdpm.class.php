<?php
require_once('crud.class.php');

class CisCipBpdm {

  private $_cis_cip_cis;
  private $_cis_cip_cip7;
  private $_cis_cip_name;
  private $_cis_cip_admin;
  private $_cis_cip_comm;
  private $_cis_cip_date;
  private $_cis_cip_cip13;
  private $_cis_cip_community;
  private $_cis_cip_refund;
  private $_cis_cip_price;
  private $_cis_cip_price2;
  private $_cis_cip_price3;
  private $_cis_cip_law;

  public function setcis_cip_cis($value){
    $this->_cis_cip_cis = $value;
  }
  public function getcis_cip_cis(){
    return $this->_cis_cip_cis;
  }
  public function setcis_cip_cip7($value){
    $this->_cis_cip_cip7 = $value;
  }
  public function getcis_cip_cip7(){
    return $this->_cis_cip_cip7;
  }
  public function setcis_cip_name($value){
    $this->_cis_cip_name = $value;
  }
  public function getcis_cip_name(){
    return $this->_cis_cip_name;
  }
  public function setcis_cip_admin($value){
    $this->_cis_cip_admin = $value;
  }
  public function getcis_cip_admin(){
    return $this->_cis_cip_admin;
  }
  public function setcis_cip_comm($value){
    $this->_cis_cip_comm = $value;
  }
  public function getcis_cip_commn(){
    return $this->_cis_cip_comm;
  }
  public function setcis_cip_date($value){
    $this->_cis_cip_date = $value;
  }
  public function getcis_cip_date(){
    return $this->_cis_cip_date;
  }
  public function setcis_cip_cip13($value){
    $this->_cis_cip_cip13 = $value;
  }
  public function getcis_cip_cip13(){
    return $this->_cis_cip_cip13;
  }
  public function setcis_cip_community($value){
    $this->_cis_cip_community = $value;
  }
  public function getcis_cip_community(){
    return $this->_cis_cip_community;
  }
  public function setcis_cip_refund($value){
    $this->_cis_cip_refund = $value;
  }
  public function getcis_cip_refund(){
    return $this->_cis_cip_refund;
  }
  public function setcis_cip_price($value){
    $this->_cis_cip_price = $value;
  }
  public function getcis_cip_price(){
    return $this->_cis_cip_price;
  }
  public function setcis_cip_price2($value){
    $this->_cis_cip_price2 = $value;
  }
  public function getcis_cip_price2(){
    return $this->_cis_cip_price2;
  }
  public function setcis_cip_price3($value){
    $this->_cis_cip_price3 = $value;
  }
  public function getcis_cip_price3(){
    return $this->_cis_cip_price3;
  }
  public function setcis_cip_law($value){
    $this->_cis_cip_law = $value;
  }
  public function getcis_cip_law(){
    return $this->_cis_cip_law;
  }
}

class ManagementBddCisCipBdpm extends crud{
  public function select_cis_cip_by_idcis($id){
    $resultat = [];

    $query = $this->getDb()->prepare('SELECT * FROM cis_cip_bdpm
        WHERE cis_cip_cis ='.$id.'');

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
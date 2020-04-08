<?php
require_once('crud.class.php');

class Countries {

  private $_c_id;
  private $_c_code;
  private $_c_alpha2;
  private $_c_alpha3;
  private $_c_name_en;
  private $_c_name_fr;

  public function setc_id($value){
    $this->_c_id = $value;
  }
  public function getc_id(){
    return $this->_c_id;
  }

  public function setc_code($value){
    $this->_c_code = $value;
  }
  public function getc_code(){
    return $this->_c_code;
  }

  public function setc_alpha2($value){
    $this->_c_alpha2 = $value;
  }
  public function getc_alpha2(){
    return $this->_c_alpha2;
  }

  public function setc_alpha3($value){
    $this->_c_alpha3 = $value;
  }
  public function getc_alpha3(){
    return $this->_c_alpha3;
  }

  public function setc_name_en($value){
    $this->_c_name_en = $value;
  }
  public function getc_name_en(){
    return $this->_c_name_en;
  }
  
  public function setc_name_fr($value){
    $this->_c_name_fr = $value;
  }
  public function getc_name_fr(){
    return $this->_c_name_fr;
  }
}

class ManagementBddCountries extends crud{
  public function select_country_by_id($id){
    $resultat = [];

    $query = $this->getDb()->prepare('SELECT * FROM countries
        WHERE c_id = :c_id');

    $query->BindValue(':c_id', $id, PDO::PARAM_INT);

    $query->execute();

    if ($query == false) {
      return false;
    } 
	else {
      $resultat = $query->fetch(PDO::FETCH_ASSOC);
      return $resultat;
    }
  }

  public function select_country_by_code($code){
    $resultat = [];

    $query = $this->getDb()->prepare('SELECT * FROM countries
        WHERE c_code = :c_code');

    $query->BindValue(':c_code', $code, PDO::PARAM_INT);

    $query->execute();

    if ($query == false) {
      return false;
    } 
	else {
      $resultat = $query->fetch(PDO::FETCH_ASSOC);
      return $resultat;
    }
  }

  public function select_country_by_name_fr($name_fr){
    $resultat = [];

    $query = $this->getDb()->prepare('SELECT * FROM countries
        WHERE c_name_fr = :c_name_fr');

    $query->BindValue(':c_name_fr', $name_fr, PDO::PARAM_STR);

    $query->execute();

    if ($query == false) {
      return false;
    } 
	else {
      $resultat = $query->fetch(PDO::FETCH_ASSOC);
      return $resultat;
    }
  }

  public function select_country_by_name_en($name_en)
  {
    $resultat = [];

    $query = $this->getDb()->prepare('SELECT * FROM countries
        WHERE c_name_en = :c_name_en');

    $query->BindValue(':c_name_fr', $name_en, PDO::PARAM_STR);

    $query->execute();

    if ($query == false) {
      return false;
    } 
	else {
      $resultat = $query->fetch(PDO::FETCH_ASSOC);
      return $resultat;
    }
  }
}

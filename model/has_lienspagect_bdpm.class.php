<?php
require_once('crud.class.php');

class HasLienPageCTBpdm {

  private $_has_file;
  private $_has_link;

  public function sethas_file($value){
    $this->_has_file = $value;
  }
  public function gethas_file(){
    return $this->_has_file;
  }
  public function sethas_link($value){
    $this->_has_link = $value;
  }
  public function gethas_link(){
    return $this->_has_link;
  }
}

class ManagementBddHasLienPageCTBdpm extends crud{
  public function select_liens_page_by_code_dossier($code){
    $resultat = [];

    $query = $this->getDb()->prepare('SELECT * FROM has_lienspagect_bdpm
        WHERE has_file = '.$code.'');

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
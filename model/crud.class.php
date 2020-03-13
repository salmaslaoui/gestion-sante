<?php
class crud {
    
    protected $_db;

    public function __construct($database) {
        $this->_db = $database;
    }

    public function setDb(PDO $database) {
        $this->_db = $database;
    }
    
    public function getDb() {
        if ($this->_db instanceof PDO) {
            return $this->_db;
        }
    }
    
    
    public function connect_to_bdd($username , $password) {
        $query = $this->getDb()->prepare('SELECT * FROM users 
            WHERE u_name = :u_name 
            AND u_password = :u_password');
            
        $query->BindValue(':u_name', $username, PDO::PARAM_STR);
        $query->BindValue(':u_password', $password, PDO::PARAM_STR);
            
        $query->execute();
        
        $count = $query->rowcount();
        if($count == 1){
            $userinfo = $query->fetch(PDO::FETCH_ASSOC);
            $_SESSION['u_id'] = (int) $userinfo['u_id'];
            $_SESSION['u_name'] = $userinfo['u_name'];
            header('Location: accueil.php');
        }
        else {
            $error = "Mauvais nom d'utilisateur ou mot de passe.";
        }
    }
	
    public function select_all($nom_table){
        $resultat = [];
        
        switch($nom_table){
            case "accounts" :
                $nom_table = "accounts";
                break;
            
            case "cis_bdpm" :
                $nom_table = "cis_bdpm";
                break;
				
            case "cis_cip_bdpm" :
                $nom_table = "cis_cip_bdpm";
                break;
			
			case "cis_compo_bdpm" :
                $nom_table = "cis_compo_bdpm";
                break;
			
			case "cis_cpd_bdpm" :
                $nom_table = "cis_cpd_bdpm";
                break;
			
			case "cis_gener_bdpm" :
                $nom_table = "cis_gener_bdpm";
                break;
			
			case "cis_har_smr_bdpm" :
                $nom_table = "cis_har_smr_bdpm";
                break;
			
			case "cis_has_asmr_bdpm" :
                $nom_table = "cis_has_asmr_bdpm";
                break;
			
			case "cis_infoimportantes_aaammjjhhmiss_bdpm" :
                $nom_table = "cis_infoimportantes_aaammjjhhmiss_bdpm";
                break;
			
			case "countries" :
                $nom_table = "countries";
                break;
			
			case "has_lienspagect_bdpm" :
                $nom_table = "has_lienspagect_bdpm";
                break;
			
			case "inoculations" :
                $nom_table = "inoculations";
                break;
			
			case "journeys" :
                $nom_table = "journeys";
                break;
			
			case "storages" :
                $nom_table = "storages";
                break;
			
			case "treatments" :
                $nom_table = "treatments";
                break;
			
			case "users" :
                $nom_table = "users";
                break;
			
			case "vaccines" :
                $nom_table = "vaccines";
                break;
        }
        
        $query = $this->getDb()->prepare("SELECT * FROM $nom_table");
        
        $query->execute();

        if($query == false){
            return false;
        }
		else {
            $resultat = $query->fetchAll(PDO::FETCH_ASSOC);
            return $resultat;
        }
    }
	
    public function select_all_with_id($nom_table , $val_id){
        $resultat = [];
        
        $nom_id;
        
        switch($nom_table){
            case "accounts" :
                $nom_table = "accounts";
				$nom_id = "a_id";
                break;
            
			case "countries" :
                $nom_table = "countries";
				$nom_id = "c_id";
                break;
			
			case "inoculations" :
                $nom_table = "inoculations";
				$nom_id = "i_id";
                break;
			
			case "journeys" :
                $nom_table = "journeys";
				$nom_id = "j_id";
                break;
			
			case "storages" :
                $nom_table = "storages";
				$nom_id = "s_id";
                break;
			
			case "treatments" :
                $nom_table = "treatments";
				$nom_id = "t_id";
                break;
			
			case "users" :
                $nom_table = "users";
				$nom_id = "u_id";
                break;
			
			case "vaccines" :
                $nom_table = "vaccines";
				$nom_id = "v_id";
                break;
        }
        
        $query = $this->getDb()->prepare("SELECT * FROM $nom_table 
            WHERE $nom_id = :val_id");
        
        $query->BindValue(':val_id', $val_id, PDO::PARAM_INT);

        $query->execute();
        
        if($query == false){
            return false;
        } else {
            $resultat = $query->fetchAll(PDO::FETCH_ASSOC);
            return $resultat;
        }
    }
	
    public function select_all_with_cis($nom_table , $val_str){
        $resultat = [];
        
        $nom_str;
        
        switch($nom_table){
            case "cis_bdpm" :
                $nom_table = "cis_bdpm";
				$nom_id = "cis_cis";
                break;
				
            case "cis_cip_bdpm" :
                $nom_table = "cis_cip_bdpm";
				$nom_id = "cis_cip_cis13";
                break;
			
			case "cis_compo_bdpm" :
                $nom_table = "cis_compo_bdpm";
				$nom_id = "cis_comp_cis";
                break;
			
			case "cis_cpd_bdpm" :
                $nom_table = "cis_cpd_bdpm";
				$nom_id = "cis_cpd_cis";
                break;
			
			case "cis_gener_bdpm" :
                $nom_table = "cis_gener_bdpm";
				$nom_id = "cis_gen_cis";
                break;
			
			case "cis_har_smr_bdpm" :
                $nom_table = "cis_har_smr_bdpm";
				$nom_id = "cis_hs_cis";
                break;
			
			case "cis_has_asmr_bdpm" :
                $nom_table = "cis_has_asmr_bdpm";
				$nom_id = "cis_ha_cis";
                break;
			
			case "cis_infoimportantes_aaammjjhhmiss_bdpm" :
                $nom_table = "cis_infoimportantes_aaammjjhhmiss_bdpm";
				$nom_id = "cis_ii_cis";
                break;
			
			case "has_lienspagect_bdpm" :
                $nom_table = "has_lienspagect_bdpm";
				$nom_id = "has_file";
                break;
        }
        
        $query = $this->getDb()->prepare("SELECT * FROM $nom_table 
            WHERE $nom_str = :val_str");
        
        $query->BindValue(':val_str', $val_str, PDO::PARAM_STR);
        
        $query->execute();
        
        if($query == false){
            return false;
        }
		else {
            $resultat = $query->fetch(PDO::FETCH_ASSOC);
            return $resultat;
        }
    }
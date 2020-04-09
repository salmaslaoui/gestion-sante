<?php
require_once('crud.class.php');

class Users {

    private $_u_id;
	private $_u_name;
	private $_u_password;
	private $_u_mail;
	
	public function setu_id($value){
        if((is_int($value) == true or ctype_digit($value) == true) and $value <= 2147483647){
            $this->_u_id = $value;
        }
	}
	public function getu_id(){ 
        return $this->_u_id; 
	}
	
	public function setu_name($value){
        if((is_string($value) == true) and (strlen($value) <= 255)){
            $this->_u_name = $value;
        }
	}
	public function getu_name(){ 
        return $this->_u_name; 
	}
	
	public function setu_password($value){
        if((is_string($value) == true) and (strlen($value) <= 255)){
            $this->_u_password = $value;
        }
	}
	public function getu_password(){ 
        return $this->_u_password; 
	}
	
	public function setu_mail($value){
        if((is_string($value) == true) and (strlen($value) <= 255)){
            $this->_u_mail = $value;
        }
	}
	public function getu_mail(){ 
        return $this->_u_mail; 
	}
	
	public function hydrate(array $donnees) {
		foreach($donnees as $key => $value) {
			$method = 'set'.($key); 
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}
}


class ManagementBddUsers extends crud {

    // CREATE
    public function add_user(Users $users, $pass2){
		$query = $this->getDb()->prepare('SELECT COUNT(*) AS TAB FROM users 
            WHERE u_name = :u_name');
			
		$query->BindValue(':u_name', $users->getu_name(), PDO::PARAM_STR);
		
		$query->execute();
		
		$resultat = $query->fetchAll(PDO::FETCH_ASSOC);		
		
		if($resultat[0]['TAB'] == 0){	
			if(preg_match("/^([\w-\.]+)@((?:[\w]+\.)+)([a-zA-Z]{2,4})/i", $users->getu_mail())){
				$query2 = $this->getDb()->prepare('SELECT COUNT(*) AS TAB FROM users 
					WHERE u_mail = :u_mail');
					
				$query2->BindValue(':u_mail', $users->getu_mail(), PDO::PARAM_STR);
				
				$query2->execute();
				
				$resultat2 = $query->fetchAll(PDO::FETCH_ASSOC);

				if(empty($resultat2) == true){
					if(strlen($users->getu_password()) >= 8 AND strlen($users->getu_password()) <= 20){
						if(preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,20}$/", $users->getu_password())){
							if($users->getu_password() == $pass2){
								$cryptpass = password_hash($users->getu_password(), PASSWORD_DEFAULT);
								
								$query3 = $this->getDb()->prepare('INSERT INTO users (u_name, u_password, u_mail) 
									VALUES (:u_name, :u_password, :u_mail)');

								$query3->bindValue(':u_name', $users->getu_name(), PDO::PARAM_STR);			
								$query3->bindValue(':u_password', $cryptpass, PDO::PARAM_STR);
								$query3->bindValue(':u_mail', $users->getu_mail(), PDO::PARAM_STR);
								
								$query3->execute();
								echo "Inscription réussie, connectez-vous !";
							}
							else {
								echo "Vos mots de passe ne sont pas identiques.";
							}
						}
						else {
							echo "Votre mot de passe doit contenir au moins une lettre minuscule, une lettre majuscule et un chiffre. Il peut contenir des caractères spéciaux.";
						}
					}
					else {
						echo "Votre mot de passe doit contenir entre 8 et 20 caractères.";
					}
				}
				else {
					echo "Cette adresse mail est déjà utilisée.";
				}
			}
			else {
				echo "Veuillez renseigner une adresse mail valide.";
			}
		}
		else {
			echo "Ce nom de compte est déjà utilisé.";
		}
	}
	
	
    // UPDATE
    public function update_user(Users $users){
        $query = $this->getDb()->prepare('UPDATE users 
            SET u_name = :u_name, u_password = :u_password, u_mail = :u_mail
            WHERE u_id = :u_id');
            
		$query->bindValue(':u_id', $users->getu_id(), PDO::PARAM_INT);
        $query->bindValue(':u_name', $users->getu_name(), PDO::PARAM_STR);			
        $query->bindValue(':u_password', $users->getu_password(), PDO::PARAM_STR);
        $query->bindValue(':u_mail', $users->getu_mail(), PDO::PARAM_STR);

        $query->execute();
	}

   
    // READ
    public function connect_to($username , $password) {
		$query = $this->getDb()->prepare('SELECT COUNT(*) AS TAB FROM users 
            WHERE u_name = :u_name');
			
		$query->BindValue(':u_name', $username, PDO::PARAM_STR);
		
		$query->execute();
		
		$resultat = $query->fetchAll(PDO::FETCH_ASSOC);
		
		if($resultat[0]['TAB'] == 1){
            $query2 = $this->getDb()->prepare('SELECT * FROM users 
            WHERE u_name = :u_name');
			
			$query2->BindValue(':u_name', $username, PDO::PARAM_STR);
		
			$query2->execute();
			
			$resultat2 = $query2->fetchAll(PDO::FETCH_ASSOC);

			if(password_verify($password, $resultat2[0]['u_password'])){
				$id = (int) $resultat2[0]['u_id'];
				$_SESSION['u_id'] = $id;
				$_SESSION['u_name'] = $resultat2[0]['u_name'];

				$query3 = $this->getDb()->prepare('SELECT * FROM accounts 
					WHERE a_uid = :a_uid
					ORDER BY a_id ASC
					LIMIT 1');
					
				$query3->BindValue(':a_uid', $id, PDO::PARAM_INT);
				
				$query3->execute();
				
				$resultat3 = $query3->fetchAll(PDO::FETCH_ASSOC);
				
				$_SESSION['a_id'] = $resultat3[0]['a_id'];
				$_SESSION['a_name'] = $resultat3[0]['a_name'];
				$_SESSION['a_first_name'] = $resultat3[0]['a_first_name'];
				
				echo "Connexion réussie, bienvenue !";
				//header('Location: accueil.php');
			}
			else {
				echo "Erreur de mot de passe.";
			}
        }
		else {
			echo "Erreur de nom de compte.";
        }
    }
	
	public function get_email($email){
		$resultat = [];
		
		$query = $this->getDb()->prepare('SELECT u_mail FROM users
			WHERE u_mail = :u_mail');
		
		$query->bindValue(':u_mail', $email, PDO::PARAM_STR);
		
		$query->execute();
		
		if($query == false){
            return false;
        }
		else {
            $resultat = $query->fetchAll(PDO::FETCH_ASSOC);
            return $resultat;
        }
	}
	
	public function get_last_add(){
		$resultat = [];
		
		$query = $this->getDb()->prepare('SELECT * FROM users 
			ORDER BY u_id DESC 
			LIMIT 1');
		
		$query->execute();
		
		if($query == false){
            return false;
        }
		else {
            $resultat = $query->fetchAll(PDO::FETCH_ASSOC);
            return $resultat;
        }
	}
}
<?php
class User extends Objects {

	private $sTable;

	public function __construct()
	{
		$this->sTable = TABLE_USR;
	}


	public function infoUser($id){
		global $db;
		global $cmn;
		
		$param = array("usr_id"=>$id);
		$user= $db->sqlSingleResult("SELECT * FROM ".$this->sTable." WHERE usr_id = ?",$param);
		return $user;
	}
	
	public function loginUser($login, $pwd){
		global $db;
		global $cmn;	
		
		$pass= $cmn->cryptPass($pwd);
		
		$param = array(
					"usr_iSta"=>1,
					"usr_sPass"=>$pass,
					"usr_sEmail"=>$login,
					"usr_sPseudo"=>$login
					);
		$user= $db->sqlSingleResult("SELECT * FROM ".$this->sTable." WHERE usr_iSta = ? AND usr_sPass = ? AND (usr_sEmail = ? OR usr_sPseudo = ?)",$param);
		if(!$user){
			return false;
		}
		else{
			$_SESSION["usr"] = $user->usr_id;
			return true;
		}
	}	
	
	public function changePassUser($dataForm)
	{
		global $db;
		global $cmn;
		
		$nouveau = ($dataForm['nouveau']);
		$ancien = ($dataForm['ancien']);

		$encNouveau = $cmn->cryptPass($nouveau);
		$encAncien = $cmn->cryptPass($ancien);
		$tabParamsVerif = array('usr_sPass' => $encAncien,
			'usr_id' => $_SESSION['usr']);
					
		$verif=$db->sqlSingleResult("SELECT COUNT(usr_id) AS nb FROM ".$this->sTable." WHERE usr_sPass=? AND usr_id=?",$tabParamsVerif);
		if($verif->nb==0){
			return false;
		}
		elseif($verif->nb==1){
			$tabParams = array('usr_sPass' => $encNouveau,
			'usr_id' => $_SESSION['usr']);
			$results = $db->sqlSingleResult('UPDATE '.$this->sTable.' SET usr_sPass = ? WHERE usr_id = ?',$tabParams);
			return true;
		}

	}
	
	
	
	public function editInfoUser($dataForm)
	{
		global $db;
		global $cmn;
		
		
		$nom = trim($dataForm["nom"]);
		$prenom = ucwords(trim($dataForm["prenom"]));
		$email = strtolower(trim($dataForm["email"]));
		$pseudo = trim($dataForm["pseudo"]);
		if($prenom==""){
			$prenom=null;
		}
		$tabParamsVerifEmail = array('usr_sEmail' => $email,
			'usr_id' => $_SESSION['usr']);
			
		$tabParamsVerifPseudo = array('usr_sPseudo' => $pseudo,
			'usr_id' => $_SESSION['usr']);
					
		$verifEmail=$db->sqlSingleResult("SELECT COUNT(usr_id) AS nb FROM ".$this->sTable." WHERE usr_sEmail=? AND usr_id!=?",$tabParamsVerifEmail);
		$verifPseudo=$db->sqlSingleResult("SELECT COUNT(usr_id) AS nb FROM ".$this->sTable." WHERE usr_sPseudo=? AND usr_id!=?",$tabParamsVerifPseudo);
		if($verifEmail->nb!=0){
			return "email";
		}
		else{
			if($verifPseudo->nb!=0){
				return "pseudo";
			}
			else{
				$tabParams = array(
				'usr_sNom' => $nom,
				'usr_sPrenom' => $prenom,
				'usr_sEmail' => $email,
				'usr_sPseudo' => $pseudo,
				'usr_id' => $_SESSION['usr']);
				
				$results = $db->sqlSingleResult('UPDATE '.$this->sTable.' SET usr_sNom=?,usr_sPrenom=?,usr_sEmail=?,usr_sPseudo=? WHERE usr_id = ?',$tabParams);
				return "oui";
			}
			
		}

	}
	
	public function createUser($dataForm)
	{
		global $db;
		global $cmn;		
		
		$pass = $cmn->cryptPass($dataForm["pass"]);
		$nom = strtoupper(trim($dataForm["nom"]));
		$prenom = ucwords(trim($dataForm["prenom"]));
		$email = strtolower(trim($dataForm["email"]));
		$pseudo = trim($dataForm["pseudo"]);
		
		if($prenom==""){$prenom=null;}
		
		$tabParamsVerifEmail = array('usr_sEmail'=> $email, 'usr_iSta'=>1);
		$tabParamsVerifPseudo = array('usr_sPseudo'=> $pseudo, 'usr_iSta'=>1);
					
		$verifEmail=$db->sqlSingleResult("SELECT COUNT(usr_id) AS nb FROM ".$this->sTable." WHERE usr_sEmail=? AND usr_iSta = ? ",$tabParamsVerifEmail);
		$verifPseudo=$db->sqlSingleResult("SELECT COUNT(usr_id) AS nb FROM ".$this->sTable." WHERE usr_sPseudo=? AND usr_iSta = ? ",$tabParamsVerifPseudo);
		if($verifEmail->nb!=0){
			return "email";
		}
		else{
			if($verifPseudo->nb!=0){
				return "pseudo";
			}
			else{
				$tabParams = array(
				'usr_iSta' => 1,
				'usr_sNom' => $nom,
				'usr_sPrenom' => $prenom,
				'usr_sEmail' => $email,
				'usr_sPseudo' => $pseudo,
				'usr_sPass' => $pass
				);
				$results = $db->sqlSingleResult('INSERT INTO '.$this->sTable.'(usr_iSta,usr_sNom,usr_sPrenom,usr_sEmail,usr_sPseudo,usr_sPass,usr_dDateIns) 
				VALUES(?,?,?,?,?,?,CURDATE())',$tabParams);
				return "oui";
			}
			
		}
	}	
}
?>

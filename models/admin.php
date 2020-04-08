<?php
class Admin extends Objects {

	private $sTable;

	public function __construct()
	{
		$this->sTable = TABLE_ADM;
	}

	public function loginAdmin($dataForm)
	{
		global $db;
		global $cmn;
		
		$pass = (trim(htmlspecialchars($dataForm['pass'])));
		$login = (trim(htmlspecialchars($dataForm['login'])));

		$encPass = $cmn->cryptPass($pass);

		$tabParams = array('adm_sEmail' => $login,
							'adm_sPseudo' => $login,
							'adm_sPass' => $encPass,
							'adm_iSta' => 1);

		$result = $db->sqlSingleResult('SELECT * FROM '.$this->sTable.' WHERE (adm_sEmail = ? OR adm_sPseudo = ?) AND adm_sPass = ? AND adm_iSta = ?',$tabParams);
		 // var_dump($result);

		if($result !== false) {
			$_SESSION['adm'] 		= $result->adm_id;
			$_SESSION['role']	= $result->adm_iRole;
			return true;
		}
		else{
			return false;
		}
	}

	public function addAdmin($dataForm)
	{
		global $db;
		global $cmn;
		
		$nom = (trim($dataForm['nom']));
		$prenom = (trim($dataForm['prenom']));
		$email = (trim($dataForm['email']));
		$pseudo = " ";
		$pass = "123456";
		$crypt = $cmn->cryptPass($pass);
		$heure = date('H');
		if($heure >= 0 && $heure <= 17){
			$salutation = 'Bonjour';
		}else if($heure > 17 && $heure <=23){
			$salutation ='Bonsoir';
		}

		if($prenom==""){
			$prenom=null;
		}
		
		$param = array(
			'adm_iSta '=> 1,
			'adm_sNom '=> $nom,
			'adm_sPrenom '=> $prenom,
			'adm_sPass'=> $crypt,
			'adm_sEmail'=> $email,
			'adm_iRole '=> 1,
			'adm_sPhoto'=> 'assets/img/avatar/avatar.png');
			
			$insert = $db->sqlSingleResult('INSERT INTO '.$this->sTable.'(adm_iSta,adm_sNom,adm_sPrenom,adm_sPass,adm_sEmail,adm_sPwdRecovery,adm_iRole,adm_sPhoto,adm_dDateAjout)
																		VALUES(?,?,?,?,?,?,?,CURDATE())', $param);
																		
				$sujet = 'Création d\'un nouvel administrateur E-CINE';
				$contenu = $salutation.' '.$nom.' '.$prenom.', <br>';
				$contenu.= 'Vos identifiants administrateur sont : <br>';
				$contenu.= '1. Email: '.$email.'<br>2. Mot de passe: '.$pass.' <br>';
				$contenu.= '<a href="'+SITE_ROOT_ADMIN+'">Veuillez cliquer sur ce lien pour y accéder</a>';
				
				$retour = $cmn->envoiMail($email,$sujet,$contenu);
				return $retour;
				// return true;
	}


	public function isMailAvailableAdmin($email)
	{
		global $db;
		global $cmn;
		
		$param = array('adm_sEmail'=>$email);
		$verif = $db->sqlSingleResult('SELECT COUNT(adm_id) AS nb FROM '.$this->sTable.' WHERE adm_sEmail = ?', $param);
		return $verif->nb;
	}

	public function isPseudoAvailableAdmin($email)
	{
		global $db;
		global $cmn;
		
		$param = array('adm_sPseudo'=>$email);
		$verif = $db->sqlSingleResult('SELECT COUNT(adm_id) AS nb FROM '.$this->sTable.' WHERE adm_sPseudo = ?', $param);
		return $verif->nb;
	}

	
	public function editProfil($dataForm)
	{
		global $db;
		global $cmn;
		
		$nom = (trim($dataForm['nom']));
		$prenom = (trim($dataForm['prenom']));
		$pseudo = (trim($dataForm['pseudo']));

		if($prenom==""){
			$prenom=null;
		}
		if($pseudo==""){
			$pseudo=" ";
		}
		
		if($_FILES['photo']['name']== ""){
			$tabParams = array('adm_sNom' => $nom,
							'adm_sPrenom' => $prenom,
							'adm_sPseudo' => $pseudo,
							'adm_id' => $_SESSION['adm']);

			$result = $db->sqlSingleResult('UPDATE '.$this->sTable.' SET adm_sNom = ?, adm_sPrenom = ?, adm_sPseudo = ? WHERE adm_id = ?',$tabParams);
			return true;
		}
		else{
			
			$destination = '../assets/img/avatar/';
			$image = $cmn->uploadFile($_FILES['photo'],$destination);
			if($image != false){
						$tabParams = array('adm_sNom' => $nom,
							'adm_sPrenom' => $prenom,
							'adm_sPseudo' => $pseudo,
							'adm_sPhoto' => 'assets/img/avatar/'.$image,
							'adm_id' => $_SESSION['adm']);

			$result = $db->sqlSingleResult('UPDATE '.$this->sTable.' SET adm_sNom = ?, adm_sPrenom = ?, adm_sPseudo = ?, adm_sPhoto = ? WHERE adm_id = ?',$tabParams);
				return true;
			}else{
				return false;
			}
		}

	}
	
	//réinitialisation du mot de passe d'un admin secondaire
	
	public function resetPassAdmin($dataForm)
	{
		global $db;
		global $cmn;
		
		$pass = "123456";
		$adm = ($dataForm['id']);
		$crypt = $cmn->cryptPass($pass);
	
			$tabParams = array('adm_sPass' => $crypt,
							'adm_id' => $adm);

			$result = $db->sqlSingleResult('UPDATE '.$this->sTable.' SET adm_sPass = ? WHERE adm_id = ?',$tabParams);
	}
	
	public function changePass($pass)
	{
		global $db;
		global $cmn;
		
		$nouveau = (trim($pass));
		$encNouveau = $cmn->cryptPass($nouveau);

			
						$tabParams = array('adm_sPass' => $encNouveau,
							'adm_id' => $_SESSION['adm']);

			$results = $db->sqlSingleResult('UPDATE '.$this->sTable.' SET adm_sPass = ? WHERE adm_id = ?',$tabParams);
	}
	
	
	public function changePassVerif($pass)
	{
		global $db;
		global $cmn;
		
		$ancien = (trim($pass));
		$encAncien = $cmn->cryptPass($ancien);

		$tabParamsVerif = array('adm_sPass' => $encAncien,
							'adm_id' => $_SESSION['adm']);

		$result = $db->sqlSingleResult('SELECT COUNT(adm_id) AS nb FROM '.$this->sTable.' WHERE adm_sPass = ? AND adm_id = ?',$tabParamsVerif);
		 // var_dump($result);

		if($result->nb == 1) {
			return true;
		}
		else{
			return false;
		}
	}
	
	
	public function principal($dataForm)
	{
		global $db;
		global $cmn;
		
		$secondaire = ($dataForm['adm']);
		$pass = (trim($dataForm['pass']));
		$principal = $_SESSION['adm'];

		$encPass = $cmn->cryptPass($pass);

		$tabParamsVerif = array('adm_sPass' => $encPass,
							'adm_id' => $_SESSION['adm']);

		$result = $db->sqlSingleResult('SELECT * FROM '.$this->sTable.' WHERE adm_sPass = ? AND adm_id = ?',$tabParamsVerif);
		 // var_dump($result);

		if(!$result) {
			return false;
		}
		else{
			
			$tabParams1 = array('adm_iRole' => 1,
								'adm_id' => $principal);

			$result1 = $db->sqlSingleResult('UPDATE '.$this->sTable.' SET adm_iRole = ? WHERE adm_id = ?',$tabParams1);
			
			$tabParams = array('adm_iRole' => 0,
								'adm_id' => $secondaire);

			$result2 = $db->sqlSingleResult('UPDATE '.$this->sTable.' SET adm_iRole = ? WHERE adm_id = ?',$tabParams);
			
			$_SESSION = array();
			session_destroy();
			setcookie('login','');
			setcookie('pass','');
			return true;
		}
	}

}
?>

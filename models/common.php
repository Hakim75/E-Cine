<?php
class Common {


	public function __construct()
	{

	}

	public function logout()
	{
		unset($_SESSION);
		session_destroy();
		session_start();

		return true;
	}

	public function echappe($string)
	{
		return str_replace("'","''",$string);
	}

	public function text($string) {
		$searched = array('&lt;','&gt;');
		$replaced = array('<','>');

		$string = htmlspecialchars($string, ENT_QUOTES, "UTF-8");
		$string = str_replace($searched,$replaced,$string);

		return $string;
	}

	public function upload($file,$destination_dir) {
		$tmp_name = $file['tmp_name'];
		$extension = substr($file['name'],strpos($file['name'],'.'));

		$name 	  = uniqid().$extension;

		move_uploaded_file($tmp_name,$destination_dir.$name);
		
		return $name;
	}
	
	
	
	public function retournemois($mois){
		global $db;
		global $cmn;
		
		if($mois=='-01-'){return 'janvier';}
		if($mois=='-02-'){return 'février';}		
		if($mois=='-03-'){return 'mars';}
		if($mois=='-04-'){return 'avril';}		
		if($mois=='-05-'){return 'mai';}
		if($mois=='-06-'){return 'juin';}		
		if($mois=='-07-'){return 'juillet';}
		if($mois=='-08-'){return 'aout';}
		if($mois=='-09-'){return 'septembre';}
		if($mois=='-10-'){return 'octobre';}
		if($mois=='-11-'){return 'novembre';}
		if($mois=='-12-'){return 'décembre';}
		
	}
	
	
	
	//redirectionner & renommer une image
	
	public function uploadFile($file,$destination,$supp){
		// $destination = dirname(__DIR__).$destination_dir;
		 $extre = explode('.',$file['name']);
		$verif = array('png','jpg','jpeg','PNG','JPG','JPEG');
		 if(in_array(end($extre),$verif)){
			$fichier = $supp.round(microtime(true)).'.'.end($extre);
			move_uploaded_file($file['tmp_name'], $destination . $fichier);
			return $fichier;
		 }
		 else{
			return false;
		 }
		
	}	
	
	public function uploadVideo($file,$destination,$supp){
		// $destination = dirname(__DIR__).$destination_dir;
		 $extre = explode('.',$file['name']);
		$verif = array('mp4','webm','ogg','MP4','WEBM','OGG');
		 if(in_array(end($extre),$verif)){
			$fichier = $supp.round(microtime(true)).'.'.end($extre);
			move_uploaded_file($file['tmp_name'], $destination . $fichier);
			return $fichier;
		 }
		 else{
			return false;
		 }
		
	}

	public function sizeImage($file,$t){
		// $destination = dirname(__DIR__).$destination_dir;
		$taille = $file['size'];
		$autorise = 1024*$t;
		if($taille<=$autorise){
			return true;
		}
		else{
			return false;
		}
	}	

	public function forUrl($string) {
		$string = str_replace('é','e',$string);
		$string = str_replace('?','e',$string);
		$string = $this->noAccent($string);
		$string = strtolower($string);
		$string = str_replace(' ','-',$string);
		$string = str_replace(',','-',$string);
		$string = str_replace("'",'-',$string);
		$string = str_replace('--','-',$string);
		$string = str_replace('_','-',$string);
											
		return $string;
	}

	public function noAccent($string){
		$string = utf8_decode($string);
		$string =  strtr($string,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ?',
	'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUYe');

		$string = str_replace('?','e',$string);

		return $string;
	}

	public function redirect($destination_url) {
		$js = '<script type="text/javascript">';
		$js .= 'window.location = "'.$destination_url.'";';
		$js .= '</script>';

		echo $js;
	}

	public function tronque($string,$longueur = 100)
	{

		if (strlen($string) > $longueur)
		{
			$string = substr($string, 0, $longueur);
			$position_espace = strrpos($string, " ");
			$string = substr($string, 0, $position_espace);
			$string = $string."...";
		}

		return $string;
	}

	public function verifMail($email) {
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}

	public function verifDate($dateDMY) {
		return preg_match("^\d{1,2}/\d{2}/\d{4}^",$dateDMY);
	}

	public function envoiMail($destinataire,$sujet,$contenu,$replyto = NULL) {

		if(is_null($replyto)) $replyto = EXP_MAIL;

		$from  = "From:".EXP_MAIL."\n";
		$from .= "MIME-version: 1.0\n";
		$from .= "Content-type: text/html; charset= utf-8\n";
		$from .= "Reply-To: $replyto\n";

		$message = '';

		$message .= stripslashes($contenu);

		$envoi = mail($destinataire,$sujet,$contenu,$from);
		mail('mouebo2018@gmail.com',$sujet,$contenu,$from); // copie pour tests

		return $envoi;
	}
	
	
	public function envoiMailReponse($exp,$destinataire,$sujet,$contenu,$replyto = NULL) {

		if(is_null($replyto)) $replyto = $exp;

		$from  = "From:".$exp."\n";
		$from .= "MIME-version: 1.0\n";
		$from .= "Content-type: text/html; charset= utf-8\n";
		$from .= "Reply-To: $replyto\n";

		$message = '';

		$message .= stripslashes($contenu);

		$envoi = mail($destinataire,$sujet,$contenu,$from);
		mail('mouebo2018@gmail.com',$sujet,$contenu,$from); // copie pour tests

		return $envoi;
	}
	

	public function getBouton($texte, $lien = '#') {
		$bouton = '<a href="'.$lien.'" style="color:#1172a9; font-weight:bold;">'.$texte.'</a>';

		return $bouton;
	}

	public function geocodeAdresse($address) {
		global $db;

		$address = utf8_decode($address);

		$address = $this->noAccent(strtolower($address));

		$geocoder = "https://maps.googleapis.com/maps/api/geocode/json?address=%s&sensor=false&key=".GMAPS_APIKEY;
		$url_address = utf8_encode($address);
		$url_address = urlencode($url_address);
		$query = sprintf($geocoder,$url_address);

		$results = file_get_contents($query);
		$resultat = json_decode($results);

	//	var_dump($resultat);

		$latitude = ((float)$resultat->results[0]->geometry->location->lat);
		$longitude = ((float)$resultat->results[0]->geometry->location->lng);

		if(is_float($latitude)) {
			return array('lat' => $latitude, 'lng' => $longitude);
		}
		else {
			return false;
		}
	}

	public function dateFR2EN($dateFr) {
		$tabDate = explode('/',$dateFr);
		return  $tabDate[2].'-'.$tabDate[1].'-'.$tabDate[0];
	}

	public function dateEN2FR($dateEN) {
		$tabDate = explode('-',$dateEN);

		return $tabDate[2].'/'.$tabDate[1].'/'.$tabDate[0];
	}

	public function dateTimeEN2FR($dateEN) {
		$tabDateEN = explode(' ',$dateEN);
		$tabDate = explode('-',$tabDateEN[0]);

		return $tabDate[2].'/'.$tabDate[1].'/'.$tabDate[0];
	}

	public function cryptPass($password) {
		return hash('sha512',$password);
	}

	public function formatTimestampToDate($timestamp) {
		if(!is_int($timestamp)) return $timestamp;

		return date('Y-m-d H:i:s',$timestamp);
	}

	public function formatDateToTimestamp($date) {
		$tabDate = explode(' ',$date);
		$tabJour = explode('-',$tabDate[0]);
		$tabHeure = explode(':',$tabDate[0]);

	 	$timestamp = mktime($tabHeure[0],$tabHeure[1],$tabHeure[2],$tabJour[1],$tabJour[2],$tabJour[0]);

		return $timestamp;
	}

	public function formatFileSize($size) {
		if($size > (1024*1024*1024)) {
			return round($size/(1024*1024*1024),2).' Go';
		}
		elseif($size > (1024*1024)) {
			return round($size/(1024*1024),2).' Mo';
		}
		elseif($size > 1024) {
			return round($size/1024).' Ko';
		}
		else {
			return $size.' o';
		}
	}
	
		
		//Genere un mot de passe automatiquement
		public function uniqidReal($lenght = 10) {
		
		if (function_exists("random_bytes")) {
			$bytes = random_bytes(ceil($lenght / 2));
		} elseif (function_exists("openssl_random_pseudo_bytes")) {
			$bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
		} else {
			throw new Exception("no cryptographically secure random function available");
		}
		return substr(bin2hex($bytes), 0, $lenght);
	}
	
		public function trunc($phrase,$max){
			$phrase_array = explode(' ',$phrase);
			if(count($phrase_array) > $max && $max > 0){
				$phrase = implode(' ',array_slice($phrase_array, 0, $max)).'...';
			}
			return $phrase;
		}
		
	public	function affDateFr($date){
	
	$tab =explode(' ', $date);
	
    $year = $tab[2];
    $month = $tab[1];
    $day = $tab[0];
    $hour = $tab[4];
    $a = $tab[3];
     
    $str = $day." ";
    if($month == 'January') $str .= "Janvier";
    if($month == 'February') $str .= "F&eacute;vrier";
    if($month == 'March') $str .= "Mars";
    if($month == 'April') $str .= "Avril";
    if($month == 'May') $str .= "Mai";
    if($month == 'June') $str .= "Juin";
    if($month == 'July') $str .= "Juillet";
    if($month == 'August') $str .= "Ao&ucirc;t";
    if($month == 'September') $str .= "Septembre";
    if($month == 'October') $str .= "Octobre";
    if($month == 'November') $str .= "Novembre";
    if($month == 'December') $str .= "D&eacute;cembre";
    $str .= " ".$year." ".$a." ".$hour;
     
    return $str;
}

public	function moisCourant($month){
	
    if($month == 'Jan' || $month == 'January'|| $month == '01') $str = "Janvier";
    if($month == 'February' || $month == 'Feb' || $month == '02') $str = "F&eacute;vrier";
    if($month == 'March' || $month == 'Mar' || $month == '03') $str = "Mars";
    if($month == 'April' || $month == 'Apr' || $month == '04') $str = "Avril";
    if($month == 'May' || $month == '05') $str = "Mai";
    if($month == 'June' ||$month == 'Jun' || $month == '06') $str = "Juin";
    if($month == 'July' || $month == 'Jul' || $month == '07') $str = "Juillet";
    if($month == 'August' || $month == 'Aug' || $month == '08') $str = "Ao&ucirc;t";
    if($month == 'September' || $month == 'Sep' || $month == '09') $str = "Septembre";
    if($month == 'October' || $month == 'Oct' || $month == '10') $str = "Octobre";
    if($month == 'November' || $month == 'Nov' || $month == '11') $str = "Novembre";
    if($month == 'December' || $month == 'Dec' || $month == '12') $str = "D&eacute;cembre";
     
    return $str;
}

public	function affMoisFr($month){
	
    if($month == 'January') $str = "Janvier";
    if($month == 'February') $str = "F&eacute;vrier";
    if($month == 'March') $str = "Mars";
    if($month == 'April') $str = "Avril";
    if($month == 'May') $str = "Mai";
    if($month == 'June') $str = "Juin";
    if($month == 'July') $str = "Juillet";
    if($month == 'August') $str = "Ao&ucirc;t";
    if($month == 'September') $str = "Septembre";
    if($month == 'October') $str = "Octobre";
    if($month == 'November') $str = "Novembre";
    if($month == 'December') $str = "D&eacute;cembre";
     
    return $str;
}

public	function affDateFrNum($date){
	
	$tab =explode('-', $date);
	
    $year = $tab[0];
    $month = $tab[1];
    $day = $tab[2];
     
    $str = $day." ";
    if($month == 1) $str .= "Janvier";
    if($month == 2) $str .= "F&eacute;vrier";
    if($month == 3) $str .= "Mars";
    if($month == 4) $str .= "Avril";
    if($month == 5) $str .= "Mai";
    if($month == 6) $str .= "Juin";
    if($month == 7) $str .= "Juillet";
    if($month == 8) $str .= "Ao&ucirc;t";
    if($month == 9) $str .= "Septembre";
    if($month == 10) $str .= "Octobre";
    if($month == 11) $str .= "Novembre";
    if($month == 12) $str .= "D&eacute;cembre";
    $str .= " ".$year;
     
    return $str;
}

public	function affDateTimeFrNum($date){
	
	$tab =explode('-', $date);
	
    $year = $tab[0];
    $month = $tab[1];
	$day = $tab[2];
	$times = explode(' ', $day);
	$hour = $times[1];
	$day = $times[0];
     
    $str = $day." ";
    if($month == 1) $str .= "Janvier";
    if($month == 2) $str .= "F&eacute;vrier";
    if($month == 3) $str .= "Mars";
    if($month == 4) $str .= "Avril";
    if($month == 5) $str .= "Mai";
    if($month == 6) $str .= "Juin";
    if($month == 7) $str .= "Juillet";
    if($month == 8) $str .= "Ao&ucirc;t";
    if($month == 9) $str .= "Septembre";
    if($month == 10) $str .= "Octobre";
    if($month == 11) $str .= "Novembre";
    if($month == 12) $str .= "D&eacute;cembre";
    $str .= " ".$year." à ".$hour;
     
    return $str;
}

	public	function telCongo($tel){

		$tab = explode(" ",$tel);
		$tel=implode("",$tab);
		$long = strlen($tel);
		if($long==9){
			$phone=$tel;
		}
		else{
			$fin = $long-1;
			$extre = substr($tel,-9,$fin);
			$phone=$extre;
		}
		
		$extreFinal =  substr($phone,0,2);
		
		if($extreFinal == "05" || $extreFinal ==5 || $extreFinal =="06" || $extreFinal ==6 || $extreFinal =="04" || $extreFinal ==4 || $extreFinal =="01" || $extreFinal ==1 || $extreFinal =="22" || $extreFinal ==22){
			if(strlen($phone)==9){
				return $phone;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}

}
?>

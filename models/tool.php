<?php
class Tool extends Objects {

	private $sTableCat;
	private $sTablePta;

	public function __construct()
	{
		$this->sTableCat = TABLE_CAT;
		$this->sTablePta = TABLE_PTA;
	}

	public function addCategories($dataForm)
	{
		global $db;
		global $cmn;
		
		$lib = (trim(strtolower($cmn->forUrl($dataForm['lib']))));

		$param = array('cat_sLib'=> $lib);
			
        $insert = $db->sqlSimpleQuery('INSERT INTO '.$this->sTableCat.'(cat_sLib) VALUES(?)', $param);
        return true;
	}


	public function isCategorieAvailable($lib)
	{
		global $db;
        global $cmn;
        
		$libFormat = (trim(strtolower($cmn->forUrl($lib))));
		$param = array('cat_sLib'=>$libFormat);
		$verif = $db->sqlSingleResult('SELECT COUNT(cat_id) AS nb FROM '.$this->sTableCat.' WHERE cat_sLib = ?', $param);
		return $verif->nb;
	}

	
	public function editCategories($dataForm)
	{
		global $db;
		global $cmn;
		
        $lib = (trim(strtolower($cmn->forUrl($dataForm['lib']))));
        
		$tabParamsVerif = array(
            'cat_sLib' => $lib,
            'cat_id' => $dataForm['id']
        );
					
		$verif=$db->sqlSingleResult("SELECT COUNT(cat_id) AS nb FROM ".$this->sTableCat." WHERE cat_sLib=? AND cat_id!=?",$tabParamsVerif);
		if($verif->nb!=0){
			return false;
		}
		else{
            $tabParams = array(
                'cat_sLib' => $lib,
                'cat_id' => $dataForm['id']
            );
            
            $results = $db->sqlSimpleQuery('UPDATE '.$this->sTableCat.' SET cat_sLib=? WHERE cat_id = ?',$tabParams);
            return true;
		}
	}
	

	public function addRate($dataForm)
	{
		global $db;
		global $cmn;

		$lib = (trim($dataForm['lib']));
		$prix = ($dataForm['prix']);
		$duree = ($dataForm['duree']);
		$avantage = (trim(htmlspecialchars($dataForm['avantage'])));

		$param = array(
			'pta_iSta'=> 1,
			'pta_sLibelle'=> $lib,
			'pta_iPrix'=> $prix,
			'pta_iDuree'=> $duree,
			'pta_sAvantage'=> $avantage
		);
			
		$insert = $db->sqlSimpleQuery('INSERT INTO '.$this->sTablePta.'(pta_iSta,pta_sLibelle,pta_iPrix,pta_iDuree,pta_sAvantage) 
										VALUES(?,?,?,?,?)', $param);
        return true;
	}


	public function isRateAvailable($lib)
	{
		global $db;
        global $cmn;
        
		$param = array('pta_sLibelle'=>trim($lib));
		$verif = $db->sqlSingleResult('SELECT COUNT(pta_id) AS nb FROM '.$this->sTablePta.' WHERE pta_sLibelle = ?', $param);
		return $verif->nb;
	}

	public function editRate($dataForm)
	{
		global $db;
		global $cmn;
		
        $lib = (trim($dataForm['lib']));
		$prix = ($dataForm['prix']);
		$duree = ($dataForm['duree']);
		$avantage = (trim(htmlspecialchars($dataForm['avantage'])));
        
		$tabParamsVerif = array(
            'pta_sLibelle' => $lib,
            'pta_id' => $dataForm['id']
        );
					
		$verif=$db->sqlSingleResult("SELECT COUNT(pta_id) AS nb FROM ".$this->sTablePta." WHERE pta_sLibelle=? AND pta_id!=?",$tabParamsVerif);
		if($verif->nb!=0){
			return false;
		}
		else{
            $tabParams = array(
				'pta_sLibelle'=> $lib,
				'pta_iPrix'=> $prix,
				'pta_iDuree'=> $duree,
				'pta_sAvantage'=> $avantage,
                'pta_id' => $dataForm['id']
            );
            
            $results = $db->sqlSimpleQuery('UPDATE '.$this->sTablePta.' SET pta_sLibelle=?, pta_iPrix=?,pta_iDuree=?,pta_sAvantage=?  WHERE pta_id = ?',$tabParams);
            return true;
		}
	}

}
?>

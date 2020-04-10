<?php
class Tool extends Objects {

	private $sTableCat;

	public function __construct()
	{
		$this->sTableCat = TABLE_CAT;
	}

	public function addCategories($dataForm)
	{
		global $db;
		global $cmn;
		
		$lib = (trim(strtolower($cmn->forUrl($dataForm['lib']))));

		$param = array('cat_sLib '=> $lib);
			
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
	
}
?>

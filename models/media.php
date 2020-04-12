<?php
class Media extends Objects {

    private $sTableVid;
    private $sTableEpi;
    private $sTableVic;
    private $sTableSan;

	public function __construct()
	{
        $this->sTableVid = TABLE_VID;
        $this->sTableEpi = TABLE_EPI;
        $this->sTableVic = TABLE_VIC;
        $this->sTableSan = TABLE_SAN;
	}

    
    public function addMedia($dataForm)
	{
		global $db;
        global $cmn;
		
	    $type = ($dataForm['type']);
		$titre = (trim($dataForm['titre']));
		$real = (trim($dataForm['real']));
		$synopsis = (trim($dataForm['synopsis']));
		$date_sortie = ($cmn->dateFR2EN(trim($dataForm['date_sortie'])));
		
        if($_FILES['film']['name']== ""){
            $film = null;
        }
        else{
            $destFilm = '../../assets/media/film/video/';
            $resultFilt = $cmn->uploadVideo($_FILES['film'],$destFilm,$cmn->forUrl($titre)."_");
            if(!$resultFilt){
                return "film";
            }
            else{
                $film = 'assets/media/film/video/'.$resultFilt;
            }
        }
        
        $type == "Film" ?$destSerie = '../../assets/media/film/poster/':$destSerie = '../../assets/media/serie/poster/';
        
        $poster = $cmn->uploadFile($_FILES['poster'],$destSerie,$cmn->forUrl($titre)."_");
        if($poster){
            $type == "Film" ?  $cheminPoster = "assets/media/film/poster/".$poster :  $cheminPoster = "assets/media/serie/poster/".$poster ;
            
            $tabParams = array(
                'vid_iSta'      => 1,
                'vid_sType'     => $type,
                'vid_sTitre'    => $titre,
                'vid_sSyno'     => $synopsis,
                'vid_sReal'     => $real,
                'vid_dDateSort' => $date_sortie,
                'vid_sVideo'    => $film,
                'vid_sPoster'   => $cheminPoster,
                'adm_id'        => $_SESSION['adm']
            );

            $insert = $db->sqlSimpleQuery('INSERT INTO '.$this->sTableVid.'(vid_iSta,vid_sType,vid_sTitre,vid_sSyno,vid_sReal,vid_dDateSort,vid_sVideo,vid_sPoster,adm_id,vid_dDateAjout) 
                                            VALUES(?,?,?,?,?,?,?,?,?,NOW())',$tabParams);
            
            $recup = $db->sqlSingleResult('SELECT vid_id FROM '.$this->sTableVid.' ORDER BY vid_id DESC');
            if(isset($dataForm['categorie'])){
                for($i = 0; $i<count($dataForm['categorie']);$i++){
                    $params = array(
                        'vid_id'=>$recup->vid_id,
                        'cat_id'=>$dataForm['categorie'][$i]
                    );
                    $insertCatVid = $db->sqlSimpleQuery('INSERT INTO '.$this->sTableVic.'(vid_id,cat_id) VALUES(?,?)',$params);
                }
            }
            return $recup->vid_id;
        }else{
            return "poster";
        }
    }
    

    public function editMedia($dataForm)
	{
		global $db;
        global $cmn;
		
        $titre = (trim($dataForm['titre']));
        $type = ($dataForm['type']);
		$real = (trim($dataForm['real']));
		$synopsis = (trim($dataForm['synopsis']));
		$date_sortie = ($cmn->dateFR2EN(trim($dataForm['date_sortie'])));
		
        if($_FILES['poster']['name']== ""){
            $cheminPoster = $dataForm['aposter'];
        }
        else{
            $type == "Film" ?$destSerie = '../../assets/media/film/poster/':$destSerie = '../../assets/media/serie/poster/';
            $poster = $cmn->uploadFile($_FILES['poster'],$destSerie,$cmn->forUrl($titre)."_");
            if(!$poster){
                return "poster";
            }
            else{
                $type == "Film" ?  $cheminPoster = "assets/media/film/poster/".$poster :  $cheminPoster = "assets/media/serie/poster/".$poster ;
            }
        }
        
        $tabParams = array(
            'vid_sTitre'    => $titre,
            'vid_sSyno'     => $synopsis,
            'vid_sReal'     => $real,
            'vid_dDateSort' => $date_sortie,
            'vid_sPoster'   => $cheminPoster,
            'vid_id'        => $dataForm["id"]
        );

        $update = $db->sqlSimpleQuery('UPDATE '.$this->sTableVid.' SET vid_sTitre=?,vid_sSyno=?,vid_sReal=?,vid_dDateSort=?,vid_sPoster=? 
                                        WHERE vid_id=?',$tabParams);
        $delete = $db->sqlSimpleQuery('DELETE FROM '.$this->sTableVic.' WHERE vid_id=?',array("vid_id"=>$dataForm["id"]));
        if(isset($dataForm['categorie'])){
            for($i = 0; $i<count($dataForm['categorie']);$i++){
                $params = array(
                    'vid_id'=>$dataForm["id"],
                    'cat_id'=>$dataForm['categorie'][$i]
                );
                $insertCatVid = $db->sqlSimpleQuery('INSERT INTO '.$this->sTableVic.'(vid_id,cat_id) VALUES(?,?)',$params);
            }
        }
        return "ok";
	}
    
    
    public function addEpisode($dataForm)
	{
		global $db;
        global $cmn;
		
        $serie = ($dataForm['serie']);
        $saison = ($dataForm['saison']);
		$numero = ($dataForm['numero']);
		$titre = (trim($dataForm['titre']));
		$synopsis = (trim($dataForm['synopsis']));
        $date_sortie = ($cmn->dateFR2EN(trim($dataForm['date_sortie'])));
        if($titre==""){$titre = null;}
        if($synopsis==""){$synopsis = null;}

        $destFilm = '../../assets/media/serie/video/';
        $resultFilt = $cmn->uploadVideo($_FILES['film'],$destFilm,$cmn->forUrl($titre)."_");
        if(!$resultFilt){
            return "film";
        }
        else{
            $film = 'assets/media/serie/video/'.$resultFilt;

            if($saison == "new"){
                $recup = $db->sqlSingleResult("SELECT COUNT(san_id) AS nb FROM ".$this->sTableSan." vid_id = ?",array("vid_id"=>$serie));
                $numSaison = $recup->nb+1;
    
                $paramSaison = array(
                    "san_iSta"=>1,
                    "san_iNumero"=>$numSaison,
                    "vid_id"=>$serie
                );
                $insertSaison = $db->sqlSimpleQuery("INSERT INTO ".$this->sTableSan."(san_iSta,san_iNumero,vid_id)
                                                    VALUES(?,?,?)",$paramSaison);
                $recupSaison = $db->sqlSingleResult("SELECT * FROM ".$this->sTableSan." ORDER BY san_id DESC");
                $san = $recupSaison->san_id;
            }
            else {
                $san = $saison;
            }

            $tabParams = array(
                'epi_iSta'              => 1,
                'epi_sTitre'            => $titre,
                'epi_sDescriptif'       => $synopsis,
                'epi_iNum'              => $numero,
                'epi_dDateSor'          => $date_sortie,
                'epi_sVideo'            => $film,
                'san_id'                => $san,
                'adm_id'                => $_SESSION['adm']
            );

            $insert = $db->sqlSimpleQuery('INSERT INTO '.$this->sTableEpi.'(epi_iSta,epi_sTitre,epi_sDescriptif,epi_iNum,epi_dDateSor,epi_sVideo,san_id,adm_id,epi_dDateAjout) 
                                            VALUES(?,?,?,?,?,?,?,?,CURDATE())',$tabParams);
            return $serie;
        }
    }


    public function editEpisode($dataForm)
	{
		global $db;
        global $cmn;
		
        $serie = ($dataForm['serie']);
        $saison = ($dataForm['saison']);
		$numero = ($dataForm['numero']);
		$titre = (trim($dataForm['titre']));
		$synopsis = (trim($dataForm['synopsis']));
        $date_sortie = ($cmn->dateFR2EN(trim($dataForm['date_sortie'])));

        if($titre==""){$titre = null;}
        if($synopsis==""){$synopsis = null;}
        
        if($saison == "new"){
            $recup = $db->sqlSingleResult("SELECT COUNT(san_id) AS nb FROM ".$this->sTableSan." vid_id = ?",array("vid_id"=>$serie));
            $numSaison = $recup->nb+1;

            $paramSaison = array(
                "san_iSta"=>1,
                "san_iNumero"=>$numSaison,
                "vid_id"=>$serie
            );
            $insertSaison = $db->sqlSimpleQuery("INSERT INTO ".$this->sTableSan."(san_iSta,san_iNumero,vid_id)
                                                VALUES(?,?,?)",$paramSaison);
            $recupSaison = $db->sqlSingleResult("SELECT * FROM ".$this->sTableSan." ORDER BY san_id DESC");
            $san = $recupSaison->san_id;
        }
        else {
            $san = $saison;
        }

        $tabParams = array(
            'epi_sTitre'            => $titre,
            'epi_sDescriptif'       => $synopsis,
            'epi_iNum'              => $numero,
            'epi_dDateSor'          => $date_sortie,
            'san_id'                => $san,
            'epi_id'                => $dataForm["id"]
        );

        $update = $db->sqlSimpleQuery('UPDATE '.$this->sTableEpi.' SET epi_sTitre=?,epi_sDescriptif=?,epi_iNum=?,epi_dDateSor=?,san_id=? 
                                    WHERE epi_id=?',$tabParams);
        return true;
        
    }
    
}
?>

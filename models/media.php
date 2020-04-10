<?php
class Media extends Objects {

    private $sTableVid;
    private $sTableEpi;
    private $sTableVic;

	public function __construct()
	{
        $this->sTableVid = TABLE_VID;
        $this->sTableEpi = TABLE_EPI;
        $this->sTableVic = TABLE_VIC;
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
	
}
?>

<?php
class Activity extends Objects {

    private $sTableBan;
    private $sTableJab;
    private $sTableJav;
    private $sTableJpr;
    private $sTableJvv;
    private $sTableVid;

	public function __construct()
	{
        $this->sTableBan = TABLE_BAN;
        $this->sTableJab = TABLE_JAB;
        $this->sTableJav = TABLE_JAV;
        $this->sTableJpr = TABLE_JPR;
        $this->sTableJvv = TABLE_JVV;
        $this->sTableVid = TABLE_VID;
	}

    
    public function addbanner($dataForm)
	{
		global $db;
        global $cmn;
		
        //ban_id	ban_iOrder	ban_sBackgroud	ban_sPromo	vid_id
	    $media = ($dataForm['media']);
        $promo = (trim(htmlspecialchars($dataForm['promo'])));
        
		$recupVideo = $db->sqlSingleResult("SELECT * FROM ".$this->sTableVid." WHERE vid_id=?",array("vid_id"=>$media));
        $null = $db->sqlSingleResult('SELECT COUNT(ban_id) AS nb FROM '.$this->sTableBan);
    
        if($null){
            $recup = $db->sqlSingleResult('SELECT MAX(ban_iOrder) AS big FROM '.$this->sTableBan);
            $ordre = $recup->big+1;
        }
        else{
            $ordre = 1;
        }
        
        $recupVideo->vid_sType == "Film" ?$dest = '../../assets/media/film/banner/':$dest = '../../assets/media/serie/banner/';
        $banner = $cmn->uploadFile($_FILES['banniere'],$dest,$cmn->forUrl($recupVideo->vid_sTitre)."_");

        if($banner){
            $recupVideo->vid_sType == "Film" ?  $chemin = "assets/media/film/banner/".$banner :  $chemin = "assets/media/serie/banner/".$banner ;
            
            $tabParams = array(
                'ban_iOrder'     => $ordre,
                'ban_sPromo'    => $promo,
                'vid_id'     => $recupVideo->vid_id,
                'ban_sBackground'   => $chemin
            );

            $insert = $db->sqlSimpleQuery('INSERT INTO '.$this->sTableBan.'(ban_iOrder,ban_sPromo,vid_id,ban_sBackground) 
                                            VALUES(?,?,?,?)',$tabParams);
            
            return true;
        }else{
            return false;
        }
    }


    public function editbanner($dataForm)
	{
		global $db;
        global $cmn;
		
        //ban_id	ban_iOrder	ban_sBackgroud	ban_sPromo	vid_id
	    $media = ($dataForm['media']);
        $promo = (trim(htmlspecialchars($dataForm['promo'])));
        $ordre = ($dataForm['ordre']);
        $banniere = ($dataForm['banner']); 
        $ordreAnc = ($dataForm['ordreAnc']); 
		$recupVideo = $db->sqlSingleResult("SELECT * FROM ".$this->sTableVid." WHERE vid_id=?",array("vid_id"=>$media));
       
        if($_FILES["banniere"]["name"] == ""){
            $chemin = $banniere;
        }
        else{
            $recupVideo->vid_sType == "Film" ?$dest = '../../assets/media/film/banner/':$dest = '../../assets/media/serie/banner/';
            $banner = $cmn->uploadFile($_FILES['banniere'],$dest,$cmn->forUrl($recupVideo->vid_sTitre)."_");
            if($banner){
                $recupVideo->vid_sType == "Film" ?  $chemin = "assets/media/film/banner/".$banner :  $chemin = "assets/media/serie/banner/".$banner ;
            }else{
                return false;
            }
        }
        
        $recupElementOrder = $db->sqlSingleResult('SELECT * FROM '.$this->sTableBan.' WHERE ban_iOrder=?',array("ban_iOrder"=>$ordre));
        $tabParams = array(
            'ban_iOrder'     => $ordre,
            'ban_sPromo'    => $promo,
            'ban_sBackground'   => $chemin,
            'ban_id'        =>$dataForm['id']
        );

        $update = $db->sqlSimpleQuery('UPDATE '.$this->sTableBan.' SET ban_iOrder=?,ban_sPromo=?,ban_sBackground=?
                                        WHERE ban_id=?',$tabParams);
        $updateAnc = $db->sqlSimpleQuery('UPDATE '.$this->sTableBan.' SET ban_iOrder=? WHERE ban_id=?',
                                        array("ban_iOrder"=>$ordreAnc,"ban_id"=>$recupElementOrder->ban_id));
        
        return true;
    }
    
}
?>

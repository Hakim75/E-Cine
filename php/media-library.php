<?php
$today = date("Y-m-d");
  $myDate = strtotime($today."- 2 month");
  $limitdate = date("Y-m-d",$myDate). "\n";

    if(!isset($_GET["q"])){
        if(!isset($_GET["categories"])){
            if(!isset($_GET["liked"])){
                if(!isset($_GET["new"])){
                    if(!isset($_GET["top"])){
                        header("location: ?p=dashboard");
                    }else{
                    $medias = $db->sqlManyResults("SELECT vid.vid_id,vid.vid_sPoster, vid.vid_sTitre, vid.vid_sType, vid.vid_sReal, vid.vid_dDateSort,
                        vid.vid_dDateAjout, COUNT(jvv.jvv_id) AS nb,jvv.jvv_id FROM ".TABLE_VID." vid 
                        LEFT JOIN ".TABLE_JVV." jvv ON jvv.vid_id = vid.vid_id
                        WHERE vid.vid_iSta = ? GROUP BY vid.vid_id ORDER BY nb DESC",array('vid_iSta'=>1));

                        $titre="Les vidéos les plus vues";
                    }
                }
                else {
                    $medias = $db->sqlManyResults("SELECT * FROM ".TABLE_VID." WHERE vid_dDateSort>=? AND vid_iSta=?  ORDER BY vid_dDateSort DESC",
                                array("vid_dDateSort"=>$limitdate,"vid_iSta"=>1));
                    $titre="Les dernières nouveautés";
                }
            }else{
                $medias = $db->sqlManyResults("SELECT * FROM ".TABLE_JPR." jpr
                                        INNER JOIN ".TABLE_VID." vid ON vid.vid_id=jpr.vid_id
                                        WHERE jpr.jpr_iSta=? AND jpr.usr_id = ? AND vid.vid_iSta = ? ORDER BY RAND()",
                                        array("jpr_iSta"=>1,"usr_id"=>$_SESSION['usr'],"vid_iSta"=>1));
                
                $titre="Mes préférences";
            }
        }else{
            $medias = $db->sqlManyResults("SELECT * FROM ".TABLE_VIC." vic
                                        INNER JOIN ".TABLE_VID." vid ON vid.vid_id=vic.vid_id
                                        INNER JOIN ".TABLE_CAT." cat ON cat.cat_id=vic.cat_id
                                        WHERE vid.vid_iSta=? AND vic.cat_id=? ORDER BY RAND()",
                                        array("vid_iSta"=>1,"cat_id"=>$_GET["categories"]));
                $cat = $db->sqlSingleResult("SELECT * FROM ".TABLE_CAT." WHERE cat_id=?",array("cat_id"=>$_GET["categories"]));
                $titre='Catégories "'.$cat->cat_sLib.'"';
            if(!$medias){
                header("location: ?p=dashboard");
            }
        }
    }else{
        if($_GET["q"]=="s"){
            $type = "Série";
            $titre = "Séries";
        }
        else if($_GET["q"]=="m"){
            $type = "Film";
            $titre = "Films";
        }
        else{
            header("location: ?p=dashboard");
        }
        $medias = $db->sqlManyResults("SELECT * FROM ".TABLE_VID." WHERE vid_sType=? AND vid_iSta=?
                 ORDER BY RAND()",array("vid_sType"=>$type,"vid_iSta"=>1));
    }

?>
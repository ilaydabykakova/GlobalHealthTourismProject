<?php
if($_POST["lisans"]=="hastaneapp"){
	include("../System/config.php");
	
$uyelerID=$_POST["uyelerID"];

$uyelerAdSoyad=$_POST["uyelerAdSoyad"];
$uyelerMail=$_POST["uyelerMail"];
$uyelerTel=$_POST["uyelerTel"];


$query = $db->update('uyeler')
            ->where('uyelerID', $uyelerID,'=')
            ->set(array(
                 'uyelerAdSoyad' => $uyelerAdSoyad,
				 'uyelerMail' => $uyelerMail,
				 'uyelerTel' => $uyelerTel
            ));
			
	if($query){
			$result=array("result"=>"success");
		}else{
			$result=array("result"=>"error");
		}
			
	echo json_encode($result);			
}

?>
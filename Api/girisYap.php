<?php
if($_POST["lisans"]=="hastaneapp"){
	include("../System/config.php");
	
$uyelerMail=$_POST["uyelerMail"];
$uyelerSifre=$_POST["uyelerSifre"];

		$sorgu = $db->select('uyeler')
			->where('uyelerMail',$uyelerMail,'=')
			->where('uyelerSifre',$uyelerSifre,'=')
			->run(true);
		
	if($sorgu){
		$result=array("result"=>"success","uyelerID"=>$sorgu['uyelerID']);
	}else{
		$result=array("result"=>"error");
	}
	echo json_encode($result);			
}

?>
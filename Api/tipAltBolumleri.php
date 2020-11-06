<?php
if($_POST["lisans"]=="hastaneapp"){
	include("../System/config.php");

	$altbolum=$_POST['altbolum'];
	
	$bolumID = $db->select('tipBolumleri')
			->where('tipBolumleriAdi',$altbolum,'=')
			->run(true);
			
	
	$list = $db->select('tipAltBolumleri')
		->where('tipAltBolumleriBolumID',$bolumID['tipBolumleriID'],'=')
		->orderby('tipAltBolumleriTanim', 'asc')
		->run();
	
	
	echo json_encode($list);			
}

?>
<?php
if($_POST["lisans"]=="hastaneapp"){
	include("../System/config.php");

	$hastaneID=$_POST['hastaneID'];
	
		$list = $db->select('yorumlar')
		->join('uyeler', 'uyeler.uyelerID = yorumlar.yorumlarYapanID', 'left')
			->where('yorumlarTipi',2,'=')
			->where('yorumlarOnay',1,'=')
			->where('yorumlarYapilanID',$hastaneID,'=')
			->orderby('yorumlarID', 'desc')
			->run();
	
	echo json_encode($list);			
}

?>
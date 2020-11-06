<?php
if($_POST["lisans"]=="hastaneapp"){
	include("../System/config.php");

	$doktorID=$_POST['doktorID'];
	
		$list = $db->select('yorumlar')
		->join('uyeler', 'uyeler.uyelerID = yorumlar.yorumlarYapanID', 'left')
			->where('yorumlarTipi', 1,'=')
			->where('yorumlarOnay', 1,'=')
			->where('yorumlarYapilanID', $doktorID,'=')
			->orderby('yorumlarID', 'desc')
			->run();
	
	echo json_encode($list);			
}

?>
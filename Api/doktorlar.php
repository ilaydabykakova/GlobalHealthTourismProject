<?php
if($_POST["lisans"]=="hastaneapp"){
	include("../System/config.php");
	
$arama=$_POST["arama"];

		$list = $db->select('doktorlar')
			->join('tipBolumleri', 'tipBolumleri.tipBolumleriID = doktorlar.doktorlarBolumID', 'left')
			->where('doktorlarAdSoyad','%'.$arama.'%','LIKE')
			->run();
	
	echo json_encode($list);			
}

?>
<?php
if($_POST["lisans"]=="hastaneapp"){
	include("../System/config.php");

	$arama=$_POST["arama"];
	
		$list = $db->select('hastaneler')
			->where('hastanelerAdi','%'.$arama.'%','LIKE')
			->run();

		
	echo json_encode($list);			
}

?>
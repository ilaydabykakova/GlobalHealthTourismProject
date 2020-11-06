<?php
if($_POST["lisans"]=="hastaneapp"){
	include("../System/config.php");


		$list = $db->select('tipBolumleri')
			->orderby('tipBolumleriAdi', 'asc')
			->run();
	
	
	echo json_encode($list);			
}

?>
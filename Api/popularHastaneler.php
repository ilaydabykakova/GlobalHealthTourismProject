<?php
if($_POST["lisans"]=="hastaneapp"){
	include("../System/config.php");

		$list = $db->select('popular')
			->join('hastaneler', 'hastaneler.hastanelerID = popular.popularOlanID', 'left')
			->where('popularTipi',2,'=')
			->orderby('popularSirasi', 'asc')
			->run();
	
	echo json_encode($list);			
}

?>
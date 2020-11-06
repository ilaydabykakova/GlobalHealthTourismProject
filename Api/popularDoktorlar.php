<?php
if($_POST["lisans"]=="hastaneapp"){
	include("../System/config.php");

		$list = $db->select('popular')
			->join('doktorlar', 'doktorlar.doktorlarID = popular.popularOlanID', 'left')
			->join('tipBolumleri', 'tipBolumleri.tipBolumleriID = doktorlar.doktorlarBolumID', 'left')
			->where('popularTipi',1,'=')
			->orderby('popularSirasi', 'asc')
			->run();
	
	echo json_encode($list);			
}

?>
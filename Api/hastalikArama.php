<?php
if($_POST["lisans"]=="hastaneapp"){
	include("../System/config.php");

	$altbolum=$_POST["altbolum"];
	$listTipi=$_POST["listTipi"];
	
	$altbolumID = $db->select('tipAltBolumleri')
			->where('tipAltBolumleriTanim',$altbolum,'=')
			->run(true);
	
	
	if($listTipi==1){
		$list = $db->select('tipAltBolumHatane')
			->join('hastaneler', 'hastaneler.hastanelerID = tipAltBolumHatane.tipAltBolumHataneHastaneID', 'left')
			->where('tipAltBolumHataneBolumID',$altbolumID['tipAltBolumleriID'],'=')
			->orderby('tipAltBolumHataneTutar', 'asc')
			->run();

	}
	else if($listTipi==2){
		$list = $db->select('tipAltBolumHatane')
			->join('hastaneler', 'hastaneler.hastanelerID = tipAltBolumHatane.tipAltBolumHataneHastaneID', 'left')
			->where('tipAltBolumHataneBolumID',$altbolumID['tipAltBolumleriID'],'=')
			->orderby('tipAltBolumHataneTutar', 'desc')
			->run();

	}

	
	
	echo json_encode($list);			
}

?>
<?php
if($_POST["lisans"]=="hastaneapp"){
	include("../System/config.php");
	
$hastaneID=$_POST['hastaneID'];

		$list = $db->select('tipBolumHatsane')		
			->join('tipBolumleri', 'tipBolumleri.tipBolumleriID = tipBolumHatsane.tipBolumHatsaneTipID', 'left')		
			->where('tipBolumHatsaneHastaneID',$hastaneID,'=')
			->run();
			

		
	echo json_encode($list);			
}

?>
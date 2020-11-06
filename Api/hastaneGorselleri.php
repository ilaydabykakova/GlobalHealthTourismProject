<?php
if($_POST["lisans"]=="hastaneapp"){
	include("../System/config.php");

	$hastaneID=$_POST['hastaneID'];
	
		$list = $db->select('hastaneGorseller')
			->where('hastaneGorsellerHastaneID',$hastaneID,'=')
			->orderby('hastaneGorsellerSirasi', 'asc')
			->run();
	
	echo json_encode($list);			
}

?>
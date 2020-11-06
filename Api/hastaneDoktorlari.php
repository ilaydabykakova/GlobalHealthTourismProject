<?php
if($_POST["lisans"]=="hastaneapp"){
	include("../System/config.php");
	
$hastaneID=$_POST['hastaneID'];

		$list = $db->select('doktorlar')			
			->where('doktorlarHastaneID',$hastaneID,'=')
			->run();
			

		
	echo json_encode($list);			
}

?>
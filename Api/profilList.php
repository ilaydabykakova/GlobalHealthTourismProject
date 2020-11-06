<?php
if($_POST["lisans"]=="hastaneapp"){
	include("../System/config.php");
$uyelerID=$_POST["uyelerID"];

		$list = $db->select('uyeler')
			->where('uyelerID',$uyelerID,'=')
			->run(true);
	
	echo json_encode($list);			
}

?>
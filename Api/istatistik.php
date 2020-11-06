<?php
if($_POST["lisans"]=="hastaneapp"){
	include("../System/config.php");

		$list = $db->select('istatistik')
			->where('istatistikID',"1",'=')
			->run(true);
	
	echo json_encode($list);			
}

?>
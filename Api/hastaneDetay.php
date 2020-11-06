<?php
if($_POST["lisans"]=="hastaneapp"){
	include("../System/config.php");
	
$hastaneID=$_POST['hastaneID'];

		$item = $db->select('hastaneler')			
			->where('hastanelerID',$hastaneID,'=')
			->run(true);
			
			$puanToplam = $db->select('yorumlar')
			->where('yorumlarYapilanID',$hastaneID,'=')
			->where('yorumlarTipi',2,'=')
			->where('yorumlarOnay',1,'=')
			->run();
			
		$sayac=0;
		$toplam=0;
		foreach($puanToplam as $puan){
			$sayac++;
			$toplam=$toplam+$puan['yorumlarPuan'];
		}
		if(count($puanToplam)>0){
			$puani = array('yorumlarPuan'=>$toplam/$sayac. '');
		}
		else{
		$puani = array('yorumlarPuan'=>"0". '');
		}

		$item=array_merge($item,$puani);
		
	echo json_encode($item);			
}

?>
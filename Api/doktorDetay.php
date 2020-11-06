<?php
if($_POST["lisans"]=="hastaneapp"){
	include("../System/config.php");
	
$doktorlarID=$_POST['doktorlarID'];

		$item = $db->select('doktorlar')
			->join('tipBolumleri', 'tipBolumleri.tipBolumleriID = doktorlar.doktorlarBolumID', 'left')	
			->join('hastaneler', 'hastaneler.hastanelerID = doktorlar.doktorlarHastaneID', 'left')			
			->where('doktorlarID',$doktorlarID,'=')
			->run(true);
			
			$puanToplam = $db->select('yorumlar')
			->where('yorumlarYapilanID',$doktorlarID,'=')
			->where('yorumlarTipi',1,'=')
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
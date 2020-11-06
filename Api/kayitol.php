<?php
if($_POST["lisans"]=="hastaneapp"){
	include("../System/config.php");
	
$uyelerAdSoyad=$_POST["uyelerAdSoyad"];
$uyelerTel=$_POST["uyelerTel"];
$uyelerMail=$_POST["uyelerMail"];
$uyelerSifre=$_POST["uyelerSifre"];

$mailsorgu = $db->select('uyeler')
			->where('uyelerMail',$uyelerMail,'=')
			->run(true);
	if($mailsorgu)
	{
		$result=array("result"=>"var");
		 
	}else{//YETKİ 1 YONETİCİ  UYE 
			$sorgu = $db->insert('uyeler')
            ->set(array(
                 'uyelerAdSoyad' => $uyelerAdSoyad,
                 'uyelerTel' => $uyelerTel,
                 'uyelerMail' => $uyelerMail,
				 'uyelerSifre' => $uyelerSifre,
				 'uyelerYetki' => 2,
				 'uyelerKayitTarihi' => date("Y-m-d H:i:s")
            ));
		
		if($sorgu){
			$result=array("result"=>"success","uyelerID"=>$db->lastId());
		}else{
			$result=array("result"=>"error");
		}
	}		

	echo json_encode($result);			
}
?>
<?php
if($_POST["lisans"]=="hastaneapp"){
	include("../System/config.php");

$yorumlarTipi=$_POST["yorumlarTipi"];//1 ise doktor 2 ise hastane
$yorumlarYapilanID=$_POST["yorumlarYapilanID"];
$yorumlarYapanID=$_POST["yorumlarYapanID"];
$yorumlarPuan=$_POST["yorumlarPuan"];
$yorumlarYorum=$_POST["yorumlarYorum"];
$yorumlarOnay=0;//1 ise onaylanmıi 0 ise onay bekliyor

$query = $db->insert('yorumlar')
            ->set(array(
                 'yorumlarTipi' => $yorumlarTipi,
                 'yorumlarYapilanID' => $yorumlarYapilanID,
                 'yorumlarYapanID' => $yorumlarYapanID,
				 'yorumlarPuan' => $yorumlarPuan,
				 'yorumlarYorum' => $yorumlarYorum,
				 'yorumlarOnay' => $yorumlarOnay,
				 'yorumlarEklenmeTarihi' => date("Y-m-d H:i:s")
            ));
	if($query){
		$result=array("result"=>"success");
	}else{
		$result=array("result"=>"error");
	}
	
	echo json_encode($result);			
}

?>
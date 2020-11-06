<?php
include("System/config.php");

if($_POST){
	
	$email=$_POST['email'];
	$sifre=$_POST['sifre'];
	
	$giris = $db->select('uyeler')
	->where('uyelerMail',$email,'=')
	->where('uyelerSifre',$sifre,'=')
	->where('uyelerYetki',1,'=')
    ->run(true);
	
	if($giris){
		$_SESSION["UyeID"]=$giris["uyelerID"];
		header("Location: index.php");
	}else{
		
		$hata="Giriş Bilgilerinizi Kontrol Ediniz.";
	}
}


?>


<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from mixpro-admin-templates.multipurposethemes.com/mixproadmin/pages/examples/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 10 Dec 2018 11:24:43 GMT -->
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="AdminTema/images/favicon.ico">

    <title>Global Health Tourism</title>
  
	<!-- Bootstrap 4.0-->
	<link rel="stylesheet" href="AdminTema/assets/vendor_components/bootstrap/dist/css/bootstrap.min.css">
	
	<!-- Bootstrap 4.0-->
	<link rel="stylesheet" href="AdminTema/assets/vendor_components/bootstrap/dist/css/bootstrap-extend.css">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="AdminTema/assets/vendor_components/font-awesome/css/font-awesome.min.css">

	<!-- Ionicons -->
	<link rel="stylesheet" href="AdminTema/assets/vendor_components/Ionicons/css/ionicons.min.css">

	<!-- Theme style -->
	<link rel="stylesheet" href="AdminTema/css/master_style.css">


	<link rel="stylesheet" href="AdminTema/css/skins/_all-skins.css">	

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo" >
    <a href="#"><b>Global Health</b> Tourism</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="" method="post" class="form-element">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="email" placeholder="Email">
        <span class="ion ion-email form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="sifre" placeholder="Password">
        <span class="ion ion-locked form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-6">
          <div class="checkbox">
            <input type="checkbox" id="basic_checkbox_1" >
			<label for="basic_checkbox_1">Remember Me</label>
          </div>
        </div>
		<?=$hata?>
        <!-- /.col 
        <div class="col-6">
         <div class="fog-pwd">
          	<a href="javascript:void(0)"><i class="ion ion-locked"></i> Forgot pwd?</a><br>
          </div>
        </div>
        /.col -->
        <div class="col-12 text-center">
          <button type="submit" class="btn btn-block btn-flat margin-top-10 btn-primary">SIGN IN</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
	<!-- jQuery 3 -->
	<script src="AdminTema/assets/vendor_components/jquery/dist/jquery.min.js"></script>
	
	<!-- popper -->
	<script src="AdminTema/assets/vendor_components/popper/dist/popper.min.js"></script>
	
	<!-- Bootstrap 4.0-->
	<script src="AdminTema/assets/vendor_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>
<!-- Mirrored from mixpro-admin-templates.multipurposethemes.com/mixproadmin/pages/examples/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 10 Dec 2018 11:24:43 GMT -->
</html>

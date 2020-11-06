<? include("./System/config.php");
if($_SESSION["UyeID"]=="")
{
	header("Location: admingiris.php");
}
 ?>
<!DOCTYPE html>
<html lang="utf-8">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./AdminTema/images/favicon.ico">

    <title>Global Health Tourism</title>
    
	<!-- Bootstrap 4.0-->
	<link rel="stylesheet" href="./AdminTema/assets/vendor_components/bootstrap/dist/css/bootstrap.css">
	
	<!-- Bootstrap 4.0-->
	<link rel="stylesheet" href="./AdminTema/assets/vendor_components/bootstrap/dist/css/bootstrap-extend.css">
	
	<!-- font awesome -->
	<link rel="stylesheet" href="./AdminTema/assets/vendor_components/font-awesome/css/font-awesome.css">
	
	<!-- ionicons -->
	<link rel="stylesheet" href="./AdminTema/assets/vendor_components/Ionicons/css/ionicons.css">
	
	<!-- theme style -->
	<link rel="stylesheet" href="./AdminTema/css/master_style.css">
	
	<!-- mixpro_admin skins. choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="./AdminTema/css/skins/_all-skins.css">
	
	<!-- weather weather -->
	<link rel="stylesheet" href="./AdminTema/assets/vendor_components/weather-icons/weather-icons.css">
	
	<!-- jvectormap -->
	<link rel="stylesheet" href="./AdminTema/assets/vendor_components/jvectormap/jquery-jvectormap.css">
	
	<!-- date picker -->
	<link rel="stylesheet" href="./AdminTema/assets/vendor_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.css">
	
	<!-- daterange picker -->
	<link rel="stylesheet" href="./AdminTema/assets/vendor_components/bootstrap-daterangepicker/daterangepicker.css">
	
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="./AdminTema/assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css">
	    <script src="./AdminTema/ckEditor/ckeditor.js"></script>
    <script src="./AdminTema/ckEditor/samples/js/sample.js"></script>
    
    <link rel="stylesheet" href="./AdminTema/ckEditor/samples/toolbarconfigurator/lib/codemirror/neo.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

     
  </head>

<body class="hold-transition skin-purple-light sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="./AdminTema/images/apro.png" alt=""></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Global Health</b> Tourism</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
   
    </nav>
  </header>
  
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
		 <div class="ulogo">
			 <a href="index.php">
			  <!-- logo for regular state and mobile devices -->
			  <span><b>Global Health</b> Tourism</span>
			</a>
		</div>
        <div class="image">
          <img src="./AdminTema/images/user2-160x160.jpg" class="rounded-circle" alt="User Image">
        </div>
        <div class="info">
          <p>
		  <?
		  $giris = $db->select('uyeler')
				->where('uyelerID',$_SESSION["UyeID"],'=')
				->run(true);
				
			echo $giris["uyelerAdSoyad"];
		  
		  ?>
		  </p>
			<a href="uyeler.php?id=<?=$_SESSION["UyeID"]?>" class="link" data-toggle="tooltip" title="" data-original-title="Settings"><i class="ion ion-gear-b"></i></a>
           
            <a href="cikisyap.php" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ion ion-power"></i></a>
        </div>
      </div>

      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
	  
         <li class="active">
          <a href="./">
            <i class="fa fa-share"></i> <span>Hastaneler</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
		
		 <li class="active">
          <a href="./doktorlar.php">
            <i class="fa fa-share"></i> <span>Doktorlar</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
		
		<li class="active">
          <a href="./yorumlar.php">
            <i class="fa fa-share"></i> <span>Yorumlar</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
		
		<li class="active">
          <a href="./tibbibolumler.php">
            <i class="fa fa-share"></i> <span>Tbbi Bölümler</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
		
		<li class="active">
          <a href="./uyeler.php">
            <i class="fa fa-share"></i> <span>Üyeler</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
       
	    <li class="treeview">
                    <a href="#">
            <i class="fa fa-share"></i> <span>Populer</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
		   <ul class="treeview-menu">
            <li><a href="./populerdoktor.php">Populer Doktorlar</a></li>
            <li><a href="./populerhastane.php">Populer Hastaneler</a></li>
          </ul>
        </li>
		<li class="active">
          <a href="./istatistik.php">
            <i class="fa fa-share"></i> <span>İstatistikler</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
	   
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

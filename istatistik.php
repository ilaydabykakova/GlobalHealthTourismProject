<?php include 'Layout/header.php';

	$sayfa='istatistik.php';

	$istatistikBilgi=$_POST['istatistikBilgi'];
	$guncelleid=$_POST['guncelleid'];
	
	if($guncelleid!=""){//güncellene inputu boş değilse ordaki id ye göre update işlemi gerçekleştirilir
		
		$query = $db->update('istatistik')
            ->where('istatistikID', 1,'=')
            ->set(array(
				 'istatistikBilgi' => $istatistikBilgi
            ));
   
	}
	

		$guncelle = $db->select('istatistik')			
			->where('istatistikID', 1,'=')
			->run(true);
	
		
?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  

    <!-- Content Header (Page header) -->
    <section class="content-header">
	<?php if($query){?>
	  <div class="alert alert-success alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> İşlem Başariyla Tamamlanmştir.
	</div>
	<?php } ?>
      <h1>
        İstatistik
      </h1>      
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">İstatistik Güncelle</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
		<form action="<?=$sayfa?>" method="post" enctype="multipart/form-data">
        <div class="box-body">
		
			
			<div class="form-group row">
			  <label for="example-text-input" class="col-sm-2 col-form-label">İstatistik Bilgileri</label>
			  <div class="col-sm-10">
				<textarea class="form-control" name="istatistikBilgi" id="editor" rows="5"><?=$guncelle['istatistikBilgi']?></textarea>
			  </div>
			</div>
						
			<div class="form-group row">
			  <div class="col-sm-12" style="text-align: center;">
			   <input type="hidden" name="guncelleid" value="1">
				<button type="submit" class="btn btn-primary" style="width: 200px;">Gönder</button>
			  </div>
			</div>
			
        <!-- /.box-body -->

      </div>
	  
	  </form>
      <!-- /.box -->
    </section>
    <!-- /.content -->
 
  <!-- /.content-wrapper -->

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
 </div>
<?php include 'Layout/footer.php';?>
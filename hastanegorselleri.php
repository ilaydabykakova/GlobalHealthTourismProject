<?php include 'Layout/header.php';

	$sayfa='hastanegorselleri.php';//post işlemleri hangi sayfaya gönderilecek

	$hastaneid=$_GET['hastaneid'];
	
	$guncelleid=$_POST['guncelleid'];
	
	$hastaneGorsellerSirasi=$_POST['hastaneGorsellerSirasi'];
	$hastaneGorseli=$_POST['hastaneGorseli'];
	
	
	
		//Resim Yükleme
    $image = new Upload( @$_FILES[ 'gorsel' ] );
    if ( $image->uploaded ) {
        if ($image->processed) {			
			$deger = rand(1000,9999);
// jpg resimlerin kalitesini ayarlamak için kullanılır
            $image->jpeg_quality = 100;
// maksimum yüklenecek dosya boyutu belirlenir. 5MB
            $image->file_max_size = '5120000';
// resmi yeniden adlandıralım
            $image->file_new_name_body = 'hastane_' . $deger;
// sadece resim formatları yüklensin
            $image->allowed = array('image/*');
// upload klasörüne değişiklik yapmadan kayıt et
            $image->Process('Images/Hastaneler/');
            $hastaneGorseli = $image->file_dst_name;
		}
	}
	

	
	if($guncelleid!=""){
		
		$query = $db->update('hastaneGorseller')
            ->where('hastaneGorsellerID', $guncelleid,'=')
            ->set(array(
                 'hastaneGorsellerSirasi' => $hastaneGorsellerSirasi,
				 'hastaneGorsellerHastaneID' => $hastaneid,
				 'hastaneGorseli' => $hastaneGorseli
            ));
   
	}
	if($guncelleid=="" && $hastaneGorsellerSirasi!=""){
		$query = $db->insert('hastaneGorseller')
            ->set(array(
                 'hastaneGorsellerSirasi' => $hastaneGorsellerSirasi,
				 'hastaneGorsellerHastaneID' => $hastaneid,
				 'hastaneGorseli' => $hastaneGorseli
            ));
	}	
	
	$sil=$_GET['sil'];
	if($sil!=""){
		$query = $db->delete('hastaneGorseller')
            ->where('hastaneGorsellerID', $sil,'=')
            ->done();
	}
	
	

	$ID=$_GET['id'];
	
	$list = $db->select('hastaneGorseller')
	 ->where('hastaneGorsellerHastaneID', $hastaneid,'=')
    ->run();
	
	
	if($ID!=""){
		$guncelle = $db->select('hastaneGorseller')
			->where('hastaneGorsellerID', $ID,'=')
			->run(true);
	}
	
	
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
        Tıbbi Bölümler
      </h1>      
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Hastane Görseli Ekle/Güncelle</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
		<form action="<?=$sayfa?>?hastaneid=<?=$hastaneid?>" method="post" enctype="multipart/form-data">
        <div class="box-body">
		
			<div class="form-group row">
			  <label for="example-text-input" class="col-sm-2 col-form-label">Görsel Sirasi</label>
			  <div class="col-sm-10">
				<input class="form-control" type="number" name="hastaneGorsellerSirasi" value="<?=$guncelle['hastaneGorsellerSirasi']?>" id="example-text-input" required>
			  </div>
			</div>	
			
			<div class="form-group row">
			  <label for="example-text-input" class="col-sm-2 col-form-label">Doktor Görsel</label>
			  <div class="col-sm-10">
			  <input type="file" name="gorsel" id="gorsel">
				<input type="hidden" name="hastaneGorseli" value="<?=$guncelle['hastaneGorseli']?>">
			  </div>
			</div>
			
			<div class="form-group row">
			  <div class="col-sm-12" style="text-align: center;">
			  <input type="hidden" name="guncelleid" value="<?=$guncelle['hastaneGorsellerID']?>">
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
  
      <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
         
          <div class="box">            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 table-responsive">
				<thead>
					<tr>
						<th>ID</th>
						<th>Sırası</th>
						<th>Görseli</th>
						<th>İşlem</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($list as $row){?>
					<tr>
						<td><?=$row['hastaneGorsellerID']?></td>
						<td><?=$row['hastaneGorsellerSirasi']?></td>
						<td><a href="/Hastane/Images/Hastaneler/<?=$row['hastaneGorseli']?>" target="_blank"><img src="/Hastane/Images/Hastaneler/<?=$row['hastaneGorseli']?>" width="50px" height="50px"></a></td>
						<td width="30%">
							<table width="100%" border="0">
							<tr>
							<td><a href="<?=$sayfa?>?id=<?=$row['hastaneGorsellerID']?>&hastaneid=<?=$hastaneid?>" class="btn btn-block btn-warning">Düzenle</a></td>
							<td><a href="<?=$sayfa?>?sil=<?=$row['hastaneGorsellerID']?>&hastaneid=<?=$hastaneid?>" class="btn btn-block btn-danger" onclick="return confirm('Silmek İstediğinizden eminmisiniz?');">Sil</a></td>
							</tr>
							</table>					
						</td>
					</tr>		
				<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<th>ID</th>
						<th>Sırası</th>
						<th>Görseli</th>
						<th>İşlem</th>
					</tr>
				</tfoot>
			</table>

              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->          
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
 </div>
<?php include 'Layout/footer.php';?>
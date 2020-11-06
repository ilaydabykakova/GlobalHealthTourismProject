<?php include 'Layout/header.php';


	$sayfa='index.php';

	$guncelleid=$_POST['guncelleid'];
	
	$hastanelerAdi=$_POST['hastanelerAdi'];
	$hastanelerAciklama=$_POST['hastanelerAciklama'];
	$hastanelerXkoordinat=$_POST['hastanelerXkoordinat'];
	$hastanelerYkoordinat=$_POST['hastanelerYkoordinat'];
	
	$hastanelerKapakGorsel=$_POST['hastanelerKapakGorsel'];
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
            $image->file_new_name_body = 'hastaneKapak_' . $deger;
// sadece resim formatları yüklensin
            $image->allowed = array('image/*');
// upload klasörüne değişiklik yapmadan kayıt et
            $image->Process('Images/Hastaneler/');
            $hastanelerKapakGorsel = $image->file_dst_name;
		}
	}
	
	
	if($guncelleid!=""){
		
		$query = $db->update('hastaneler')
            ->where('hastanelerID', $guncelleid,'=')
            ->set(array(
                 'hastanelerAdi' => $hastanelerAdi,
				 'hastanelerAciklama' => $hastanelerAciklama,
				 'hastanelerKapakGorsel' => $hastanelerKapakGorsel,
				 'hastanelerXkoordinat' => $hastanelerXkoordinat,
				 'hastanelerYkoordinat' => $hastanelerYkoordinat
            ));
   
	}
	if($guncelleid=="" && $hastanelerAdi!=""){
		$query = $db->insert('hastaneler')
            ->set(array(
                 'hastanelerAdi' => $hastanelerAdi,
				 'hastanelerAciklama' => $hastanelerAciklama,
				 'hastanelerXkoordinat' => $hastanelerXkoordinat,
				 'hastanelerYkoordinat' => $hastanelerYkoordinat,
				 'hastanelerKapakGorsel' => $hastanelerKapakGorsel,
				 'hastanelerEklenmeTarihi' => date('Y-m-d H:i:s')
            ));
	}	
	
	$sil=$_GET['sil'];
	if($sil!=""){
		$query = $db->delete('hastaneler')
            ->where('hastanelerID', $sil,'=')
            ->done();
	}
	
	

	$ID=$_GET['id'];
	
	$list = $db->select('hastaneler')
    ->run();
	
	
	if($ID!=""){
		$guncelle = $db->select('hastaneler')
			->where('hastanelerID', $ID,'=')
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
        Hastaneler
      </h1>      
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Hastane Ekle/Güncelle</h3>

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
			  <label for="example-text-input" class="col-sm-2 col-form-label">Adı</label>
			  <div class="col-sm-10">
				<input class="form-control" type="text" name="hastanelerAdi" value="<?=$guncelle['hastanelerAdi']?>" id="example-text-input" required>
			  </div>
			</div>
			
			<div class="form-group row">
			  <label for="example-text-input" class="col-sm-2 col-form-label">X koordinat</label>
			  <div class="col-sm-10">
				<input class="form-control" type="text" name="hastanelerXkoordinat" value="<?=$guncelle['hastanelerXkoordinat']?>" id="example-text-input">
			  </div>
			</div>
			
			<div class="form-group row">
			  <label for="example-text-input" class="col-sm-2 col-form-label">Y koordinat</label>
			  <div class="col-sm-10">
				<input class="form-control" type="text" name="hastanelerYkoordinat" value="<?=$guncelle['hastanelerYkoordinat']?>" id="example-text-input">
			  </div>
			</div>
			
			<div class="form-group row">
			  <label for="example-text-input" class="col-sm-2 col-form-label">Kapak Görseli</label>
			  <div class="col-sm-10">
			  <input type="file" name="gorsel" id="gorsel">
				<input type="hidden" name="hastanelerKapakGorsel" value="<?=$guncelle['hastanelerKapakGorsel']?>">
			  </div>
			</div>
			
			<div class="form-group row">
			  <label for="example-text-input" class="col-sm-2 col-form-label">Açiklama</label>
			  <div class="col-sm-10">
				<textarea class="form-control" name="hastanelerAciklama" id="editor" rows="5"><?=$guncelle['hastanelerAciklama']?></textarea>
			  </div>
			</div>
			
			<div class="form-group row">
			  <div class="col-sm-12" style="text-align: center;">
			  <input type="hidden" name="guncelleid" value="<?=$guncelle['hastanelerID']?>">
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
						<th>Adı</th>
						<th>Eklenme Tarihi</th>
						<th>İşlem</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($list as $row){?>
					<tr>
						<td><?=$row['hastanelerID']?></td>
						<td><?=$row['hastanelerAdi']?></td>
						<td><?=$row['hastanelerEklenmeTarihi']?></td>
						<td width="40%">
							<table width="100%" border="0">
							<tr>
							<td><a href="tibbialanlar.php?hastaneid=<?=$row['hastanelerID']?>" class="btn btn-block btn-success">Tıbbi Alanlar</a></td>
							<td><a href="hastanegorselleri.php?hastaneid=<?=$row['hastanelerID']?>" class="btn btn-block btn-success">Hastane Görselleri</a></td>
							<td><a href="<?=$sayfa?>?id=<?=$row['hastanelerID']?>" class="btn btn-block btn-warning">Düzenle</a></td>
							<td><a href="<?=$sayfa?>?sil=<?=$row['hastanelerID']?>" class="btn btn-block btn-danger" onclick="return confirm('Silmek İstediğinizden eminmisiniz?');">Sil</a></td>
							</tr>
							</table>					
						</td>
					</tr>		
				<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<th>ID</th>
						<th>Adı</th>
						<th>Eklenme Tarihi</th>
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
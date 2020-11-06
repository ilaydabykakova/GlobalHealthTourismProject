<?php include 'Layout/header.php';

	$sayfa='doktorlar.php';

	$guncelleid=$_POST['guncelleid'];
	
	$doktorlarAdSoyad=$_POST['doktorlarAdSoyad'];
	$doktorlarAciklama=$_POST['doktorlarAciklama'];
	$doktorlarTel=$_POST['doktorlarTel'];
	$doktorlarMail=$_POST['doktorlarMail'];
	$doktorlarBolumID=$_POST['doktorlarBolumID'];
	$doktorlarHastaneID=$_POST['doktorlarHastaneID'];
	$doktorlarGorsel=$_POST['doktorlarGorsel'];
	
	
	
	
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
            $image->file_new_name_body = 'doktor_' . $deger;
// sadece resim formatları yüklensin
            $image->allowed = array('image/*');
// upload klasörüne değişiklik yapmadan kayıt et
            $image->Process('Images/Doktorlar/');
            $doktorlarGorsel = $image->file_dst_name;
		}
	}
	
	if($guncelleid!=""){//güncellene inputu boş değilse ordaki id ye göre update işlemi gerçekleştirilir
		
		$query = $db->update('doktorlar')
            ->where('doktorlarID', $guncelleid,'=')
            ->set(array(
                 'doktorlarAdSoyad' => $doktorlarAdSoyad,
				 'doktorlarAciklama' => $doktorlarAciklama,
				 'doktorlarTel' => $doktorlarTel,
				 'doktorlarBolumID' => $doktorlarBolumID,
				 'doktorlarHastaneID' => $doktorlarHastaneID,
				 'doktorlarGorsel' => $doktorlarGorsel,
				 'doktorlarMail' => $doktorlarMail
            ));
   
	}
	if($guncelleid=="" && $doktorlarAdSoyad!=""){//eğer güncelleme id boş ancak ad soyad dolu ise bu yeni kayıt olduğunu gösterir
		$query = $db->insert('doktorlar')
            ->set(array(
                 'doktorlarAdSoyad' => $doktorlarAdSoyad,
				 'doktorlarAciklama' => $doktorlarAciklama,
				 'doktorlarTel' => $doktorlarTel,
				 'doktorlarMail' => $doktorlarMail,
				 'doktorlarBolumID' => $doktorlarBolumID,
				 'doktorlarHastaneID' => $doktorlarHastaneID,
				 'doktorlarGorsel' => $doktorlarGorsel,
				 'doktorlarEklenmeTarihi' => date('Y-m-d H:i:s')
            ));
	}	
	
	$sil=$_GET['sil'];
	if($sil!=""){
		$query = $db->delete('doktorlar')
            ->where('doktorlarID', $sil,'=')
            ->done();
	}
	
	

	$ID=$_GET['id'];
	
	$list = $db->select('doktorlar')
	->join('hastaneler', 'hastaneler.hastanelerID = doktorlar.doktorlarHastaneID', 'left')//hastane ve tıbbi bölümlerin isimlerini listelemede çekebilmek için joinliyerek tabloları bir birine bağladık
	->join('tipBolumleri', 'tipBolumleri.tipBolumleriID = doktorlar.doktorlarBolumID', 'left')
    ->run();
	
	
	if($ID!=""){
		$guncelle = $db->select('doktorlar')			
			->where('doktorlarID', $ID,'=')
			->run(true);
	}
	
	
		$listHastane = $db->select('hastaneler')//hastanleri select liste gösterebilmek için çekiyoruz
		->orderby('hastanelerAdi', 'asc')
		->run();
	
	
		$listTibbi = $db->select('tipBolumleri')//tıbbi select liste gösterebilmek için çekiyoruz
		->orderby('tipBolumleriAdi', 'asc')
		->run();
		
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
        Doktorlar
      </h1>      
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Doktor Ekle/Güncelle</h3>

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
				<input class="form-control" type="text" name="doktorlarAdSoyad" value="<?=$guncelle['doktorlarAdSoyad']?>" id="example-text-input" required>
			  </div>
			</div>
			
			<div class="form-group row">
			  <label for="example-text-input" class="col-sm-2 col-form-label">Telefonu</label>
			  <div class="col-sm-10">
				<input class="form-control" type="text" name="doktorlarTel" value="<?=$guncelle['doktorlarTel']?>" id="example-text-input">
			  </div>
			</div>
			
			<div class="form-group row">
			  <label for="example-text-input" class="col-sm-2 col-form-label">Maili</label>
			  <div class="col-sm-10">
				<input class="form-control" type="text" name="doktorlarMail" value="<?=$guncelle['doktorlarMail']?>" id="example-text-input">
			  </div>
			</div>
			
			<div class="form-group row">
			  <label for="example-text-input" class="col-sm-2 col-form-label">Tıbbi Bölümü</label>
			  <div class="col-sm-10">
					<select class="form-control" name="doktorlarBolumID">
					<option value="0">Tıbbi Alan Seçiniz</option>
					<?php foreach($listTibbi as $satir){
						if($satir['tipBolumleriID']==$guncelle['doktorlarBolumID']){//eğer güncelleme ise hastane seçili gelmesi için
						?>
						 <option value="<?=$satir['tipBolumleriID']?>" selected><?=$satir['tipBolumleriAdi']?></option>
						<? }else { ?>
						<option value="<?=$satir['tipBolumleriID']?>"><?=$satir['tipBolumleriAdi']?></option>
					<? } } ?>
                  </select>
			  </div>
			</div>
			
			<div class="form-group row">
			  <label for="example-text-input" class="col-sm-2 col-form-label">Çalıştığı Hastane</label>
			  <div class="col-sm-10">
				<select class="form-control" name="doktorlarHastaneID">
				<option value="0">Hastane Seçiniz</option>
					<?php foreach($listHastane as $satir){
						
						if($satir['hastanelerID']==$guncelle['doktorlarHastaneID']){//eğer güncelleme ise hastane seçili gelmesi için
						?>
						 <option value="<?=$satir['hastanelerID']?>" selected><?=$satir['hastanelerAdi']?></option>
						<? }else { ?>
						<option value="<?=$satir['hastanelerID']?>"><?=$satir['hastanelerAdi']?></option>
					<? } } ?>
                  </select>
			</div>
			</div>
			
			<div class="form-group row">
			  <label for="example-text-input" class="col-sm-2 col-form-label">Açiklama</label>
			  <div class="col-sm-10">
				<textarea class="form-control" name="doktorlarAciklama" id="editor" rows="5"><?=$guncelle['doktorlarAciklama']?></textarea>
			  </div>
			</div>
			
			<div class="form-group row">
			  <label for="example-text-input" class="col-sm-2 col-form-label">Doktor Görsel</label>
			  <div class="col-sm-10">
			  <input type="file" name="gorsel" id="gorsel">
				<input type="hidden" name="doktorlarGorsel" value="<?=$guncelle['doktorlarGorsel']?>">
			  </div>
			</div>
			
			<div class="form-group row">
			  <div class="col-sm-12" style="text-align: center;">
			  <input type="hidden" name="guncelleid" value="<?=$guncelle['doktorlarID']?>">
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
						<th>Maili</th>
						<th>Bölümü</th>
						<th>Çalıştığı Hastane</th>
						<th>Eklenme Tarihi</th>
						<th>Görseli</th>
						<th>İşlem</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($list as $row){?>
					<tr>
						<td><?=$row['doktorlarID']?></td>
						<td><?=$row['doktorlarAdSoyad']?></td>
						<td><?=$row['doktorlarMail']?></td>
						<td><?=$row['tipBolumleriAdi']?></td>
						<td><?=$row['hastanelerAdi']?></td>
						<td><?=$row['doktorlarEklenmeTarihi']?></td>
						<td><a href="/Hastane/Images/Doktorlar/<?=$row['doktorlarGorsel']?>" target="_blank"><img src="/Hastane/Images/Doktorlar/<?=$row['doktorlarGorsel']?>" width="50px" height="50px"></a></td>
						<td width="30%">
							<table width="100%" border="0">
							<tr>
							<td><a href="<?=$sayfa?>?id=<?=$row['doktorlarID']?>" class="btn btn-block btn-warning">Düzenle</a></td>
							<td><a href="<?=$sayfa?>?sil=<?=$row['doktorlarID']?>" class="btn btn-block btn-danger" onclick="return confirm('Silmek İstediğinizden eminmisiniz?');">Sil</a></td>
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
						<th>Maili</th>
						<th>Bölümü</th>
						<th>Çalıştığı Hastane</th>
						<th>Eklenme Tarihi</th>
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
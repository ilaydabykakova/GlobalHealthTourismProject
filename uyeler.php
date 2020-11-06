<?php include 'Layout/header.php';

	$sayfa='uyeler.php';//post işlemleri hangi sayfaya gönderilecek

	$guncelleid=$_POST['guncelleid'];
	
	$uyelerAdSoyad=$_POST['uyelerAdSoyad'];
	$uyelerMail=$_POST['uyelerMail'];
	$uyelerTel=$_POST['uyelerTel'];
	$uyelerSifre=$_POST['uyelerSifre'];
	$uyelerYetki=$_POST['uyelerYetki'];
	$uyelerSifreOnay=$_POST['uyelerSifreOnay'];
	
	if($guncelleid!=""){
		if($uyelerSifre==$uyelerSifreOnay){
		$query = $db->update('uyeler')
            ->where('uyelerID', $guncelleid,'=')
            ->set(array(
                 'uyelerAdSoyad' => $uyelerAdSoyad,
				 'uyelerMail' => $uyelerMail,
				 'uyelerTel' => $uyelerTel,
				 'uyelerSifre' => $uyelerSifre,
				 'uyelerYetki' => $uyelerYetki
            ));
		}
   
	}
	if($guncelleid=="" && $uyelerAdSoyad!=""){
		if($uyelerSifre==$uyelerSifreOnay){
			$query = $db->insert('uyeler')
				->set(array(
					 'uyelerAdSoyad' => $uyelerAdSoyad,
					 'uyelerMail' => $uyelerMail,
					 'uyelerTel' => $uyelerTel,
					 'uyelerSifre' => $uyelerSifre,
					 'uyelerYetki' => $uyelerYetki,
					 'uyelerKayitTarihi' => date('Y-m-d H:i:s')					 
				));
		}
	}	
	
	$sil=$_GET['sil'];
	if($sil!=""){
		$query = $db->delete('uyeler')
            ->where('uyelerID', $sil,'=')
            ->done();
	}
	
	


	
	$list = $db->select('uyeler')
    ->run();
	
	
	$ID=$_GET['id'];
	if($ID!=""){
		$guncelle = $db->select('uyeler')
			->where('uyelerID', $ID,'=')
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
        Üyeler
      </h1>      
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Üye Ekle/Güncelle</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
		<form action="<?=$sayfa?>" method="post">
        <div class="box-body">
		
			<div class="form-group row">
			  <label for="example-text-input" class="col-sm-2 col-form-label">Adı Soyadı</label>
			  <div class="col-sm-10">
				<input class="form-control" type="text" name="uyelerAdSoyad" value="<?=$guncelle['uyelerAdSoyad']?>" id="example-text-input" required>
			  </div>
			</div>	
			
			<div class="form-group row">
			  <label for="example-text-input" class="col-sm-2 col-form-label">Maili</label>
			  <div class="col-sm-10">
				<input class="form-control" type="text" name="uyelerMail" value="<?=$guncelle['uyelerMail']?>" id="example-text-input" required>
			  </div>
			</div>
			
			<div class="form-group row">
			  <label for="example-text-input" class="col-sm-2 col-form-label">Telefon</label>
			  <div class="col-sm-10">
				<input class="form-control" type="text" name="uyelerTel" value="<?=$guncelle['uyelerTel']?>" id="example-text-input" required>
			  </div>
			</div>	
			
			<div class="form-group row">
			  <label for="example-text-input" class="col-sm-2 col-form-label">Şifre</label>
			  <div class="col-sm-10">
				<input class="form-control" type="password" name="uyelerSifre" id="example-text-input">
			  </div>
			</div>	
			
			<div class="form-group row">
			  <label for="example-text-input" class="col-sm-2 col-form-label">Şifre Onay</label>
			  <div class="col-sm-10">
				<input class="form-control" type="password" name="uyelerSifreOnay" id="example-text-input">
			  </div>
			</div>	
			
			
			<div class="form-group row">
			  <label for="example-text-input" class="col-sm-2 col-form-label">Yetkisi</label>
			  <div class="col-md-10">
							<div class="form-group validate">
								<fieldset class="controls">
									<label class="custom-control custom-radio">
										<input type="radio" value="1" name="uyelerYetki" required="" id="styled_radio1" <?if($guncelle['uyelerYetki']==1){echo 'checked';}?> class="custom-control-input" aria-invalid="false"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Yönetici</span> </label>
								<div class="help-block"></div></fieldset>
								<fieldset>
									<label class="custom-control custom-radio">
										<input type="radio" value="2" name="uyelerYetki" id="styled_radio2" <?if($guncelle['uyelerYetki']==2){echo 'checked';}?> class="custom-control-input" aria-invalid="false"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Uye</span> </label>
								</fieldset>
							</div>
				</div>
			</div>	
			
			<div class="form-group row">
			  <div class="col-sm-12" style="text-align: center;">
			  <input type="hidden" name="guncelleid" value="<?=$guncelle['uyelerID']?>">
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
						<th>Açıklama</th>
						<th>İşlem</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($list as $row){?>
					<tr>
						<td><?=$row['uyelerID']?></td>
						<td><?=$row['uyelerAdSoyad']?></td>
						<td><?=substr(html_entity_decode($row['uyelerMail']),0,50)?></td>
						<td width="30%">
							<table width="100%" border="0">
							<tr>
							<td><a href="<?=$sayfa?>?id=<?=$row['uyelerID']?>" class="btn btn-block btn-warning">Düzenle</a></td>
							<td><a href="<?=$sayfa?>?sil=<?=$row['uyelerID']?>" class="btn btn-block btn-danger" onclick="return confirm('Silmek İstediğinizden eminmisiniz?');">Sil</a></td>
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
						<th>Açıklama</th>
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
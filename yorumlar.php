<?php include 'Layout/header.php';

	$sayfa='yorumlar.php';//post işlemleri hangi sayfaya gönderilecek

	$guncelleid=$_POST['guncelleid'];
	
	$yorumlarPuan=$_POST['yorumlarPuan'];
	$yorumlarYorum=$_POST['yorumlarYorum'];
	$yorumlarOnay=$_POST['yorumlarOnay'];
	
	if($guncelleid!=""){
		
		$query = $db->update('yorumlar')
            ->where('yorumlarID', $guncelleid,'=')
            ->set(array(
                 'yorumlarPuan' => $yorumlarPuan,
				 'yorumlarYorum' => $yorumlarYorum,
				 'yorumlarOnay' => $yorumlarOnay
            ));
   
	}
	if($guncelleid=="" && $yorumlarPuan!=""){
		$query = $db->insert('yorumlar')
            ->set(array(
                 'yorumlarPuan' => $yorumlarPuan,
                 '$yorumlarOnay' => $$yorumlarOnay,
				 'yorumlarYorum' => $yorumlarYorum
            ));
	}	
	
	$sil=$_GET['sil'];
	if($sil!=""){
		$query = $db->delete('yorumlar')
            ->where('yorumlarID', $sil,'=')
            ->done();
	}
	
	

	$ID=$_GET['id'];
	
	$list = $db->select('yorumlar')
	->join('uyeler', 'uyeler.uyelerID = yorumlar.yorumlarYapanID', 'left')
    ->run();
	
	
	if($ID!=""){
		$guncelle = $db->select('yorumlar')
		    ->join('uyeler', 'uyeler.uyelerID = yorumlar.yorumlarYapanID', 'left')
			->where('yorumlarID', $ID,'=')
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
        Yorumlar
      </h1>      
    </section>
<?php if($ID!=""){ ?>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Yorum Ekle/Güncelle</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
		<form action="<?=$sayfa.'?id='.$ID?>" method="post">
        <div class="box-body">
		
		
			<div class="form-group row">
			  <label for="example-text-input" class="col-sm-2 col-form-label">Yorum Tipi</label>
			  <div class="col-sm-10">
    				<?php if($guncelle['yorumlarTipi']==1){ echo "Doktora"; }else if($guncelle['yorumlarTipi']==2){ echo "Hastaneye";}?>
			  </div>
			</div>
			
			<div class="form-group row">
			  <label for="example-text-input" class="col-sm-2 col-form-label">Yorum Yapılan</label>
			  <div class="col-sm-10">
    				<?php
    				    if($guncelle['yorumlarTipi']==1){
    					$doktor = $db->select('doktorlar')
                			->where('doktorlarID', $guncelle['yorumlarYapilanID'],'=')
                			->run(true);
                			
                			echo $doktor['doktorlarAdSoyad'];
                			
    				    }else if($guncelle['yorumlarTipi']==2){
    				        
    				  $hastane = $db->select('hastaneler')
                			->where('hastanelerID', $guncelle['yorumlarYapilanID'],'=')
                			->run(true);
                			echo $hastane['hastanelerAdi'];
    				    }
    				?>
			  </div>
			</div>
			
			<div class="form-group row">
			  <label for="example-text-input" class="col-sm-2 col-form-label">Yorum Yapanın Adı</label>
			  <div class="col-sm-10">
    				<?=$guncelle['uyelerAdSoyad']?>
			  </div>
			</div>
		
		
			<div class="form-group row">
			  <label for="example-text-input" class="col-sm-2 col-form-label">Yorum Puanı</label>
			  <div class="col-sm-10">
				<input class="form-control" type="text" name="yorumlarPuan" value="<?=$guncelle['yorumlarPuan']?>" id="example-text-input" required>
			  </div>
			</div>	
			
			<div class="form-group row">
			  <label for="example-text-input" class="col-sm-2 col-form-label">Yorumu</label>
			  <div class="col-sm-10">
				<textarea class="form-control" name="yorumlarYorum" id="editor" rows="5"><?=$guncelle['yorumlarYorum']?></textarea>
			  </div>
			</div>
			
			
			<div class="form-group row">
			  <label for="example-text-input" class="col-sm-2 col-form-label">Yorum Onayı</label>
			  <div class="col-md-10">
							<div class="form-group validate">
								<fieldset class="controls">
									<label class="custom-control custom-radio">
										<input type="radio" value="1" name="yorumlarOnay" required="" id="styled_radio1" <?if($guncelle['yorumlarOnay']==1){echo 'checked';}?> class="custom-control-input" aria-invalid="false"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Onaylı</span> </label>
								<div class="help-block"></div></fieldset>
								<fieldset>
									<label class="custom-control custom-radio">
										<input type="radio" value="0" name="yorumlarOnay" id="styled_radio2" <?if($guncelle['yorumlarOnay']==0){echo 'checked';}?> class="custom-control-input" aria-invalid="false"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Bekemede</span> </label>
								</fieldset>
							</div>
				</div>
			</div>	
			
			
			<div class="form-group row">
			  <div class="col-sm-12" style="text-align: center;">
			  <input type="hidden" name="guncelleid" value="<?=$guncelle['yorumlarID']?>">
				<button type="submit" class="btn btn-primary" style="width: 200px;">Gönder</button>
			  </div>
			</div>
			
        <!-- /.box-body -->

      </div>
	  
	  </form>
      <!-- /.box -->
    </section>
    <!-- /.content -->
 <? } ?>
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
						<th>Yorum Yapan Adı</th>
						<th>Puanı</th>
						<th>Açıklama</th>
						<th>Durumu</th>
						<th>Yorum Tarihi</th>
						<th>İşlem</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($list as $row){?>
					<tr>
						<td><?=$row['yorumlarID']?></td>
						<td><?=$row['uyelerAdSoyad']?></td>
						<td><?=$row['yorumlarPuan']?></td>
						<td><?=substr(html_entity_decode($row['yorumlarYorum']),0,50)?></td>
						<td><? if($row['yorumlarOnay']==1){echo "Onaylandı";}else{echo "Beklemede";}?></td>
						<td><?=$row['yorumlarEklenmeTarihi']?></td>
						<td width="30%">
							<table width="100%" border="0">
							<tr>
							<td><a href="<?=$sayfa?>?id=<?=$row['yorumlarID']?>" class="btn btn-block btn-warning">Düzenle</a></td>
							<td><a href="<?=$sayfa?>?sil=<?=$row['yorumlarID']?>" class="btn btn-block btn-danger" onclick="return confirm('Silmek İstediğinizden eminmisiniz?');">Sil</a></td>
							</tr>
							</table>					
						</td>
					</tr>		
				<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<th>ID</th>
						<th>Yorum Yapan Adı</th>
						<th>Puanı</th>
						<th>Açıklama</th>
						<th>Yorum Tarihi</th>
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
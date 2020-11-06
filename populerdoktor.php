<?php include 'Layout/header.php';

	$sayfa='populerdoktor.php';//post işlemleri hangi sayfaya gönderilecek
	
	$guncelleid=$_POST['guncelleid'];
	
	$popularSirasi=$_POST['popularSirasi'];	
	$popularOlanID=$_POST['popularOlanID'];
	$popularTipi=1;//doktor
	
	if($guncelleid!=""){
		
		$query = $db->update('popular')
            ->where('popularID', $guncelleid,'=')
            ->set(array(
                 'popularSirasi' => $popularSirasi,
				 'popularOlanID' => $popularOlanID,
                 'popularTipi' => $popularTipi
            ));
	}
	if($guncelleid=="" && $popularSirasi!=""){
		$query = $db->insert('popular')
            ->set(array(
                 'popularSirasi' => $popularSirasi,
				 'popularOlanID' => $popularOlanID,
                 'popularTipi' => $popularTipi
            ));
	}	
	$sil=$_GET['sil'];
	if($sil!=""){
		$query = $db->delete('popular')
            ->where('popularID', $sil,'=')
            ->done();
	}
	
	$ID=$_GET['id'];
	
	$list = $db->select('popular')
	->join('doktorlar', 'doktorlar.doktorlarID = popular.popularOlanID', 'left')
	->where('popularTipi', $popularTipi,'=')
    ->run();	
	
	if($ID!=""){
		$guncelle = $db->select('popular')
			->where('popularID', $ID,'=')
			->run(true);
	}
	
	$listDoktor = $db->select('doktorlar')	
			->orderby('doktorlarAdSoyad', 'ASC')
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
        Populer Doktorlar
      </h1>      
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Populer Ekle/Güncelle</h3>
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
			  <label for="example-text-input" class="col-sm-2 col-form-label">Populer Doktor</label>
			  <div class="col-sm-10">
					<select class="form-control" name="popularOlanID">
					<option value="0">Doktor Seçiniz</option>
					<?php foreach($listDoktor as $satir){
						if($satir['doktorlarID']==$guncelle['popularOlanID']){//eğer güncelleme ise hastane seçili gelmesi için
						?>
						 <option value="<?=$satir['doktorlarID']?>" selected><?=$satir['doktorlarAdSoyad']?></option>
						<? }else { ?>
						<option value="<?=$satir['doktorlarID']?>"><?=$satir['doktorlarAdSoyad']?></option>
					<? } } ?>
                  </select>
			  </div>
		</div>
		
			<div class="form-group row">
				  <label for="example-text-input" class="col-sm-2 col-form-label">Sırası</label>
				  <div class="col-sm-10">
					<input class="form-control" type="number" name="popularSirasi" value="<?=$guncelle['popularSirasi']?>" id="example-text-input" required>
				  </div>
			</div>
			
		<div class="form-group row">
			  <div class="col-sm-12" style="text-align: center;">
			  <input type="hidden" name="guncelleid" value="<?=$guncelle['popularID']?>">
				<button type="submit" class="btn btn-primary" style="width: 200px;">Gönder</button>
			  </div>
			</div>
			
			
		</div>	
		</form>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  <!-- /.content-wrapper -->
     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">         <div class="box">            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 table-responsive">
				<thead>
					<tr>
						<th>ID</th>
						<th>Doktor Adı</th>
						<th>Sırası</th>
						<th>İşlem</th>					
						</tr>
				</thead>
				<tbody>
				<?php foreach($list as $row){?>
					<tr>
						<td><?=$row['popularID']?></td>
						<td><?=$row['doktorlarAdSoyad']?></td>
						<td><?=$row['popularSirasi']?></td>
						<td width="30%">
							<table width="100%" border="0">
							<tr>
							<td><a href="<?=$sayfa?>?id=<?=$row['popularID']?>" class="btn btn-block btn-warning">Düzenle</a></td>
							<td><a href="<?=$sayfa?>?sil=<?=$row['popularID']?>" class="btn btn-block btn-danger" onclick="return confirm('Silmek İstediğinizden eminmisiniz?');">Sil</a></td>
							</tr>
							</table>					
						</td>
					</tr>		
				<?php } ?>
				</tbody>
				<tfoot>
					<tr>						
					<th>ID</th>
					<th>Doktor Adı</th>
					<th>Sırası</th>
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
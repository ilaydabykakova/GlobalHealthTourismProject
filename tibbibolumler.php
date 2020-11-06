<?php include 'Layout/header.php';

	$sayfa='tibbibolumler.php';//post işlemleri hangi sayfaya gönderilecek

	$guncelleid=$_POST['guncelleid'];
	
	$tipBolumleriAdi=$_POST['tipBolumleriAdi'];
	$tipBolumleriAciklama=$_POST['tipBolumleriAciklama'];
	
	if($guncelleid!=""){
		
		$query = $db->update('tipBolumleri')
            ->where('tipBolumleriID', $guncelleid,'=')
            ->set(array(
                 'tipBolumleriAdi' => $tipBolumleriAdi,
				 'tipBolumleriAciklama' => $tipBolumleriAciklama
            ));
   
	}
	if($guncelleid=="" && $tipBolumleriAdi!=""){
		$query = $db->insert('tipBolumleri')
            ->set(array(
                 'tipBolumleriAdi' => $tipBolumleriAdi,
				 'tipBolumleriAciklama' => $tipBolumleriAciklama
            ));
	}	
	
	$sil=$_GET['sil'];
	if($sil!=""){
		$query = $db->delete('tipBolumleri')
            ->where('tipBolumleriID', $sil,'=')
            ->done();
	}
	
	

	$ID=$_GET['id'];
	
	$list = $db->select('tipBolumleri')
    ->run();
	
	
	if($ID!=""){
		$guncelle = $db->select('tipBolumleri')
			->where('tipBolumleriID', $ID,'=')
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
          <h3 class="box-title">Tıbbi Bölüm Ekle/Güncelle</h3>

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
			  <label for="example-text-input" class="col-sm-2 col-form-label">Adı</label>
			  <div class="col-sm-10">
				<input class="form-control" type="text" name="tipBolumleriAdi" value="<?=$guncelle['tipBolumleriAdi']?>" id="example-text-input" required>
			  </div>
			</div>	
			
			<div class="form-group row">
			  <label for="example-text-input" class="col-sm-2 col-form-label">Açiklama</label>
			  <div class="col-sm-10">
				<textarea class="form-control" name="tipBolumleriAciklama" id="editor" rows="5"><?=$guncelle['tipBolumleriAciklama']?></textarea>
			  </div>
			</div>
			
			<div class="form-group row">
			  <div class="col-sm-12" style="text-align: center;">
			  <input type="hidden" name="guncelleid" value="<?=$guncelle['tipBolumleriID']?>">
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
						<td><?=$row['tipBolumleriID']?></td>
						<td><?=$row['tipBolumleriAdi']?></td>
						<td><?=substr(html_entity_decode($row['tipBolumleriAciklama']),0,50)?></td>
						<td width="30%">
							<table width="100%" border="0">
							<tr>
							<td><a href="altTibbiBolumler.php?tipAltBolumleriBolumID=<?=$row['tipBolumleriID']?>" class="btn btn-block btn-warning">Alt Bolumler</a></td>
							<td><a href="<?=$sayfa?>?id=<?=$row['tipBolumleriID']?>" class="btn btn-block btn-warning">Düzenle</a></td>
							<td><a href="<?=$sayfa?>?sil=<?=$row['tipBolumleriID']?>" class="btn btn-block btn-danger" onclick="return confirm('Silmek İstediğinizden eminmisiniz?');">Sil</a></td>
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
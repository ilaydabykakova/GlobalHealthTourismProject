<?php include 'Layout/header.php';

	$tipAltBolumleriBolumID=$_GET['tipAltBolumleriBolumID'];//üst tibbi alan id s

	$sayfa='altTibbiBolumler.php';//post işlemleri hangi sayfaya gönderilecek

	$guncelleid=$_POST['guncelleid'];
	
	$tipAltBolumleriTanim=$_POST['tipAltBolumleriTanim'];

	if($guncelleid!=""){
		
		$query = $db->update('tipAltBolumleri')//güncelleme
            ->where('tipAltBolumleriID', $guncelleid,'=')
            ->set(array(
                 'tipAltBolumleriTanim' => $tipAltBolumleriTanim,
				 'tipAltBolumleriBolumID' => $tipAltBolumleriBolumID
            ));
   
	}
	if($guncelleid=="" && $tipAltBolumleriTanim!=""){//ekleme
		$query = $db->insert('tipAltBolumleri')
            ->set(array(
                 'tipAltBolumleriTanim' => $tipAltBolumleriTanim,
				 'tipAltBolumleriBolumID' => $tipAltBolumleriBolumID
            ));
	}	
	
	$sil=$_GET['sil'];//silme
	if($sil!=""){
		$query = $db->delete('tipAltBolumleri')
            ->where('tipAltBolumleriID', $sil,'=')
            ->done();
	}
	
	

	$list = $db->select('tipAltBolumleri')//tablo listeleme
	->where('tipAltBolumleriBolumID', $tipAltBolumleriBolumID,'=')
    ->run();
	
	$ID=$_GET['id'];
	
	if($ID!=""){//düzenlenecek olan çekilir
		$guncelle = $db->select('tipAltBolumleri')
			->where('tipAltBolumleriID', $ID,'=')
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
       Alt Tıbbi Bölümler
      </h1>      
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Tıbbi Alt Bölüm Ekle/Güncelle</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
		<form action="<?=$sayfa?>?tipAltBolumleriBolumID=<?=$tipAltBolumleriBolumID?>" method="post">
        <div class="box-body">
		
			<div class="form-group row">
			  <label for="example-text-input" class="col-sm-2 col-form-label">Adı</label>
			  <div class="col-sm-10">
				<input class="form-control" type="text" name="tipAltBolumleriTanim" value="<?=$guncelle['tipAltBolumleriTanim']?>" id="example-text-input" required>
			  </div>
			</div>	
			
			
			
			<div class="form-group row">
			  <div class="col-sm-12" style="text-align: center;">
			  <input type="hidden" name="guncelleid" value="<?=$guncelle['tipAltBolumleriID']?>">
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
						<th>İşlem</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($list as $row){?>
					<tr>
						<td><?=$row['tipAltBolumleriID']?></td>
						<td><?=$row['tipAltBolumleriTanim']?></td>
						<td width="30%">
							<table width="100%" border="0">
							<tr>
							<td><a href="<?=$sayfa?>?id=<?=$row['tipAltBolumleriID']?>&tipAltBolumleriBolumID=<?=$tipAltBolumleriBolumID?>" class="btn btn-block btn-warning">Düzenle</a></td>
							<td><a href="<?=$sayfa?>?sil=<?=$row['tipAltBolumleriID']?>&tipAltBolumleriBolumID=<?=$tipAltBolumleriBolumID?>" class="btn btn-block btn-danger" onclick="return confirm('Silmek İstediğinizden eminmisiniz?');">Sil</a></td>
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
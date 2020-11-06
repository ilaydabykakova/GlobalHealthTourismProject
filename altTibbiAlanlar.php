<?php include 'Layout/header.php';

	$sayfa='altTibbiAlanlar.php';//post işlemleri hangi sayfaya gönderilecek
	
	$hastaneid=$_GET['hastaneid'];
	
	$tipAltBolumHataneBolumID=$_POST['tipAltBolumHataneBolumID'];
	$tipAltBolumHataneTutar=$_POST['tipAltBolumHataneTutar'];
	
	if($tipAltBolumHataneBolumID!=""){
		$query = $db->insert('tipAltBolumHatane')
            ->set(array(
                 'tipAltBolumHataneBolumID' => $tipAltBolumHataneBolumID,
				 'tipAltBolumHataneHastaneID	' => $hastaneid,
				 'tipAltBolumHataneTutar	' => $tipAltBolumHataneTutar
            ));
	}	
	
	$sil=$_GET['sil'];
	if($sil!=""){
		$query = $db->delete('tipAltBolumHatane')
            ->where('tipAltBolumHataneID', $sil,'=')
            ->done();
	}
	
	

	$ID=$_GET['id'];
	
	$list = $db->select('tipAltBolumHatane')
	->join('tipAltBolumleri', 'tipAltBolumleri.tipAltBolumleriID = tipAltBolumHatane.tipAltBolumHataneBolumID', 'left')
    ->run();
		
		
			
	$listTibbi = $db->select('tipAltBolumleri')//tıbbi select liste gösterebilmek için çekiyoruz
		->orderby('tipAltBolumleriTanim', 'asc')
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
       Alt Tıbbi Bölümler
      </h1>      
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Alt Tıbbi Bölüm Ekle</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
		<form action="<?=$sayfa?>?hastaneid=<?=$hastaneid?>" method="post">
        <div class="box-body">
		
			<div class="form-group row">
			  <label for="example-text-input" class="col-sm-2 col-form-label">Tıbbi Bölümü</label>
			  <div class="col-sm-10">
					<select class="form-control" name="tipAltBolumHataneBolumID">
					<option value="0">Tıbbi Alan Seçiniz</option>
					<?php foreach($listTibbi as $satir){?>
						<option value="<?=$satir['tipAltBolumleriID']?>"><?=$satir['tipAltBolumleriTanim']?></option>						
					<?  } ?>
                  </select>
			  </div>
			</div>
			
			<div class="form-group row">
			  <label for="example-text-input" class="col-sm-2 col-form-label">Tutar</label>
			  <div class="col-sm-10">
				<input class="form-control" type="text" name="tipAltBolumHataneTutar" value="<?=$guncelle['tipAltBolumHataneTutar']?>" id="example-text-input" required>
			  </div>
			</div>
			
			<div class="form-group row">
			  <div class="col-sm-12" style="text-align: center;">
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
						<th>Bolum Adı</th>
						<th>Tutar</th>
						<th>İşlem</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($list as $row){?>
					<tr>
						<td><?=$row['tipAltBolumHataneID']?></td>
						<td><?=$row['tipAltBolumleriTanim']?></td>		
						<td><?=$row['tipAltBolumHataneTutar']?></td>							
						<td width="30%">
							<table width="100%" border="0">
							<tr>						
							<td>
							<a href="<?=$sayfa?>?sil=<?=$row['tipAltBolumHataneID']?>&hastaneid=<?=$hastaneid?>" class="btn btn-block btn-danger" onclick="return confirm('Silmek İstediğinizden eminmisiniz?');">Sil</a>
							</td>
							</tr>
							</table>					
						</td>
					</tr>		
				<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<th>ID</th>
						<th>Bolum Adı</th>
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
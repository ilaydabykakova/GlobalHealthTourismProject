<?php include 'Layout/header.php';

	$sayfa='tibbialanlar.php';//post işlemleri hangi sayfaya gönderilecek
	
	$hastaneid=$_GET['hastaneid'];
	
	$tipBolumHatsaneTipID=$_POST['tipBolumHatsaneTipID'];
	
	
	if($tipBolumHatsaneTipID!=""){
		$query = $db->insert('tipBolumHatsane')
            ->set(array(
                 'tipBolumHatsaneTipID' => $tipBolumHatsaneTipID,
				 'tipBolumHatsaneHastaneID' => $hastaneid
            ));
	}	
	
	$sil=$_GET['sil'];
	if($sil!=""){
		$query = $db->delete('tipBolumHatsane')
            ->where('tipBolumHatsaneID', $sil,'=')
            ->done();
	}
	
	

	$ID=$_GET['id'];
	
	$list = $db->select('tipBolumHatsane')
	->join('tipBolumleri', 'tipBolumleri.tipBolumleriID = tipBolumHatsane.tipBolumHatsaneTipID', 'left')
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
        Tıbbi Bölümler
      </h1>      
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Tıbbi Bölüm Ekle</h3>

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
					<select class="form-control" name="tipBolumHatsaneTipID">
					<option value="0">Tıbbi Alan Seçiniz</option>
					<?php foreach($listTibbi as $satir){?>
						<option value="<?=$satir['tipBolumleriID']?>"><?=$satir['tipBolumleriAdi']?></option>						
					<?  } ?>
                  </select>
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
						<th>İşlem</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($list as $row){?>
					<tr>
						<td><?=$row['tipBolumHatsaneID']?></td>
						<td><?=$row['tipBolumleriAdi']?></td>						
						<td width="30%">
							<table width="100%" border="0">
							<tr>						
							<td>
							<a href="altTibbiAlanlar.php?hastaneid=<?=$hastaneid?>" class="btn btn-block btn-warning">Alt Tıbbi Alanlar</a>
							<a href="<?=$sayfa?>?sil=<?=$row['tipBolumHatsaneID']?>&hastaneid=<?=$hastaneid?>" class="btn btn-block btn-danger" onclick="return confirm('Silmek İstediğinizden eminmisiniz?');">Sil</a>
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
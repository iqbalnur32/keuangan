<?php

$page = "Pengeluaran Keuangan";

ini_set('display_errors',1);
error_reporting(E_ALL | E_STRICT);

include '../sys/config.php';
include '../vendor/autoload.php';
Session::init();
Session::checkSession();
// Session::checkRole("1");



$c = new Config();

// $listPengeluaran = $c->readTable('pengeluaran', 'tanggal');
$id_user = Session::get('id');

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['start_date']) && isset($_GET['end_date'])){
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];
    $listPengeluaran = $c->query2("SELECT * FROM pengeluaran WHERE id_user = '$id_user' AND tanggal BETWEEN '$start_date' AND '$end_date' ORDER BY tanggal DESC ")->rowObject();
}else{
   $listPengeluaran = $c->query2("SELECT * FROM pengeluaran WHERE id_user = '$id_user' ORDER BY tanggal DESC ")->rowObject();
}
$listCategory = $c->readTable('category_pengeluaran', 'code_akun');

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add-pengeluaran'])) 
{
    $create = $c->inputPengeluran($_POST);
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit-pengeluaran'])) 
{
    $create = $c->editPengeluaran($_POST);
    exit();
}

if(isset($_GET['action']) && $_GET['action'] == 'logout')
{
   Session::destroy();
}


?>
<style>
#tablehead th{
    border: 1px solid black;
}
#tablebody td {
    border: 1px solid black;
}
</style>
<?php include('../include/head.php')?>
    <div class="wrapper">
        <div class="container-fluid">
        	<?php if (!isset($_GET['tambah-pengeluaran']) && !isset($_GET['edit-pengeluaran']) && !isset($_GET['delete-pengeluaran']) ): ?>
	        	<div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h4 class="page-title m-0"><?php echo ucwords($page)?></h4>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-right">
                                    	<a href="?tambah-pengeluaran=add" class="btn btn-primary waves-effect waves-light btn-xl">Tambah Pengeluran</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                	<div class="col-12">
                		<div class="card" style="border:2px solid black">
                			<div class="card-body">
                				<form action="" method="GET">
	                				<div class="row">
	                					<div class="col-4">
	                						<div class="form-group">
		                						<label>Start Date</label>
		                						<input class="form-control" type="date" name="start_date" value="<?= isset($_GET['start_date']) ? $_GET['start_date'] : "" ?>">
	                						</div>
	                					</div>	
	                					<div class="col-4">
	                						<div class="form-group">
		                						<label>End Date</label>
		                						<input class="form-control" type="date" name="end_date" value="<?= isset($_GET['end_date']) ? $_GET['end_date'] : "" ?>">
	                						</div>
	                					</div>	
	                					<div class="col-4">
	                						<div class="form-group">
		                						<label>Pencarian</label>
		                						<button class="form-control btn btn-primary" name="filter" value="filter">Filter</button>
	                						</div>
	                					</div>
	                				</div>
                				</form>
                                <div class="table">
                                    <table id="datatable" class="table table-striped table-bordered" style="border-collapse: collapse; width: 100%;">
                                        <thead>
                                            <tr id="tablehead">
                                                <th>No</th>
                                                <th>Pemasukan Dari</th>
                                                <th>Jumlah</th>
                                                <th>Tanggal</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php $no = 1; foreach ($listPengeluaran as $key => $value): ?>
                                        		<tr>
                                        			<td><?= $no++ ?></td>
                                        			<td><?= $value->name_pengeluaran ?></td>
                                        			<td>Rp. <?= number_format($value->total) ?></td>
                                        			<td><?= $value->tanggal ?></td>
                                        			<td>
                                        				<a href="?edit-pengeluaran=<?= $value->id_pengeluaran ?>" class="btn btn-primary waves-effect waves-light btn-xl">Edit</a>
                                        				<a href="?delete-pengeluaran=<?= $value->id_pengeluaran ?>" class="btn btn-primary waves-effect waves-light btn-xl">Delete</a>
                                        			</td>
                                        		</tr>
                                        	<?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">Total Pendapatan Pemasukan</label>
                                        <?php if (isset($_GET['filter'])): ?>
                                        	<?php $ttl_masuk = $c->getTotalPengeluaran($_GET); ?>
                                        <?php else: ?>
                                        	<?php $ttl_masuk = $c->getTotalPengeluaran(""); ?>
                                        <?php endif ?>
                                        <!-- <?php print_r($ttl_masuk); ?> -->
                                        <input type="text" class="form-control border-black" style="font-weight:bold;"  value="Rp. <?= number_format($ttl_masuk->ttl_pemasukan) ?>" disabled="">
                                    </div>
                                </div>
                            </div>
                		</div>
                	</div>
                </div>
        	<?php elseif(isset($_GET['tambah-pengeluaran'])): ?>
        		<div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h4 class="page-title m-0"><?php echo ucwords($page)?></h4>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-right">
                                    	<a href="pemasukan-keuangan" class="btn btn-primary waves-effect waves-light btn-xl">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                	<div class="col-12">
                		<form action="" method="POST">
	                		<div class="card" style="border: 2px solid black">
	                			<div class="card-body">
	                				<div class="row">
	                					<div class="col-6">
	                						<div class="form-group">
	                							<label>Jumlah Pengeluaran</label>
	                							<input class="form-control" type="text" name="total" id="rupiah" placeholder="Rp. 0">
	                						</div>
	                						<div class="form-group">
	                							<label>Tanggal Transaksi Pengeluaran</label>
	                							<input class="form-control" type="date" name="tanggal">
	                						</div>
	                					</div>
	                					<div class="col-6">
	                						<div class="form-group">
	                							<label>Name Pengeluaran</label>
	                							<input class="form-control" type="text" name="name_pengeluaran" placeholder="Beli Miktorik">
	                						</div>
	                						<div class="form-group">
	                							<label>Category Pengeluaran</label>
	                							<select class="form-control" name="nama_category">
	                								<?php foreach ($listCategory as $key): ?>
                                                        <option value="<?= $key['id_category_pengeluaran'] ?>"><?= $key['nama_category'] ?></option>
                                                    <?php endforeach ?>
	                							</select>
	                						</div>
	                					</div>
	                				</div>
	                				<div class="row">
	                					<div class="col-12">
	                						<div class="form-group">
	                							<label>Keterangan Transaksi</label>
	                							<textarea class="form-control" name="keterangan" placeholder="Keterangan Transksi" rows="4" cols="50"></textarea>
	                						</div>
	                						<div class="float-left">
	                							<button class="btn btn-primary waves-effect waves-light btn-xl" name="add-pengeluaran" value="add-pengeluaran" >Simpan</button>
	                						</div>
	                					</div>
	                				</div>		
	                			</div>
	                		</div>
                		</form>
                	</div>
                </div>
    		<?php elseif(isset($_GET['edit-pengeluaran'])): ?>
    		<?php $id = $_GET['edit-pengeluaran'] ;$transkasi = $c->getEachTable('pengeluaran', 'id_pengeluaran', $id); ?>
    			<div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h4 class="page-title m-0">Edit Transkasi Pengeluaran</h4>
                                </div>
                                <div class="col-md-4">
                                    <div class="float-right">
                                    	<a href="pemasukan-keuangan" class="btn btn-primary waves-effect waves-light btn-xl">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                	<div class="col-12">
                		<form action="" method="POST">
	                		<div class="card" style="border: 2px solid black">
	                			<div class="card-body">
	                				<div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Jumlah Pengeluaran</label>
                                                <input class="form-control" type="text" name="total" id="rupiah" placeholder="Rp. 0" value="Rp. <?= number_format($transkasi->total)?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Transaksi Pengeluaran</label>
                                                <input class="form-control" type="date" name="tanggal" value="<?= $transkasi->tanggal ?>">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Name Pengeluaran</label>
                                                <input class="form-control" type="text" name="name_pengeluaran" placeholder="Beli Miktorik" value="<?= $transkasi->name_pengeluaran ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Category Pengeluaran</label>
                                                <select class="form-control" name="nama_category">
                                                    <?php foreach ($listCategory as $key): ?>
                                                        <option <?= $key['id_category_pengeluaran'] == $transkasi->id_category_pengeluaran ? "selected" : "" ?> value="<?= $key['id_category_pengeluaran'] ?>"><?= $key['nama_category'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Keterangan Transaksi</label>
                                                <textarea class="form-control" name="keterangan" placeholder="Keterangan Transksi" rows="4" cols="50"><?= $transkasi->keterangan ?></textarea>
                                            </div>
                                            <div class="float-left">
                                                <button class="btn btn-primary waves-effect waves-light btn-xl" name="edit-pengeluaran" value="edit-pengeluaran" >Simpan</button>
                                            </div>
                                        </div>
                                    </div>      	
	                			</div>
	                		</div>
                		</form>
                	</div>
                </div>
    		<?php elseif(isset($_GET['delete-pengeluaran'])): ?>

        	<?php endif ?>
        </div>
    </div>
<?php include('../include/footer.php')?>

<script type="text/javascript">
	var rupiah = document.getElementById('rupiah');
	rupiah.addEventListener('keyup', function(e){
		rupiah.value = formatRupiah(this.value, 'Rp. ');
	});
	/* Fungsi formatRupiah */
	function formatRupiah(angka, prefix){
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
		split   		= number_string.split(','),
		sisa     		= split[0].length % 3,
		rupiah     		= split[0].substr(0, sisa),
		ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
		if(ribuan){
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}
		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	}
</script>